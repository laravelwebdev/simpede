<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simpede</title>
    <link href="https://fonts.googleapis.com/css?family=Heebo:400,700|IBM+Plex+Sans:600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>
</head>
<body class="is-boxed has-animations">
    <div class="body-wrap boxed-container">
        <header class="site-header">
            <div class="container">
                <div class="site-header-inner">
                    <div class="brand header-brand">
                        <h1 class="m-0">
                            <a href="#">
								<img class="header-logo-image asset-light" src="{{ asset('images/light.svg') }}" alt="Logo">
								<img class="header-logo-image asset-dark" src="{{ asset('images/dark.svg') }}" alt="Logo">
                            </a>
                        </h1>
                    </div>  
              
                    <div
                    id="theme-toggle" class="theme-toggle"
                    >
                    <svg id="theme-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path id="sun-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                      <path id="moon-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                      <path id="system-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"  />
                    </svg>                    
                    </div>
                </div>
            </div>
        </header>

        <main>
            <section class="hero">
                <div class="container">
                    <div class="hero-inner">
						<div class="hero-copy">
	                        <h1 class="hero-title mt-0">Simpede</h1>
	                        <p class="hero-paragraph">Aplikasi Sistem Integrasi Pekerjaan dan Dokumentasi secara Elektronik (Simpede) merupakan aplikasi yang dirancang untuk menyederhanakan proses ketatausahaan dengan menyediakan fitur-fitur komprehensif.</p>
	                        @if (Route::has('login'))
                            <div class="hero-cta">
                                @auth
								<a class="button button-primary" href="{{ config('nova.path') }}">Dashboard</a>		
                                @else
                                <a class="button button-primary" href="{{ route('login') }}">Masuk</a>
                                @endauth
							</div>
                            @endif
						</div>
						<div class="hero-media">
							<div class="header-illustration">
								<img class="header-illustration-image asset-light" src="{{ asset('images/header-illustration-light.svg') }}" alt="Header illustration">
								<img class="header-illustration-image asset-dark" src="{{ asset('images/header-illustration-dark.svg') }}" alt="Header illustration">
							</div>
							<div class="hero-media-illustration">
								<img class="hero-media-illustration-image asset-light" src="{{ asset('images/hero-media-illustration-light.svg') }}" alt="Hero media illustration">
								<img class="hero-media-illustration-image asset-dark" src="{{ asset('images/hero-media-illustration-dark.svg') }}" alt="Hero media illustration">
							</div>
							<div class="hero-media-container">
								<img class="hero-media-image asset-light" src="{{ asset('images/hero-media-light.png') }}" alt="Hero media">
								<img class="hero-media-image asset-dark" src="{{ asset('images/hero-media-dark.png') }}" alt="Hero media">
							</div>
						</div>
                    </div>
                </div>
            </section>

            <section class="features section">
                <div class="container">
					<div class="features-inner section-inner has-bottom-divider">
						<div class="features-header text-center">
							<div class="container-sm">
								<h2 class="section-title mt-0">Panduan Penggunaan</h2>                                
                                <p class="section-paragraph">Panduan lengkap penggunaan Aplikasi Simpede untuk mempermudah pengguna dalam memahami fitur-fitur dan cara pengoperasian sistem.</p>
                                <div class="cta-cta">
                                    <a target="_blank" class="button button-primary" href="https://docs.simpede.my.id">Akses Panduan</a>
                                </div>
                                <div class="features-image">
                                    <img class="features-illustration asset-dark" src="{{ asset('images/features-illustration-dark.svg') }}" alt="Feature illustration">
                                    <img class="features-box asset-dark" src="{{ asset('images/docs-dark.png') }}" alt="Feature box">
                                    <img class="features-illustration asset-dark" src="{{ asset('images/features-illustration-top-dark.svg') }}" alt="Feature illustration top">
                                    <img class="features-illustration asset-light" src="{{ asset('images/features-illustration-light.svg') }}" alt="Feature illustration">
                                    <img class="features-box asset-light" src="{{ asset('images/docs-light.png') }}" alt="Feature box">
                                    <img class="features-illustration asset-light" src="{{ asset('images/features-illustration-top-light.svg') }}" alt="Feature illustration top">
								</div>
							</div>
                        </div>
                        <div class="cta-header text-center">
                            <h2 class="section-title mt-0">Fitur</h2>
                            <p class="section-paragraph">Panduan lengkap penggunaan Aplikasi Simpede untuk mempermudah pengguna dalam memahami fitur-fitur dan cara pengoperasian sistem.</p>
					    </div>
                        <div class="features-wrap">
							<div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Kerangka Acuan Kerja</h3>
                                        <p class="text-sm mb-0">Pembuatan Kerangka Acuan Kerja</p>
                                        <p class="text-sm mb-0">Pembuatan Nomor Form Permintaan</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Naskah Dinas</h3>
                                        <p class="text-sm mb-0">Pembuatan Nomor Naskah Keluar</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Kepegawaian</h3>
                                        <p class="text-sm mb-0">Pembuatan Kertas Kerja untuk <em>Employee of the Month</em></p>
                                        <p class="text-sm mb-0">Pembuatan SK untuk <em>Employee of the Month</em></p>
                                        <p class="text-sm mb-0">Pembuatan Sertifikat untuk <em>Employee of the Month</em></p>
                                        <p class="text-sm mb-0">Pencatatan Izin Keluar Kantor</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Mitra Statistik</h3>
                                        <p class="text-sm mb-0">Pembuatan SPJ Honor</p>
                                        <p class="text-sm mb-0">Pembuatan Surat Tugas Mitra</p>
                                        <p class="text-sm mb-0">Pembuatan SK Mitra</p>
                                        <p class="text-sm mb-0">Pembuatan Kontrak Mitra</p>
                                        <p class="text-sm mb-0">Pembuatan BAST Kontrak Mitra</p>
                                        <p class="text-sm mb-0">Template CMS BRI</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                    	<h3 class="feature-title mt-0">Rapat</h3>
                                        <p class="text-sm mb-0">Pembuatan Undangan Rapat</p>
                                        <p class="text-sm mb-0">Template Daftar Hadir Rapat</p>
                                        <p class="text-sm mb-0">Template Notula Rapat</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                        <h3 class="feature-title mt-0">Pengelolaan Barang Persediaan</h3>
                                        <p class="text-sm mb-0">Pencatatan Barang Persediaan Masuk</p>
                                        <p class="text-sm mb-0">Pencatatan Barang Persediaan Keluar</p>
                                        <p class="text-sm mb-0">Pembuatan Bon Permintaan Barang Persediaan</p>
                                        <p class="text-sm mb-0">Kartu Kendali Barang Persediaan</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                        <h3 class="feature-title mt-0">Pemeliharaan BMN</h3>
                                        <p class="text-sm mb-0">Kartu Kendali Pemeliharaan BMN</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                        <h3 class="feature-title mt-0">Perjalanan Dinas</h3>
                                        <p class="text-sm mb-0">Pembuatan Nomor Surat Tugas</p>
                                        <p class="text-sm mb-0">Pembuatan Nomor SPPD</p>
                                        <p class="text-sm mb-0">Pembuatan Surat Tugas</p>
                                        <p class="text-sm mb-0">Pembuatan SPPD</p>
                                        <p class="text-sm mb-0">Pembuatan Kuitansi</p>
                                        <p class="text-sm mb-0">Pembuatan Pernyataan Tidak Menggunakan Kendaraan Dinas</p>
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                        <h3 class="feature-title mt-0">Pendokumentasian Link dan Kegiatan</h3>
                                        <p class="text-sm mb-0">Pendokumentasian Arsip Naskah Masuk</p>
                                        <p class="text-sm mb-0">Pendokumentasian Arsip Naskah Keluar</p>
                                        <p class="text-sm mb-0">Pendokumentasian Foto-Foto Kegiatan</p>
                                        <p class="text-sm mb-0">Pendokumentasian Tautan Penting</p>                                        
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                        <h3 class="feature-title mt-0">Kalender Kegiatan</h3>
                                        <p class="text-sm mb-0">Kalender Kegiatan</p>
                                        <p class="text-sm mb-0">Pembuatan Reminder Kegiatan melalui <em>Whatsapp</em></p>                                 
									</div>
								</div>
                            </div>
                            <div class="feature is-revealing">
                                <div class="feature-inner">
                                    <div class="feature-icon">
										<img class="asset-light" src="{{ asset('images/feature-02-light.svg') }}" alt="Feature 02">
										<img class="asset-dark" src="{{ asset('images/feature-02-dark.svg') }}" alt="Feature 02">
                                    </div>
									<div class="feature-content">
                                        <h3 class="feature-title mt-0">Pengelolaan SAKIP</h3>
                                        <p class="text-sm mb-0">Pendokumentasian Realisasi Kinerja</p>
                                        <p class="text-sm mb-0">Pendokumentasian Kendala dan Solusi</p>
                                        <p class="text-sm mb-0">Pendokumentasian Rencana Tindak Lanjut</p>
                                        <p class="text-sm mb-0">Pendokumentasian Pelaksanaan Tindak Lanjut</p>
									</div>
								</div>
                            </div>
                        </div>
                        <div class="features-header text-center">
							<div class="container-sm">
                                <div class="features-image">
                                    <img class="features-illustration asset-dark" src="{{ asset('images/features-illustration-dark.svg') }}" alt="Feature illustration">
                                    <img class="features-box asset-dark" src="{{ asset('images/monitoring-dark.png') }}" alt="Feature box">
                                    <img class="features-illustration asset-dark" src="{{ asset('images/features-illustration-top-dark.svg') }}" alt="Feature illustration top">
                                    <img class="features-illustration asset-light" src="{{ asset('images/features-illustration-light.svg') }}" alt="Feature illustration">
                                    <img class="features-box asset-light" src="{{ asset('images/monitoring-light.png') }}" alt="Feature box">
                                    <img class="features-illustration asset-light" src="{{ asset('images/features-illustration-top-light.svg') }}" alt="Feature illustration top">
								</div>
                                <div class="cta-header text-center">
                                    <h2 class="section-title mt-0">Dashboard Monitoring</h2>
                                    <p class="section-paragraph">Dashboard Monitoring menyediakan informasi real-time mengenai honor mitra, serapan anggaran, rencana penarikan dana, form rencana aksi, barang persediaan, dan pemeliharaan BMN. Hal ini memungkinkan pengguna untuk memantau dan mengelola berbagai aspek operasional secara efisien dan efektif.</p>
                                </div>
							</div>
                        </div>

                    </div>
                </div>
            </section>
			<section class="cta section">
                <div class="container-sm">
                    <div class="cta-inner section-inner">
                        <div class="features-image">
                            <img class="features-illustration asset-dark" src="{{ asset('images/features-illustration-dark.svg') }}" alt="Feature illustration">
                            <img class="features-box asset-dark" src="{{ asset('images/features-box-dark.png') }}" alt="Feature box">
                            <img class="features-illustration asset-dark" src="{{ asset('images/features-illustration-top-dark.svg') }}" alt="Feature illustration top">
                            <img class="features-illustration asset-light" src="{{ asset('images/features-illustration-light.svg') }}" alt="Feature illustration">
                            <img class="features-box asset-light" src="{{ asset('images/features-box-light.png') }}" alt="Feature box">
                            <img class="features-illustration asset-light" src="{{ asset('images/features-illustration-top-light.svg') }}" alt="Feature illustration top">
                        </div>
                        <div class="cta-header text-center">
                            <h2 class="section-title mt-0">Pendokumentasian Arsip SPJ Keuangan</h2>
                            <p class="section-paragraph">Pendokumentasian SPJ Keuangan berupa <em>softcopy</em> yang telah dikelompokkan menurut jenis dokumen, mata anggaran, dan kegiatan. Hal ini bertujuan untuk mempermudah pencarian dan pengelolaan dokumen keuangan secara efisien dan terstruktur.</p>
					    </div>
                    </div>
                </div>
            </section>

        </main>

        <footer class="site-footer has-top-divider">
            <div class="container">
                <div class="site-footer-inner">
                    <div class="brand footer-brand">
                        <a href="#">
							<img style="width: 210px;" class="asset-dark" src="{{ asset('images/dark.svg') }}" alt="Logo">
                            <img style="width: 210px;" class="asset-light" src="{{ asset('images/dark.svg') }}" alt="Logo">
                        </a>

                    </div>
                    <ul class="footer-links list-reset">
                        @if (Route::has('login'))
                        <li>
                            @auth
                            <a href="{{ config('nova.path') }}">Dashboard</a>
                            @else
                            <a href="{{ route('login') }}">Masuk</a>
                            @endauth
                        </li>
                        @endif
                        <li>
                            <a target="_blank" href="https://docs.simpede.my.id">Panduan</a>
                        </li>
                    </ul>
                    <ul class="footer-social-links list-reset">
                        <li>
                            <a href="#">
                                <span class="screen-reader-text">Website</span>
                                <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.93 4.5h-2.46a12.1 12.1 0 0 0-.84-2.53 6.5 6.5 0 0 1 3.3 2.53zM8 1.5c.28.38.54.83.77 1.34.23.5.43 1.05.6 1.66H6.63c.17-.61.37-1.16.6-1.66.23-.51.49-.96.77-1.34zM4.53 4.5H2.07a6.5 6.5 0 0 1 3.3-2.53c-.34.77-.62 1.64-.84 2.53zm-.1 1.5c-.05.49-.08.98-.08 1.5s.03 1.01.08 1.5H1.5a6.5 6.5 0 0 1 0-3h2.93zm.1 4.5c.22.89.5 1.76.84 2.53a6.5 6.5 0 0 1-3.3-2.53h2.46zm2.46 0h2.74c-.17.61-.37 1.16-.6 1.66-.23.51-.49.96-.77 1.34a6.5 6.5 0 0 1-1.37-3zm3.47 0h2.46a6.5 6.5 0 0 1-3.3 2.53c.34-.77.62-1.64.84-2.53zm.1-1.5c.05-.49.08-.98.08-1.5s-.03-1.01-.08-1.5H14.5a6.5 6.5 0 0 1 0 3h-2.93zm-.1-4.5c-.22-.89-.5-1.76-.84-2.53a6.5 6.5 0 0 1 3.3 2.53h-2.46z" fill="#FFF"/>
                                </svg>
                            </a>
                        </li>
                    </ul>
                    <div class="footer-copyright">
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
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/main.min.js') }}"></script>
</body>
</html>
