<?php

namespace App\Nova\Dashboards;

use App\Models\Announcement;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravelwebdev\NewsCard\NewsCard;

class PortalAplikasi extends Dashboard
{
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Portal Aplikasi';
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        $cards = [];
        $aplikasi = Announcement::cache()->get('aplikasi') ?? [];

        foreach ($aplikasi as $item) {
            $cards[] = NewsCard::make(
                title: $item->title,
                description: $item->description,
                image: Storage::disk('announcement')->url($item->image),
                link: $item->link,
                buttonCaption: 'Buka',
            );
        }

        return $cards;
    }
}
