
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Premium Bootstrap 5 Landing Template" />
    <meta name="keywords" content="agency, bootstrap, business, corporate, creative, landing page, marketing, multipurpose, product, product launch, responsive, software, startup, startup landing page" />
    <meta name="author" content="ThemesBoss" />

    <title>@yield('title', 'Sistem Informasi Pemetaan Potensi Pengembangan Kawasan Pemukiman Layak Huni')</title>
    <link rel="icon" type="image/x-icon" href="/src/assets/img/logo.svg"/>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">

    <!-- Material Icon -->
    <link rel="stylesheet" type="text/css" href="assets/css/materialdesignicons.min.css" />

    <!-- Pe7 Icon -->
    <link rel="stylesheet" type="text/css" href="assets/css/pe-icon-7.css">

    <!-- Custom  Css -->
    <link rel="stylesheet" type="text/css" href="assets/css/style.min.css" />

</head>

<body>

    <!--Navbar Start-->
    <nav class="navbar navbar-expand-lg fixed-top custom-nav sticky">
        <div class="container">
            <!-- LOGO -->
            <a class="logo navbar-brand" href="index.html">

                <img src="assets/images/logo.png" alt="" class="img-fluid logo-light">
                <img src="assets/images/logo-dark.png" alt="" class="img-fluid logo-dark">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <i class="mdi mdi-menu"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ms-auto navbar-center" id="mySidenav">
                    <li class="nav-item active">
                        <a href="#beranda" class="nav-link">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a href="#swot" class="nav-link">Swot</a>
                    </li>
                    <li class="nav-item">
                        <a href="#rekomendasi" class="nav-link">Rekomendasi</a>
                    </li>
                    <li class="nav-item">
                        <a href="#tentang" class="nav-link">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a href="#kontak" class="nav-link">Kontak</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    <!--Start Home-->
    <section class="home-bg-img d-flex align-items-center min-vh-100" id="beranda">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="text-white text-center position-relative">
                        {{-- <div class="mx-auto">
                            <button type="button" class="play-btn video_play mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="mdi mdi-play text-center"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                    <div class="modal-content bg-transparent border-0">
                                        <div class="modal-body p-0 w-auto h-auto overflow-hidden d-inline-flex justify-content-center">
                                            <div>
                                                <div class="modal-header border-0">
                                                    <button type="button" class="bg-transparent border-0 ms-auto p-0 me-4 pe-5" data-bs-dismiss="modal" aria-label="Close"><i class="mdi mdi-close text-white fs-5"></i></button>
                                                </div>
                                                <iframe src="https://player.vimeo.com/video/99025203?h=0788a7a47b&title=0&byline=0&portrait=0&badge=0" width="990" height="460" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        <h1 class="header_title mb-0 mt-4 fw-bolder" style="font-size:30px"> SELAMAT DATANG DI SISTEM INFORMASI PEMETAAN POTENSI PENGEMBANGAN KAWASAN PEMUKIMAN LAYAK HUNI </h1>
                        <p class="header_subtitle pt-4 text-white mx-auto">Platform digital untuk memetakan, menganalisis, dan merencanakan pengembangan kawasan pemukiman yang aman, sehat, dan berkelanjutan berbasis data spasial dan potensi wilayah.</p>
                        <div class="header_btn position-relative">
                            <a href="#swot" class="btn btn-primary rounded-pill mt-4">Lihat Perhitungan Swot </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Home-->



    <!-- Start Features -->
    <section class="section" id="swot">
        <div class="container">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="mb-0 text-capitalize"><span class="fw-bold">SWOT</span></h3>
                        <div class="main-title-border bg-primary  mx-auto"></div>
                        <p class="text-secondary  mx-auto mt-2">Fitur Analisis SWOT (Strengths, Weaknesses, Opportunities, Threats) membantu pengguna mengidentifikasi kekuatan, kelemahan, peluang, dan ancaman dalam setiap kawasan, guna mendukung perencanaan strategis pengembangan pemukiman layak huni secara lebih tepat dan berbasis data.</p>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="row mt-4 ">
                <div class="col-lg-12">
                    <div style="height: 600px; width: 100%;" id="map"></div>
                </div>
            </div>

        </div>
    </section>
    <!-- End Features -->



    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script type="text/javascript">
    const map = L.map('map').setView([-2.5744, 140.5178], 10); // Koordinat Jayapura

// Pane khusus untuk label
map.createPane('labels');
map.getPane('labels').style.zIndex = 650;
map.getPane('labels').style.pointerEvents = 'none';

// Attribution
const cartodbAttribution =
'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, ' +
'&copy; <a href="https://carto.com/attribution">CARTO</a>';

// Basemap layers
const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
attribution: cartodbAttribution
});

const positron = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_nolabels/{z}/{x}/{y}{r}.png', {
attribution: cartodbAttribution
});

const esriSat = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
attribution: '&copy; <a href="https://www.esri.com">Esri</a> &mdash; Source: Esri, Maxar, Earthstar Geographics, and the GIS User Community'
});

// Label layer untuk CartoDB
const positronLabels = L.tileLayer('https://{s}.basemaps.cartocdn.com/light_only_labels/{z}/{x}/{y}{r}.png', {
attribution: cartodbAttribution,
pane: 'labels'
});

// Tambahkan default layer
positron.addTo(map);
positronLabels.addTo(map);

// Group layer untuk kontrol
const baseMaps = {
"OpenStreetMap": osm,
"CartoDB Positron": positron,
"ESRI Satellite": esriSat
};

const overlayMaps = {
"Labels (Positron)": positronLabels
};

// Tambahkan layer control ke peta
L.control.layers(baseMaps, overlayMaps, { collapsed: false }).addTo(map);

    </script>





    <!-- Start Services -->
    <section class="section " id="rekomendasi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="mb-0 text-capitalize"> <span class="fw-bold">Rekomendasi</span></h3>
                        <div class="main-title-border bg-primary  mx-auto"></div>
                        <p class="text-secondary sec_subtitle mx-auto mt-2">Rekomendasi memberikan usulan pengembangan kawasan berdasarkan hasil analisis data spasial, potensi wilayah, dan hasil evaluasi SWOT, guna mendukung pengambilan keputusan yang efektif dan berkelanjutan.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4">



            </div>

        </div>
    </section>
    <!-- End Services -->

    <!-- Start How It Work -->
    <section class="section bg-light" id="tentang">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="mb-0 text-capitalize"> <span class="fw-bold">Tentang</span></h3>
                        <div class="main-title-border bg-primary mx-auto"></div>
                        <p class="text-secondary mx-auto mt-2">Secara singkat, sistem ini merupakan alat bantu digital berbasis peta interaktif yang dirancang untuk memetakan potensi wilayah, menganalisis kondisi kawasan, dan memberikan rekomendasi pengembangan pemukiman layak huni di Kabupaten Jayapura.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4">
                <div class="col-lg-6">
                    <div class="mt-3">
                        <div>
                            <h2 class="features-heading">Sistem Informasi Pemetaan Potensi Pengembangan Kawasan Pemukiman Layak Huni</h2>
                            <div class="main-title-border bg-primary "></div>
                            <p>Sistem Informasi Pemetaan Potensi Pengembangan Kawasan Pemukiman Layak Huni Kabupaten Jayapura merupakan platform digital yang dikembangkan untuk memetakan potensi wilayah, menganalisis kondisi eksisting, dan memberikan rekomendasi strategis dalam pengembangan kawasan pemukiman yang aman, sehat, dan berkelanjutan. Sistem ini dirancang untuk mendukung pemerintah daerah, pemangku kepentingan, dan masyarakat dalam perencanaan tata ruang berbasis data spasial dan analisis SWOT secara terpadu.</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-3">
                        <img src="assets/images/features.png" class="img-fluid mx-auto d-block" alt="" title="Features">
                    </div>
                </div>
            </div>

            <div class="row mt-4 pt-4 vertical-content">
                <div class="col-lg-6">
                    <div class="mt-3">
                        <img src="assets/images/features-2.png" class="img-fluid mx-auto d-block" alt="" title="Features">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-3">
                        <div>
                            <h2 class="features-heading">Menghadirkan Solusi Cerdas untuk Pengembangan Pemukiman di Kabupaten Jayapura</h2>
                            <div class="main-title-border bg-primary "></div>
                        </div>
                        <div class="features position-relative">
                            <div class="features-icon float-start fs-18 position-absolute rounded-pill text-primary bg-primary bg-opacity-25 text-center">
                                <i class="mdi mdi-check"></i>
                            </div>
                            <div class="ms-5">
                                <h3 class="fs-18 fw-bold">Pemetaan Berbasis Data Spasial
                                <p class="pt-2 text-secondary">Menampilkan peta interaktif yang memuat informasi potensi wilayah, infrastruktur, dan kondisi eksisting guna mendukung identifikasi kawasan strategis secara akurat.</p>
                            </div>
                        </div>

                        <div class="features position-relative">
                            <div class="features-icon float-start fs-18 position-absolute rounded-pill text-primary bg-primary bg-opacity-25 text-center">
                                <i class="mdi mdi-check"></i>
                            </div>
                            <div class="ms-5">
                                <h3 class="fs-18 fw-bold">Analisis SWOT Terintegrasi</h3>
                                <p class="pt-2 text-secondary">Menganalisis kekuatan, kelemahan, peluang, dan ancaman di setiap kawasan sebagai dasar evaluasi dan perencanaan pengembangan pemukiman secara menyeluruh.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            </div>
        </div>
    </section>
    <!-- End How It Work -->










    <!-- Start Contact -->
    <section class="section" id="kontak">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="mb-0 text-capitalize"><span class="fw-bold">Kontak Kami</span></h3>
                        <div class="main-title-border bg-primary  mx-auto"></div>
                        <p class="text-secondary sec_subtitle mx-auto mt-2">Jika Anda memiliki pertanyaan, masukan, atau ingin mengetahui lebih lanjut tentang sistem ini, jangan ragu untuk menghubungi kami. Kami siap membantu Anda dalam upaya mewujudkan kawasan pemukiman yang lebih baik di Kabupaten Jayapura.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-2">
                <div class="col-md-4">
                    <div class="text-center mt-3">
                        <div>
                            <i class="pe-7s-call text-primary h2"></i>
                        </div>
                        <div class="mt-2">
                            <p class="mb-0 fw-bold">No Telp</p>
                            <p class="text-secondary">0821 9812 9212</p>
                        </div>
                    </div>


                </div>

                <div class="col-md-4">
                      <div class="text-center mt-3">
                        <div>
                            <i class="pe-7s-mail text-primary h2"></i>
                        </div>
                        <div class="mt-2">
                            <p class="mb-0 fw-bold">Email</p>
                            <p class="text-secondary">@gmail.com</p>
                        </div>
                    </div>

                </div>

                <div class="col-md-4">
                     <div class="text-center mt-3">
                        <div>
                            <i class="pe-7s-map text-primary h2"></i>
                        </div>
                        <div class="mt-2">
                            <p class="mb-0 fw-bold">Alamat</p>
                            <p class="text-secondary">Gunung Merah Sentani</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- End Contact -->

    <!-- Start Footer -->
    <footer class="footer_detail bg-dark">
        <div class="container">
            <div class="row pt-5 pb-5">
                <div class="col-lg-12">
                    <div class="text-center">
                        <img src="assets/images/logo.png" class="mx-auto img-fluid d-block footer_logo" alt="">
                    </div>
                    <div class="footer_menu">
                        {{-- <ul class="mb-0 list-inline text-center mt-4">
                            <li class="list-inline-item me-0"><a href="javascript:void(0)" class="text-secondary">Terms &amp; Condition</a></li>
                            <li class="list-inline-item me-0"><a href="javascript:void(0)" class="text-secondary">Privacy Policy</a></li>
                            <li class="list-inline-item me-0"><a href="javascript:void(0)" class="text-secondary">Contact Us</a></li>
                        </ul> --}}
                    </div>
                </div>
            </div>
            <div class="fot_bor w-100"></div>
            <div class="row pt-4 pb-4">
                <div class="col-lg-12">
                    <div class="float-start float_none">
                        <p class="copy-rights text-secondary mb-0">
                            ©
                            <script>document.write(new Date().getFullYear()) </script> Brezon. Design by
                            <a href="https://themeforest.net/user/themesboss/portfolio" target="_blank" class="text-secondary">ThemesBoss.</a>
                        </p>
                    </div>
                    <div class="float-end float_none">
                        <ul class="list-inline fot_social mb-0">
                            <li class="list-inline-item"><a href="javascript:void(0)" class="social-icon d-block fs-18 rounded-pill text-center text-secondary"><i class="mdi mdi-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="social-icon d-block fs-18 rounded-pill text-center text-secondary"><i class="mdi mdi-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="social-icon d-block fs-18 rounded-pill text-center text-secondary"><i class="mdi mdi-linkedin"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void(0)" class="social-icon d-block fs-18 rounded-pill text-center text-secondary"><i class="mdi mdi-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Back To Top -->
    <a href="javascript:void(0)" class="back_top"> <i class="pe-7s-angle-up"> </i> </a>

    <!-- Javascript -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.easing.min.js"></script>
    <script src="assets/js/scrollspy.min.js"></script>

    <!-- CONTACT JS -->
    <script src="assets/js/contact.js"></script>

    <!-- Custom Js   -->
    <script src="assets/js/custom.js"></script>

</body>

</html>
