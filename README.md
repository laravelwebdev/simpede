![Simpede logo](resources/img/dark.svg#gh-dark-mode-only)
![Simpede logo](resources/img/light.svg#gh-light-mode-only)

[![StyleCI](https://github.styleci.io/repos/840671846/shield?branch=main)](https://github.styleci.io/repos/840671846?branch=main)

## Tentang Simpede

Simpede adalah aplikasi untuk membantu ketatausahaan. Fitur:

- Manajemen naskah Dinas(Penomoran Surat, Pengarsipan Naskah Dinas masuk dan keluar)
- Pembuatan Kerangka Acuan Kerja
- Manajemen Izin Keluar Kantor Pegawai
- Manajemen Kontrak Bulanan Mitra (Monitoring, SK, Kontrak, BAST, Surat Tugas, SPJ)
- Manajemen Barang Persediaan (Transfer masuk, Transfer Keluar, Persediaan masuk, persediaan keluar)
- Manajemen Dokumen Pengadaan Barang Jasa (to do list)


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
- Update dependencies (gunakan composer2):
    ```bash
    composer2 update --no-dev
    ```

- Rename file .env.example menjadi .env dan edit variabel berikut:
    * `APP_URL`: URL website.
    * `DB_HOST`: Host database, biasanya `localhost`.
    * `DB_PORT`: Port database mariadb biasanya `3306`.
    * `DB_DATABASE`: Nama database.
    * `DB_USERNAME`: User database.
    * `DB_PASSWORD`: Password database.
    * `APP_ENV`: Set menjadi `production`.
    * `APP_DEBUG`: Set menjadi `false`.
    * `LOG_CHANNEL`: set menjadi `"null"`

- Generate Key:
    ```bash
    php artisan key:generate
    ```
- Lakukan migrasi database:
    ```bash
    php artisan migrate --seed
    ```
- Buat symlink dari public_html
    ```bash
    ln -s public public_html
    ```
    
- Jalankan command:
    ```bash
    php artisan storage:link
    ```
- Jalankan command:
    ```bash
    php artisan optimize
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


