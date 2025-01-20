![Simpede logo](resources/img/dark.svg#gh-dark-mode-only)
![Simpede logo](resources/img/light.svg#gh-light-mode-only)

[![StyleCI](https://github.styleci.io/repos/840671846/shield?branch=main)](https://github.styleci.io/repos/840671846?branch=main)

## Tentang Simpede

Simpede adalah aplikasi untuk membantu ketatausahaan. Fitur:

- Pengelolaan Kerangka Acuan Kerja: Fitur yang disediakan untuk membuat Kerangka Acuan Kerja yang dapat diunduh dalam format Microsoft Word dan mengarsipkan softcopy berkas-berkas terkait Kerangka Acuan Kerja.
- Pengelolaan Naskah Dinas: Fitur yang disediakan untuk membuat nomor naskah dinas keluar dan melakukan pengarsipan naskah dinas masuk dan naskah dinas keluar dalam bentuk softcopy.
- Pengelolaan Kepegawaian: Fitur yang disediakan untuk mendokumentasikan izin keluar kantor untuk pegawai dan penganugerahan gelar Employee of the Month
- Pengelolaan Kontrak Mitra Statistik: Fitur yang disediakan untuk memonitor kesesuaian kontrak dengan SBML, mencetak kontrak dan BAST, export csv CMS BRI, mencetak SK, Surat Tugas dan SPJ Honor Mitra serta Mengarsipkan Softcopy Kontrak dan BAST.
- Pengelolaan Barang Persediaan: Fitur yang disediakan untuk mencatat transfer masuk, transfer keluar, mencetak BON Permintaan dan mencetak Kartu Kendali Barang Persediaan, serta mengidentifikasi Kode Barang Persediaan (Aktualisasi Latsar Hasyimur Rusdi).
- Monitoring Anggaran: Fitur yang disediakan untuk memonitor serapan anggaran dan rencana penarikan dana.
- Pemeliharaan BMN: Fitur yang disediakan untuk memonitor pemeliharaan Barang Milik Negara dan mencetak Kartu Kendali Pemeliharaan.
- Perjalanan Dinas: Fitur yang disediakan untuk membuat Surat Tugas dan Surat Perintah Perjalanan Dinas, mencetak kuitansi perjalanan dinas dan Surat Pernyataan Tidak Menggunakan Kendaran Dinas
- Dokumentasi: Fitur yang disediakan untuk menyimpan dokumentasi foto-foto kegiatan dan link-link penting.
- Manajemen Rapat: Fitur yang disediakan untuk membuat Surat Undangan, Daftar Hadir dan Template Notula rapat internal
- Kalender Kegiatan: Fitur yang menampilkan kalender kegiatan,deadline dan tanggal penting lainnya. 
- Reminder: Fitur untuk mengirimkan reminder deadline kegiatan (Aktualisasi Latsar Ilman 'Mimin' Maulana)
## Requirement

Dibuat menggunakan Laravel 11 dan memerlukan ekstensi server berikut:
- PHP >= 8.2
- Ctype PHP Extension
- cURL PHP Extension
- DOM PHP Extension
- Fileinfo PHP Extension
- Filter PHP Extension
- Hash PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PCRE PHP Extension
- PDO PHP Extension
- Session PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension
- GD/imagick

## Deployment

Rekomendasi shared hosting murah: 
<p><a href="https://niagahoster.co.id?REFERRALCODE=NH8UMUMHSEQ5" target="_blank">
<img src="https://www.cuponation.co.id/images/fit-in/256x/images/n/niagahoster.png">
</a></p>

- Enable Symlink:
  Masuk ke Hpanel website Anda, Pilih `Advanced` -> `PHP Configuration` -> `PHP Option` di bagian `disableFunctions` hapus `symlink`
- Buat database.
- Hapus seluruh folder dan file yang ada di root domain.
- Connect via terminal menggunakan SSH.
- Arahkan ke folder root domain.
- Clone Simpede Repository: 
    ```bash
    git clone https://github.com/laravelwebdev/simpede.git .
    ```
- Buat symlink dari public_html
    ```bash
    ln -s public public_html
    ```
    
- Update dependencies (gunakan composer2):
    ```bash
    composer2 update --no-dev
    ```

- Rename file `.env.example` menjadi `.env` dan edit variabel berikut:
    * `APP_URL`: URL website.
    * `DB_HOST`: Host database, biasanya `localhost`.
    * `DB_PORT`: Port database mariadb biasanya `3306`.
    * `DB_DATABASE`: Nama database.
    * `DB_USERNAME`: User database.
    * `DB_PASSWORD`: Password database.
    * `APP_ENV`: Set menjadi `production`.
    * `APP_DEBUG`: Set menjadi `false`.
    * `LOG_CHANNEL`: set menjadi `"null"`
    * `INITIAL_YEAR`: set menjadi tahun pertama aplikasi digunakan

- Ubah seluruh setting di bagian `# CONFIG SATKER` pada file `.env` sesuai dengan satker Anda. 
- Generate Key:
    ```bash
    php artisan key:generate
    ```
- Lakukan migrasi database:
    ```bash
    php artisan migrate --seed
    ```

    
## Maintenance Mode

- Untuk menampilkan website sedang dalam kondisi Maintenance jalankan command berikut:
    ```bash
    php artisan maintenance:start
    ```
- Untuk membuat website live kembali setelah maintenance gunakan command:
    ```bash
    php artisan maintenance:stop
    ```

## Setup Fonnte

Aplikasi ini menggunakan Whatsapp API dari [Fonnte](https://fonnte.com) agar bisa mengirimkan reminder melalui Whatsapp. Disarankan menggunakan nomor khusus untuk mengirimkan pesan untuk berjaga-jaga apabila nomor tersebut nantinya dibanned oleh Whatsapp.

- Ubah setting Fonnte pada file `.env`
    * `FONNTE_TOKEN`: Isi dengan token fonnte.com.
    * `FONNTE_NUMBER`: Isi dengan nomor whatsapp yang digunakan pada fonnte.com.
    * `FONNTE_HOUR`: Isi dengan jam pengiriman pesan reminder (sesuaikan dengan pengaturan Cron Job)
- Login ke akun fonnte Anda, dan tambahkan link berikut pada webhook `Whatsapp Message Status` 
    ```bash 
    https://domainanda/webhook.php (Sesuaikan dengan nama domain Anda)
    ```
- Setting Cron Job untuk menjalankan perintah berikut: 
    ```bash
    php artisan reminder:send (Contoh: /usr/bin/php /home/u770759286/domains/devbeta.site/artisan reminder:send)
    ```

## Setup Sentry
Aplikasi ini menggunakan website [Sentry](https://sentry.io/) sebagai sarana untuk memonitor error dan performa.
- Ubah setting Sentry pada file `.env`
  * `SENTRY_LARAVEL_DSN`: Isi DSN Sentry yang anda miliki.
