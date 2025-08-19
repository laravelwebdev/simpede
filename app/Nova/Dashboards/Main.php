<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Models\Announcement;
use App\Nova\Metrics\Kegiatan;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravelwebdev\NewsCard\NewsCard;
use Laravelwebdev\NovaQuotes\NovaQuotes;
use Richardkeep\NovaTimenow\NovaTimenow;

class Main extends Dashboard
{
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Beranda';
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        $values = array_map(function ($key) {
            return Helper::ROLE[$key];
        }, session('role'));

        $cards = [];
        $pengumuman = Announcement::cache()->get('latest') ?? [];

        $cards[] = NovaQuotes::make()
            ->greetings(__('Welcome Back!'))
            ->user(auth()->user()->name ?? 'Guest')
            ->width('2/3')
            ->description('Role: '.implode(', ', $values))
            ->render();

        $cards[] = NovaTimenow::make()
            ->width('1/3')
            ->timezones([
                'Asia/Pontianak',
                'Asia/Makassar',
                'Asia/Jayapura',
            ])->defaultTimezone(config('app.timezone'));

        foreach ($pengumuman as $item) {
            $cards[] = NewsCard::make(
                title: $item->title,
                description: $item->description,
                image: Storage::disk('announcement')->url($item->image),
                link: $item->link,
                buttonCaption: 'Pelajari'
            );
        }

        $cards[] = Kegiatan::make('Deadline')
            ->emptyText('Tidak ada deadline')
            ->scrollable()
            ->refreshIntervalSeconds(60)
            ->width('1/3');

        $cards[] = Kegiatan::make('Rapat')
            ->emptyText('Tidak ada Rapat')
            ->scrollable()
            ->refreshIntervalSeconds(60)
            ->width('1/3');

        $cards[] = Kegiatan::make('Libur')
            ->emptyText('Tidak ada hari libur nasional')
            ->scrollable()
            ->refreshIntervalSeconds(60)
            ->width('1/3');

        return $cards;
    }
}
