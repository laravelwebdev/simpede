<?php

namespace App\Nova\Lenses;

use App\Helpers\Policy;
use App\Nova\Actions\SetStatus;
use App\Nova\Metrics\BackupsTable;
use App\Nova\Metrics\OutdatedTable;
use App\Nova\Metrics\ServerResource;
use App\Nova\Metrics\SystemInfo;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\Paginator;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Line;
use Laravel\Nova\Fields\Stack;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Lenses\Lens;
use Laravelwebdev\Numeric\Numeric;

class SystemReport extends Lens
{
    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'level',
        'context',
        'file',
        'line',
        'message',
    ];

    public $name = 'Log Error';

    public static $showPollingToggle = true;

    public static $polling = true;

    public static $pollingInterval = 60;

    /**
     * Get the query builder / paginator for the lens.
     */
    public static function query(LensRequest $request, Builder $query): Builder|Paginator
    {
        return $request->withOrdering($request->withFilters(
            $query->where('resolved', false)
        ));
    }

    /**
     * Get the fields available to the lens.
     *
     * @return array<int, \Laravel\Nova\Fields\Field>
     */
    public function fields(NovaRequest $request): array
    {
        return [
            Badge::make('Level')
                ->map([
                    'EMERGENCY' => 'danger',
                    'ALERT' => 'danger',
                    'CRITICAL' => 'danger',
                    'ERROR' => 'danger',
                    'WARNING' => 'warning',
                    'NOTICE' => 'info',
                    'INFO' => 'info',
                    'DEBUG' => 'info',
                ])
                ->withIcons()
                ->filterable(),
            Stack::make('Details', [
                Line::make('Context')->asHeading(),
                Line::make('File', function ($model) {
                    if (is_null($model->file)) {
                        return null;
                    }

                    return $model->file.' on Line :'.$model->line;
                })->asBase(),
                Line::make('Message', function ($model) {
                    return strlen($model->message) > 175
                        ? substr($model->message, 0, 175).'...'
                        : $model->message;
                })->asSmall(),
            ]),
            Numeric::make('Count')->sortable(),
        ];
    }

    /**
     * Get the cards available on the lens.
     *
     * @return array<int, \Laravel\Nova\Card>
     */
    public function cards(NovaRequest $request): array
    {
        return [
            ServerResource::make()->refreshIntervalSeconds(60),
            ServerResource::make('inode')->refreshIntervalSeconds(60),
            ServerResource::make('backup')->help('')->refreshIntervalSeconds(60),
            SystemInfo::make()->width('1/3')->refreshIntervalSeconds(60)->scrollable(),
            BackupsTable::make()->width('1/3')
                ->emptyText('No backups found.')
                ->scrollable()
                ->refreshIntervalSeconds(60),
            OutdatedTable::make()->width('1/3')
                ->scrollable()
                ->emptyText('All packages are already up to date.'),

        ];
    }

    /**
     * Get the filters available for the lens.
     *
     * @return array<int, \Laravel\Nova\Filters\Filter>
     */
    public function filters(NovaRequest $request): array
    {
        return [];
    }

    /**
     * Get the actions available on the lens.
     *
     * @return array<int, \Laravel\Nova\Actions\Action>
     */
    public function actions(NovaRequest $request): array
    {
        return [
            SetStatus::make()
                ->confirmButtonText('Ubah Status')
                ->confirmText('Pastikan Error sudah diperbaiki. Yakin akan melanjutkan?')
                ->setName('Resolve Error')
                ->setStatus(true, 'resolved')
                ->sole()
                ->onlyInline()
                ->canSee(fn () => Policy::make()->allowedFor('admin')->get()),
        ];
    }

    /**
     * Get the URI key for the lens.
     */
    public function uriKey(): string
    {
        return 'system-report';
    }
}
