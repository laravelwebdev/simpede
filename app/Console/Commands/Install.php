<?php

namespace App\Console\Commands;

use App\Models\Pengelola;
use App\Models\Template;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

use function Laravel\Prompts\select;
use function Laravel\Prompts\text;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'simpede:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Simpede Application';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $confirm = text('Menjalankan Command ini akan menghapus semua data yang ada dan membuat ulang database, Jika Anda yakin silakan ketikkan "yakin"');
        if ($confirm != 'yakin') {
            $this->info('Command dibatalkan');

            return;
        }
        $this->info('Memulai proses installasi');
        $this->call('migrate:fresh');
        $this->info('Membuat User Admin. Silakan Masukkan data Admin Sementara');
        $this->call('nova:user');
        Pengelola::create(
            [
                'user_id' => '1',
                'role' => 'admin',
            ]
        );
        $this->info('Seeding data template');

        $templates = [
            [
                'nama' => 'Template Import Kode Arsip',
                'jenis' => 'import',
                'file' => 'HMrafy1OQUdCv20aF7zFgb12BU7mkpCMk5yH4IUE.xlsx',
            ],
            [
                'nama' => 'Template Import Mitra',
                'jenis' => 'import',
                'file' => 'vs4vjnKmcr8CPUrONoj44wQbI1ntrEeSwLJvsDRD.xlsx',
            ],
            [
                'nama' => 'Template Kerangka Acuan Kerja',
                'jenis' => 'kak',
                'file' => 'ReAdPXzRYWqgpho3W0mX4U3rxg3UfZ3F4MmKlxsP.docx',
            ],
            [
                'nama' => 'Template SPJ',
                'jenis' => 'spj',
                'file' => 'd2z8X186YFymCM29dPa84LH7rTrqljrmfhmyc7C4.docx',
            ],
            [
                'nama' => 'Template SK Petugas',
                'jenis' => 'sk',
                'file' => 'JmHXF4rvAMCnZQg6zx8jjfvZAygCsh0hpZcRcSJd.docx',
            ],
            [
                'nama' => 'Template Surat Tugas',
                'jenis' => 'st',
                'file' => '6ALNH1DPbuAbXP3t3muIDuCOQ7Wjqd1WTR9zqXlS.docx',
            ],
            [
                'nama' => 'Template Surat Tugas dengan Lampiran',
                'jenis' => 'st',
                'file' => 'uYxj7Ir0cAiOBnrQ9EPEi5fqHuStnbVSHOhFijjl.docx',
            ],
            [
                'nama' => 'Template Kontrak Bulanan Mitra',
                'jenis' => 'kontrak',
                'file' => 'NMkRjA9CIjEGH6Otv1VdnDL1dt2tQFY4dXm0W8Sg.docx',
            ],
            [
                'nama' => 'Template BAST Kontrak Bulanan Mitra',
                'jenis' => 'bast',
                'file' => 'm3yoHzM7gYlvy2F6KDKSlFtyeYNe36eqKLh8FoYU.docx',
            ],
            [
                'nama' => 'Template Import Master Persediaan',
                'jenis' => 'import',
                'file' => 'zUCmuLwHj8P0d50lunRAYlQGESuUTwaECHs7hvEx.xlsx',
            ],
            [
                'nama' => 'Template Penerimaan Barang Persediaan',
                'jenis' => 'bastp',
                'file' => '8XlIOq9mjiZWYRhQE22KUkPKRDLzZDOdqtjoJiyy.docx',
            ],
            [
                'nama' => 'Template Bon Persediaan',
                'jenis' => 'bon',
                'file' => 'kA4gjL7ih9kVU5CNpew9noR35RJpPuPq8rgPvZ3B.docx',
            ],
            [
                'nama' => 'Template Kartu Kendali Persediaan',
                'jenis' => 'karken_persediaan',
                'file' => 'WRk2WCqEB8uhrnEtQ2OuvYltRDl9WZQrspUiyZri.docx',
            ],
            [
                'nama' => 'Template Pernyataan Tidak Menggunakan Kendaraan Dinas',
                'jenis' => 'pernyataan_kendaraan',
                'file' => 'IytKaQ2YJMPd8YVXfG43ERNVkrYOukleAZGYia5S.docx',
            ],
            [
                'nama' => 'Template Kuitansi Perjalanan Dinas',
                'jenis' => 'kuitansi',
                'file' => 'TBluazR6HO1B8zlWt3HR1mQKsgQ412EcSXrQpgVM.docx',
            ],
            [
                'nama' => 'Template Kartu Kendali Pemeliharaan BMN',
                'jenis' => 'karken_pemeliharaan',
                'file' => 'PK9c7nZ68UmuwNid1q5LtP9Jz981J1FwKr9YEcvE.docx',
            ],
            [
                'nama' => 'Template Kertas Kerja Employee Of The Month',
                'jenis' => 'kertas_kerja_reward',
                'file' => '1KOF4WgsSMoKmH8EKUkqBzVgkSvTrNwm9krFHRg9.docx',
            ],
            [
                'nama' => 'Template Sertifikat Employee Of The Month',
                'jenis' => 'sertifikat_reward',
                'file' => 'HnihTnXjdITBB6z8etWmegpEOjyXAjcfVWZIWWR3.docx',
            ],
            [
                'nama' => 'Template Surat Keputusan Employee Of The Month',
                'jenis' => 'sk_reward',
                'file' => 'GqIcQlspcqsXSx9tOZTxM89X12EMCXU623jgebF7.docx',
            ],
            [
                'nama' => 'Template Import NIK Mitra',
                'jenis' => 'import',
                'file' => 'DCxKlHfNoJ9SXMseOLJY7VtNR6XPxrtf9jVVnI2k.xlsx',
            ],
            [
                'nama' => 'Template Surat Tugas dan SPPD',
                'jenis' => 'sppd',
                'file' => 'NZ0yEZ9wHjPNsSGMUIoQaTjMBiKNLLUTtsFs9Rb9.docx',
            ],
            [
                'nama' => 'Template Undangan Rapat',
                'jenis' => 'undangan',
                'file' => '32Sq1RlqXpn9GNW1JUTmX5kiSih8wLug4pcacciH.docx',
            ],
            [
                'nama' => 'Template Daftar Hadir Rapat',
                'jenis' => 'daftar_hadir',
                'file' => 'rSe0mZotTa5o5vqMYOjF1fJGFXSzeWecJPnb5aDD.docx',
            ],
            [
                'nama' => 'Template Notula Rapat',
                'jenis' => 'notula',
                'file' => 'UUdKH4hsS43urXk16jFPJe50eJuAWkhyb9GTJtaV.docx',
            ],
            [
                'nama' => 'Template Import Master Wilayah',
                'jenis' => 'import',
                'file' => 'BuyPo9w8pzuhPqE3t9QTzEt3yigtVNYC5O2ExHe5.xlsx',
            ],
            [
                'nama' => 'Template Import Nilai SKP',
                'jenis' => 'import',
                'file' => 'RW2LxwcWpTAe98xaTars8i2vDEh7XDScBr9OKyjj.xlsx',
            ],
        ];

        foreach ($templates as $template) {
            Template::create($template);
        }

        $this->call('simpede:cache');
        $is_public_html = select('Apakah Anda menggunakan public_html sebagai folder publik?', ['Ya', 'Tidak'], 'Ya');
        if ($is_public_html == 'Ya') {
            $this->info('Membuat symlink public_html');
            $process = new Process(['ln', '-s', 'public_html', 'public']);
            $process->run();
        }
        $this->info('Membuat storage symlink');
        $this->call('storage:link');
        $this->info('Simpede berhasil diinstall. Silakan login dengan user admin yang baru saja dibuat.');
    }
}
