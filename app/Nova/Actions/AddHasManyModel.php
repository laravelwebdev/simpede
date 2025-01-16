<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Http\Requests\NovaRequest;

class AddHasManyModel extends Action
{
    use InteractsWithQueue, Queueable;

    protected $resourceId;

    protected $fields;

    protected $modelName;

    protected $parentModel;

    public function __construct($modelName, $parentModel, $resourceId, $parentIdColumn = null)
    {
        $this->resourceId = $resourceId;
        $this->modelName = $modelName;
        $this->parentModel = $parentModel;
        $this->parentIdColumn = $parentIdColumn;
    }

    public $name = 'Tambah';

    public function addFields($fields)
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * Perform the action on the given models.
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $model = app('App\Models\\'.Str::studly($this->modelName));
        foreach ($this->fields as $field) {
            if (($field->resourceClass ?? null) == null && ! $field instanceof Hidden) {
                $model->{$field->attribute} = $fields->{$field->attribute};
            }
            if ($field instanceof BelongsTo && ! $field instanceof Hidden) {
                $model->{Str::snake($field->attribute.' id')} = $fields->{$field->attribute}->id;
            }
        }
        $model->{Str::snake($this->parentIdColumn ?? $this->parentModel.' id')} = $this->resourceId;
        $model->save();
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return $this->fields;
    }
}
