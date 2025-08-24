<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simpede</title>
        <link rel="stylesheet" href="{{ asset('css/tailwind.min.css')}}">
        <style>
            .image-container {
                border-radius: 10px;
                overflow: hidden;
                display: flex;
                justify-content: center;
                align-items: center;
            }
    
            .image-container img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                opacity: 0.75;
            }

             /* Default selection color */
            ::selection {
                background-color:rgb(19, 207, 182); /* Light orange */
                color: #ffffff; /* White text */
            }

            /* For Mozilla browsers */
            ::-moz-selection {
                background-color:rgb(19, 207, 182);
                color: #ffffff;
            }

        </style>
    </head>
    
    <body class="font-libre_franklin text-base text-black dark:text-white bg-white dark:bg-slate-900">
       
        <!-- Navbar Start -->
        <nav class="navbar" id="navbar">
            <div class="container relative flex flex-wrap items-center justify-between">
                <a class="navbar-brand md:me-8 w-40" href="#" style="width:160px;">
                    <img src="{{ asset('images/light.svg') }}" class="inline-block dark:hidden" alt="">
                    <img src="{{ asset('images/dark.svg') }}" class="hidden dark:inline-block" alt="">
                </a>

                <div class="nav-icons flex items-center lg_992:order-2 ms-auto md:ms-8">
                    <!-- Navbar Button -->
                    @if (Route::has('login'))
                    <ul class="list-none menu-social mb-0">
                        <li class="inline">
                            @auth
                            <a href="{{ config('nova.path') }}" class="h-8 px-4 text-[12px] tracking-wider inline-flex items-center justify-center font-medium rounded-md bg-teal-500 text-white uppercase">Panel</a>
                            @else
                            <a href="{{ route('login') }}" class="h-8 px-4 text-[12px] tracking-wider inline-flex items-center justify-center font-medium rounded-md bg-teal-500 text-white uppercase">Masuk</a>
                            @endauth
                        </li> 
                    </ul>
                    @endif
                    <div id="theme-toggle" class="p-4">
                        <i id="sun-icon" data-feather="sun"></i>  
                        <i id="moon-icon" data-feather="moon"></i>   
                        <i id="system-icon" data-feather="monitor"></i>                
                    </div>
                    <!-- Navbar Collapse Manu Button -->
                    <button data-collapse="menu-collapse" type="button" class="collapse-btn inline-flex items-center ms-2 text-dark dark:text-white lg_992:hidden" aria-controls="menu-collapse" aria-expanded="false">
                        <span class="sr-only">Navigation Menu</span>
                        <i data-feather="menu"></i>
                    </button>
                </div>

                <!-- Navbar Manu -->
                <div class="navigation lg_992:order-1 lg_992:flex hidden ms-auto" id="menu-collapse">
                    <ul class="navbar-nav" id="navbar-navlist">
                        <li class="nav-item">
                            <a class="nav-link active dark:text-gray-200" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dark:text-gray-200" href="#fitur">Fitur</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dark:text-gray-200" target="_blank" href="https://docs.simpede.my.id">Panduan</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Start Hero -->
        <section class="relative md:py-48 py-40 bg-teal-500/10 dark:bg-teal-500/20" id="home">
            <div class="container relative mt-8">
                <div class="grid md:grid-cols-2 grid-cols-1 gap-6 items-center">
                    <div>
                        <h1 class="font-semibold lg:leading-normal leading-normal tracking-wide text-4xl lg:text-5xl mb-5">Simpede</h1>
                        <p class="text-slate-400 text-lg max-w-xl">Aplikasi Sistem Integrasi Pekerjaan dan Dokumentasi secara Elektronik (Simpede) merupakan aplikasi yang dirancang untuk menyederhanakan proses ketatausahaan dengan menyediakan fitur-fitur komprehensif.</p>
                        
                        <div class="mt-6">
                            <a target="_blank" href="https://docs.simpede.my.id" class="h-10 px-6 tracking-wide inline-flex items-center justify-center font-medium rounded-md bg-teal-500 text-white">Panduan</a>
                        </div>
                    </div>

                    <div class="lg:ms-8">
                        <div class="relative image-container">
                            <img src="{{ asset('images/hero-media-dark.png') }}" class="relative top-8 hidden dark:inline-block" alt="">
                            <img src="{{ asset('images/hero-media-light.png') }}" class="relative top-8 inline-block dark:hidden" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section><!--end section-->
        <!-- End Hero -->

        <!-- Start Feature -->
        <section class="relative md:py-24 py-16 bg-slate-50 dark:bg-slate-800" id="fitur">
            <div class="container relative">
                <div class="grid grid-cols-1 pb-6 text-center">
                    <h3 class="font-semibold text-2xl leading-normal mb-4">Fitur</h3>

                    <p class="text-slate-400 max-w-xl mx-auto">Berikut adalah fitur-fitur yang tersedia pada aplikasi Simpede:</p>
                </div><!--end grid-->

                <div class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-2 grid-cols-1 gap-6 mt-6">
                    
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="truck" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a href="" class="title text-lg font-semibold hover:text-teal-500">Perjalanan Dinas</a>
                            <p class="text-slate-400 mt-3">Pembuatan Nomor Surat Tugas</p>
                            <p class="text-slate-400 mt-3">Pembuatan Nomor SPPD</p>
                            <p class="text-slate-400 mt-3">Pembuatan Surat Tugas</p>
                            <p class="text-slate-400 mt-3">Pembuatan SPPD</p>
                            <p class="text-slate-400 mt-3">Pembuatan Kuitansi</p>
                            <p class="text-slate-400 mt-3">Pembuatan Pernyataan Tidak Menggunakan Kendaraan Dinas</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="truck" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="archive" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Pengelolaan Barang Persediaan</a>
                            <p class="text-slate-400 mt-3">Pencatatan Barang Persediaan Masuk</p>
                            <p class="text-slate-400 mt-3">Pencatatan Barang Persediaan Keluar</p>
                            <p class="text-slate-400 mt-3">Pembuatan Bon Permintaan Barang Persediaan</p>
                            <p class="text-slate-400 mt-3">Kartu Kendali Barang Persediaan</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="archive" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="users" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Mitra Statistik</a>
                            <p class="text-slate-400 mt-3">Pembuatan SPJ Honor</p>
                            <p class="text-slate-400 mt-3">Pembuatan Surat Tugas Mitra</p>
                            <p class="text-slate-400 mt-3">Pembuatan SK Mitra</p>
                            <p class="text-slate-400 mt-3">Pembuatan Kontrak Mitra</p>
                            <p class="text-slate-400 mt-3">Pembuatan BAST Kontrak Mitra</p>
                            <p class="text-slate-400 mt-3">Template CMS BRI</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="users" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->

    

                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="user-check" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a  class="title text-lg font-semibold hover:text-teal-500">Kepegawaian</a>
                            <p class="text-slate-400 mt-3">Pembuatan Kertas Kerja untuk <em>Employee of the Month</em></p>
                            <p class="text-slate-400 mt-3">Pembuatan SK untuk <em>Employee of the Month</em></p>
                            <p class="text-slate-400 mt-3">Pembuatan Sertifikat untuk <em>Employee of the Month</em></p>
                            <p class="text-slate-400 mt-3">Pencatatan Izin Keluar Kantor</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="user-check" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="trending-up" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Pengelolaan SAKIP</a>
                            <p class="text-slate-400 mt-3">Pendokumentasian Realisasi Kinerja</p>
                            <p class="text-slate-400 mt-3">Pendokumentasian Kendala dan Solusi</p>
                            <p class="text-slate-400 mt-3">Pendokumentasian Rencana Tindak Lanjut</p>
                            <p class="text-slate-400 mt-3">Pendokumentasian Pelaksanaan Tindak Lanjut</p> 
                        </div>
                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="trending-up" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="camera" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Pendokumentasian Kegiatan</a>
                            <p class="text-slate-400 mt-3">Pendokumentasian Arsip Naskah Masuk</p>
                            <p class="text-slate-400 mt-3">Pendokumentasian Arsip Naskah Keluar</p>
                            <p class="text-slate-400 mt-3">Pendokumentasian Foto-Foto Kegiatan</p>
                        </div>
                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="camera" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="wifi" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Pulsa Mitra</a>
                            <p class="text-slate-400 mt-3">Rekapitulasi Bulanan Penggantian Pulsa Mitra</p>
                            <p class="text-slate-400 mt-3">Form Konfirmasi Nomor Handphone</p>
                            <p class="text-slate-400 mt-3">Form upload bukti masuk pulsa</p>
                            <p class="text-slate-400 mt-3">Cetak Otomatis tanda terima pulsa</p>
                       
                        </div>
                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="wifi" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="file-text" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a  class="title text-lg font-semibold hover:text-teal-500">Kerangka Acuan Kerja</a>
                            <p class="text-slate-400 mt-3">Pembuatan Kerangka Acuan Kerja</p>
                            <p class="text-slate-400 mt-3">Pembuatan Nomor Form Permintaan</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="file-text" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="calendar" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Kalender Kegiatan</a>
                            <p class="text-slate-400 mt-3">Kalender Kegiatan</p>
                            <p class="text-slate-400 mt-3">Pembuatan Reminder Kegiatan melalui <em>Whatsapp</em></p>   
                        </div>
                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="calendar" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->                   


                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="coffee" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Rapat</a>
                            <p class="text-slate-400 mt-3">Pembuatan Undangan Rapat</p>
                            <p class="text-slate-400 mt-3">Template Daftar Hadir Rapat</p>
                            <p class="text-slate-400 mt-3">Template Notula Rapat</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="coffee" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="mail" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Naskah Dinas</a>
                            <p class="text-slate-400 mt-3">Pembuatan Nomor Naskah Keluar</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="mail" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="home" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Pemeliharaan BMN</a>
                            <p class="text-slate-400 mt-3">Kartu Kendali Pemeliharaan BMN</p>
                        </div>

                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="home" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->

                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="link-2" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Pendokumentasian Link</a>
                            <p class="text-slate-400 mt-3">Pendokumentasian Tautan Penting</p>  
                        </div>
                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="link-2" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->

                    <div class="group rounded-md shadow dark:shadow-gray-700 relative bg-white dark:bg-slate-900 p-6 overflow-hidden md:h-[400px] lg:h-[400px]">
                        <div class="flex items-center justify-center size-14 -rotate-45 bg-gradient-to-r from-transparent to-teal-500/10 text-teal-500 text-center rounded-full group-hover:bg-teal-500/10 duration-500">
                            <i data-feather="credit-card" class="size-6 rotate-45"></i>
                        </div>

                        <div class="content mt-6 relative z-1">
                            <a class="title text-lg font-semibold hover:text-teal-500">Digital Payment</a>
                            <p class="text-slate-400 mt-3">Monitoring penggunaan CMS dan Kartu Kredit Pemerintah (KKP)</p>  
                        </div>
                        <div class="absolute bottom-0 -end-16">
                            <i data-feather="credit-card" class="size-48 text-teal-500 opacity-[0.04] dark:opacity-[0.04] group-hover:opacity-10 duration-500"></i>
                        </div>
                    </div><!--end feature content-->
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End Features -->

        <!-- Start Process -->
        <section class="realtive md:py-24 py-16">
            <div class="container relative">
                <div class="grid grid-cols-1 pb-6 text-center">
                    <h3 class="font-semibold text-2xl leading-normal mb-4">Panduan, Monitoring dan Pengelolaan Arsip</h3>

                    <p class="text-slate-400 max-w-xl mx-auto">Simpede telah dilengkapi dengan panduan penggunaan, dashboard monitoring dan Pengelolaan <em>Softcopy</em> Arsip SPJ Keuangan</p>
                </div><!--end grid-->

                <div class="grid md:grid-cols-12 grid-cols-1 mt-6 gap-6">
                    <div class="lg:col-span-4 md:col-span-5">
                        <div class="sticky top-20">
                            <ul class="flex-column p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                                <li role="presentation">
                                    <button class="px-4 py-2 text-start text-base font-medium rounded-md w-full hover:text-teal-500 duration-500" id="profile-tab" data-tabs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="true">
                                        <span class="text-lg mt-2 block">Panduan Penggunaan</span>
                                        <span class="block mt-2">Simpede telah dilengkapi dengan panduan penggunaan</span>
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button class="px-4 py-2 text-start text-base font-medium rounded-md w-full mt-6 duration-500" id="dashboard-tab" data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard" aria-selected="false">
                                        <span class="text-lg mt-2 block">Dashboard Monitoring</span>
                                        <span class="block mt-2">Simpede telah dilengkapi dengan Dashboard Monitoring</span>
                                    </button>
                                </li>
                                <li role="presentation">
                                    <button class="px-4 py-2 text-start text-base font-medium rounded-md w-full mt-6 duration-500" id="settings-tab" data-tabs-target="#settings" type="button" role="tab" aria-controls="settings" aria-selected="false">
                                        <span class="text-lg mt-2 block">Dokumentasi SPJ Keuangan</span>
                                        <span class="block mt-2">Simpede telah dilengkapi dengan fitur untuk melakukan pengelolaan SPJ keuangan</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="lg:col-span-8 md:col-span-7">
                        <div id="myTabContent" class="p-6 bg-white dark:bg-slate-900 shadow dark:shadow-gray-700 rounded-md">
                            <div class="" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <img src="{{ asset('images/docs-light.png') }}" class="shadow dark:shadow-gray-700 rounded-md inline-block dark:hidden" alt="">
                                <img src="{{ asset('images/docs-dark.png') }}" class="shadow dark:shadow-gray-700 rounded-md hidden dark:inline-block" alt="">
                                <div class="mt-6">
                                    <h5 class="text-lg font-medium">Panduan Penggunaan</h5>
                                    <p class="text-slate-400 mt-4">Panduan lengkap penggunaan Aplikasi Simpede untuk mempermudah pengguna dalam memahami fitur-fitur dan cara pengoperasian sistem.</p>
                                    <div class="mt-4">
                                        <a href="https://docs.simpede.my.id" class="text-teal-500">Baca Panduan<i class="mdi mdi-chevron-right align-middle"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="hidden " id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <img src="{{ asset('images/monitoring-light.png') }}" class="shadow dark:shadow-gray-700 rounded-md inline-block dark:hidden" alt="">
                                <img src="{{ asset('images/monitoring-dark.png') }}" class="shadow dark:shadow-gray-700 rounded-md hidden dark:inline-block" alt="">
                                <div class="mt-6">
                                    <h5 class="text-lg font-medium">Dashboard Monitoring</h5>
                                    <p class="text-slate-400 mt-4">Dashboard Monitoring menyediakan informasi real-time mengenai honor mitra, serapan anggaran, rencana penarikan dana, form rencana aksi, barang persediaan, dan pemeliharaan BMN. Hal ini memungkinkan pengguna untuk memantau dan mengelola berbagai aspek operasional secara efisien dan efektif.</p>
                                 </div>
                            </div>
                            <div class="hidden " id="settings" role="tabpanel" aria-labelledby="settings-tab">
                                <img src="{{ asset('images/features-box-light.png') }}" class="shadow dark:shadow-gray-700 rounded-md inline-block dark:hidden" alt="">
                                <img src="{{ asset('images/features-box-dark.png') }}" class="shadow dark:shadow-gray-700 rounded-md hidden dark:inline-block" alt="">
                                <div class="mt-6">
                                    <h5 class="text-lg font-medium">Arsip SPJ Keuangan</h5>
                                    <p class="text-slate-400 mt-4">Pendokumentasian SPJ Keuangan berupa <em>softcopy</em> yang telah dikelompokkan menurut jenis dokumen, mata anggaran, dan kegiatan. Hal ini bertujuan untuk mempermudah pencarian dan pengelolaan dokumen keuangan secara efisien dan terstruktur.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--end grid-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End Process -->

        <!-- End -->


        <!-- Footer Start -->
        <footer class="footer bg-dark-footer relative text-gray-200 dark:text-gray-200">
            <div class="py-[30px] px-0 border-t border-slate-800">
                <div class="container relative text-center">
                    <div class="lg:col-span-5 text-center mt-6 md:mt-0">
                        <p>
                            Sistem Integrasi Pekerjaan dan Dokumentasi secara Elektronik
                            &middot; v.{{ $version }}
                            <br />
                            Copyright &copy; 2021 -
                            <span id="copyright">
                              <script>
                                document
                                  .getElementById("copyright")
                                  .appendChild(
                                    document.createTextNode(new Date().getFullYear()),
                                  );
                              </script>
                            </span>
                            <a href="{{ config('satker.website') }}" target="_blank">
                              {{ $satker }}
                            </a>
                        </p>
                    </div>
                </div><!--end container-->
            </div>
        </footer><!--end footer-->
        <!-- Footer End -->

        <!-- Back to top -->
        <a href="#" onclick="topFunction()" id="back-to-top" class="back-to-top fixed hidden text-lg rounded-full z-10 bottom-5 right-5 w-12 h-12 flex items-center justify-center bg-teal-500 text-white"><i data-feather="arrow-up"></i></a>
        <!-- Back to top -->

        <!-- LTR & RTL Mode Code -->
        <div class="fixed top-[40%] -right-3 z-50">
            <a href="" id="switchRtl">
                <span class="py-1 px-3 relative inline-block rounded-t-md -rotate-90 bg-white dark:bg-slate-900 shadow-md dark:shadow dark:shadow-gray-800 font-medium rtl:block ltr:hidden" >LTR</span>
                <span class="py-1 px-3 relative inline-block rounded-t-md -rotate-90 bg-white dark:bg-slate-900 shadow-md dark:shadow dark:shadow-gray-800 font-medium ltr:block rtl:hidden">RTL</span>
            </a>
        </div>
        <!-- LTR & RTL Mode Code -->

        <!-- JAVASCRIPTS -->
        <script src="{{ asset('js/feather.min.js') }}"></script>
        <script src="{{ asset('js/gumshoe.polyfills.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/plugins.init.js') }}"></script>
        <!-- JAVASCRIPTS -->
    </body>
</html>