<?php

namespace App\Nova\Dashboards;

use App\Helpers\Helper;
use App\Helpers\Inspiring;
use App\Helpers\Policy;
use App\Nova\Metrics\DiskSpace;
use App\Nova\Metrics\ServerResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Dashboards\Main as Dashboard;
use Laravelwebdev\Greeter\Greeter;
use Laravelwebdev\Welcome\Welcome;

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

        $quotes = Inspiring::show();

        return [
            Greeter::make()
                ->user(name: Auth::user()->name, title: Auth::user()->email)
                ->message(text: __('Welcome Back!'))
                ->avatar(url: Storage::disk('avatars')->url(Auth::user()->avatar))
                ->verified(text: implode(', ', $values))
                ->width('1/2'),
            Greeter::make()
                ->user(name: 'Kata-kata Hari Ini', title: $quotes['quote'])
                ->message(text: '')
                ->verified(text: $quotes['author'])
                ->avatar(url: Storage::disk('images')->url('quotes.svg'))
                ->width('1/2'),
            ServerResource::make()->canSee(fn () => Policy::make()->allowedFor('admin')->get()),
            ServerResource::make('inode')->canSee(fn () => Policy::make()->allowedFor('admin')->get()),
            Welcome::make()
                ->title('Permulaan') // optional
                ->description('Selamat datang di Aplikasi Simpede. Berikut adalah fitur-fitur yang tersedia:') // optional
                ->addItem(icon: 'document-text', title: 'Pengelolaan Kerangka Acuan Kerja', content: 'Fitur yang disediakan untuk membuat Kerangka Acuan Kerja yang dapat diunduh dalam format Microsoft Word dan mengarsipkan softcopy berkas-berkas terkait Kerangka Acuan Kerja.')
                ->addItem(icon: 'mail', title: 'Pengelolaan Naskah Dinas', content: 'Fitur yang disediakan untuk membuat nomor naskah dinas keluar dan melakukan pengarsipan naskah dinas masuk dan naskah dinas keluar dalam bentuk softcopy.')
                ->addItem(icon: 'users', title: 'Pengelolaan Kepegawaian', content: 'Fitur yang disediakan untuk mendokumentasikan izin keluar kantor untuk pegawai dan penganugerahan gelar Employee of the Month')
                ->addItem(icon: 'user-group', title: 'Pengelolaan Kontrak Mitra Statistik', content: 'Fitur yang disediakan untuk memonitor kesesuaian kontrak dengan SBML, mencetak kontrak dan BAST, mencetak SK, mengeksport template BOS, export template CMS BRI, Mencetak Surat Tugas dan SPJ Honor Mitra serta Mengarsipkan Softcopy Kontrak dan BAST.')
                ->addItem(icon: 'archive-box', title: 'Pengelolaan Barang Persediaan', content: 'Fitur yang disediakan untuk mencatat transfer masuk, transfer keluar, mencetak BON Permintaan dan mencetak Kartu Kendali Barang Persediaan, serta mengidentifikasi Kode Barang Persediaan (Aktualisasi Latsar Hasyimur Rusdi)')
                ->addItem(icon: 'presentation-chart-bar', title: 'Monitoring Anggaran', content: 'Fitur yang disediakan untuk memonitor serapan anggaran dan rencana penarikan dana.')
                ->addItem(icon: 'office-building', title: 'Pemeliharaan BMN', content: 'Fitur yang disediakan untuk memonitor pemeliharaan Barang Milik Negara dan mencetak Kartu Kendali Pemeliharaan.')
                ->addItem(icon: 'truck', title: 'Perjalanan Dinas', content: 'Fitur yang disediakan untuk membuat Surat Tugas dan Surat Perintah Perjalanan Dinas, mencetak kuitansi perjalanan dinas dan Surat Pernyataan Tidak Menggunakan Kendaran Dinas')
                ->addItem(icon: 'film', title: 'Dokumentasi', content: 'Fitur yang disediakan untuk menyimpan dokumentasi foto-foto kegiatan dan link-link penting.')
                ->addItem(icon: 'library', title: 'Manajemen Rapat', content: 'Fitur yang disediakan untuk membuat Surat Undangan, Daftar Hadir dan Template Notula rapat internal')
                ->addItem(icon: 'calendar', title: 'Kalender Kegiatan', content: 'Fitur yang menampilkan kalender kegiatan,deadline dan tanggal penting lainnya. Selain itu juga mengirimkan reminder deadline kegiatan melalui Whatsapp (Aktualisasi Latsar Ilman Mimin Maulana)')
                ->addItem(icon: 'document-chart-bar', title: 'Pengelolaan SAKIP', content: 'Fitur untuk pencatatan realisasi kinerja, kendala dan solusi, rencana dan pelaksanaan tindak lanjut dalam rangka pencapaian target kinerja.'),
        ];
    }
}
