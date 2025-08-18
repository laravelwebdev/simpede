<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Models\Announcement;
use App\Models\DaftarKegiatan;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravelwebdev\ListCard\ListCard;
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

        $items = DaftarKegiatan::whereIn('jenis', ['Libur', 'Deadline', 'Rapat'])
            ->where(function ($query) {
                $query->where('jenis', 'Libur')
                    ->orWhere(function ($q) {
                        $q->whereIn('jenis', ['Deadline', 'Rapat'])
                            ->whereDate('awal', '>=', now()->toDateString());
                    });
            })
            ->orderBy('awal')
            ->get()
            ->groupBy('jenis');

        $kegiatan = ($items['Libur'] ?? collect())->map(function ($item) {
            return [
                'title' => Helper::terbilangHari($item->awal).', '.Helper::terbilangTanggal($item->awal),
                'description' => $item->kegiatan,
            ];
        })->values()->toArray();

        $deadline = ($items['Deadline'] ?? collect())->map(function ($item) {
            return [
                'title' => Helper::terbilangHari($item->awal).', '.Helper::terbilangTanggal($item->awal),
                'description' => $item->kegiatan,
            ];
        })->values()->toArray();

        $rapat = ($items['Rapat'] ?? collect())->map(function ($item) {
            return [
                'title' => Helper::terbilangHari($item->awal).', '.Helper::terbilangTanggal($item->awal),
                'description' => $item->kegiatan,
            ];
        })->values()->toArray();

        $pengumuman = Announcement::cache()->get('latest');

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

        $cards[] = ListCard::make()
            ->title('Deadline Mendatang')
            ->items($deadline)
            ->emptyText('Tidak ada Deadline');

        $cards[] = ListCard::make()
            ->title('Rapat Mendatang')
            ->items($rapat)
            ->emptyText('Tidak ada Rapat');

        $cards[] = ListCard::make()
            ->title('Hari Libur Nasional')
            ->items($kegiatan)
            ->emptyText('Tidak ada hari libur nasional');

        return $cards;
    }
}
