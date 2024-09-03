<?php

namespace App\Nova\Dashboards;

use App\Helpers\Inspiring;
use App\Models\Pengelola;
use DigitalCreative\NovaWelcomeCard\WelcomeCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Orion\NovaGreeter\GreeterCard;

class Main extends Dashboard
{
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public function name()
    {
        return 'Selamat Datang';
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            GreeterCard::make()
                ->user(name: Auth::user()->nama, title: Auth::user()->email)
                ->message(text: __('Welcome Back!'))
                ->avatar(url: Storage::disk('avatars')->url(Auth::user()->avatar))
                ->verified(text: (Pengelola::cache()->get('all')->where('role', session('role'))->first() !== null) ? Pengelola::cache()->get('all')->where('role', session('role'))->first()->jabatan : 'Pegawai')
                ->width('1/2'),
            GreeterCard::make()
                ->user(name: 'Quotes of the day', title: Inspiring::show())
                ->message(text: '')
                ->avatar(url: Storage::disk('images')->url('quotes.svg'))
                ->width('1/2'),
            WelcomeCard::make()
                ->title('Get Started') // optional
                ->description('Selamat datang di Aplikasi Simpede. Berikut adalah fitur-fitur yang tersedia:') // optional
                ->addItem(icon: 'document-text', title: 'Pengelolaan Kerangka Acuan Kerja', content: 'Fitur yang disediakan untuk membuat Kerangka Acuan Kerja yang dapat diunduh dalam format Microsoft Word.')
                ->addItem(icon: 'mail-open', title: 'Pengelolaan Naskah Dinas Masuk', content: 'Fitur yang disediakan untuk melakukan pengarsipan naskah dinas masuk dalam bentuk softcopy.')
                ->addItem(icon: 'mail', title: 'Pengelolaan Naskah Dinas Keluar', content: 'Fitur yang disediakan untuk membuat nomor naskah dinas keluar dan melakukan pengarsipan  dalam bentuk softcopy.')
                ->addItem(icon: 'users', title: 'Pengelolaan Izin Keluar Pegawai', content: 'Fitur yang disediakan untuk mendokumentasikan izin keluar kantor untuk pegawai.')
                ->addItem(icon: 'user-group', title: 'Pengelolaan Kontrak Kegiatan Bulanan Mitra', content: 'Fitur yang disediakan untuk memonitor kesesuaian kontrak dengan SBML, Mencetak kontrak dan BAST serta mencetak SK, Surat Tugas dan SPJ Honor Mitra.')
                ->addItem(icon: 'collection', title: 'Pengelolaan Barang Persediaan', content: 'Fitur yang disediakan untuk mencatat transfer masuk, transfer keluar, mencetak BON Permintaan dan  mengidentifikasi Kode Barang Persediaan.'),
        ];
    }
}
