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
                <a class="navbar-brand md:me-8 w-40" href="#" style="width:150px;">
                    <img src="{{ asset('images/logo.svg') }}" class="inline-block alt="">
                </a>

                <div class="nav-icons flex items-center lg_992:order-2 ms-auto md:ms-8">
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
                            <a class="nav-link active dark:text-gray-200" href="{{ route('welcome') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link dark:text-gray-200" href="{{ $apkUrl }}">Unduh</a>
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
                        <h1 class="font-semibold lg:leading-normal leading-normal tracking-wide text-4xl lg:text-5xl mb-5">iSusenas</h1>
                        <p class="text-slate-400 text-lg max-w-xl">iSusenas adalah aplikasi android untuk memudahkan pelaksanaan pendataan Survei Sosial Ekonomi Nasional (Susenas). Fitur utama meliputi pengecekan kesesuaian kuantitas dengan rentang harga, konversi ke satuan standar, perhitungan imputasi biaya-biaya, pelaporan progress, evaluasi dini pendataan dan alat bantu perhitungan rekapitulasi dokumen Konsumsi Pengeluaran</p>
                        
                        <div class="mt-6">
                            <a target="_blank" href="{{ $apkUrl }}" class="h-10 px-6 tracking-wide inline-flex items-center justify-center font-medium rounded-md bg-teal-500 text-white">Unduh</a>
                        </div>
                    </div>

                    <div class="lg:ms-8">
                        <div class="relative image-container">
                            <img src="{{ asset('images/isusenas-dark.png') }}" class="relative top-8 hidden dark:inline-block" alt="">
                            <img src="{{ asset('images/isusenas-light.png') }}" class="relative top-8 inline-block dark:hidden" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section><!--end section-->
        <!-- End Hero -->

      

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