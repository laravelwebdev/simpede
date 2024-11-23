<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Helpers\Inspiring;
use DigitalCreative\NovaWelcomeCard\WelcomeCard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        return 'Tahun '.session('year');
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        $values = array_map(function ($key) {
            return Helper::$role[$key];
        }, session('role'));

        return [
            GreeterCard::make()
                ->user(name: Auth::user()->name, title: Auth::user()->email)
                ->message(text: __('Welcome Back!'))
                ->avatar(url: Storage::disk('avatars')->url(Auth::user()->avatar))
                ->verified(text: implode(', ', $values))
                ->width('1/2'),
            GreeterCard::make()
                ->user(name: 'Quotes of the day', title: Inspiring::show())
                ->message(text: '')
                ->avatar(url: Storage::disk('images')->url('quotes.svg'))
                ->width('1/2'),
            WelcomeCard::make()
                ->title('Get Started') // optional
                ->description('Selamat datang di Aplikasi Simpede. Berikut adalah fitur-fitur yang tersedia:') // optional
                ->addItem(icon: 'document-text', title: 'Pengelolaan Kerangka Acuan Kerja', content: 'Fitur yang disediakan untuk membuat Kerangka Acuan Kerja yang dapat diunduh dalam format Microsoft Word dan mengarsipkan softcopy berkas-berkas terkait Kerangka Acuan Kerja.')
                ->addItem(icon: 'mail', title: 'Pengelolaan Naskah Dinas', content: 'Fitur yang disediakan untuk membuat nomor naskah dinas keluar dan melakukan pengarsipan naskah dinas masuk dan naskah dinas keluar dalam bentuk softcopy.')
                ->addItem(icon: 'users', title: 'Pengelolaan Izin Keluar Pegawai', content: 'Fitur yang disediakan untuk mendokumentasikan izin keluar kantor untuk pegawai.')
                ->addItem(icon: 'user-group', title: 'Pengelolaan Kontrak Mitra Statistik', content: 'Fitur yang disediakan untuk memonitor kesesuaian kontrak dengan SBML, mencetak kontrak dan BAST, mencetak SK, Surat Tugas dan SPJ Honor Mitra serta Mengarsipkan Softcopy Kontrak dan BAST.')
                ->addItem(icon: 'collection', title: 'Pengelolaan Barang Persediaan', content: 'Fitur yang disediakan untuk mencatat transfer masuk, transfer keluar, mencetak BON Permintaan dan mencetak Kartu Kendali Barang Persediaan, serta mengidentifikasi Kode Barang Persediaan.')
                ->addItem(icon: 'presentation-chart-bar', title: 'Monitoring Anggaran', content: 'Fitur yang disediakan untuk memonitor serapan anggaran dan rencana penarikan dana.')
                ->addItem(icon: 'office-building', title: 'Pemeliharaan BMN', content: 'Fitur yang disediakan untuk memonitor pemeliharaan Barang Milik Negara dan mencetak Kartu Kendali Pemeliharaan.')
                ->addItem(icon: 'truck', title: 'Perjalanan Dinas', content: 'Fitur yang disediakan untuk membuat nomor Surat Tugas dan Surat Perintah Perjalanan Dinas, mencetak kuitansi perjalanan dinas dan Surat Pernyataan Tidak Menggunakan Kendaran Dinas'),
        ];
    }
}
