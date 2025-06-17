@extends('visitor.layout.tamplate')
@section('title')
   Beranda
@endsection

@section('content')
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
                        <h1 class="header_title mb-0 mt-4 fw-bolder" style="font-size:30px"> SELAMAT DATANG DI SISTEM
                            INFORMASI PEMETAAN </h1>
                        <p class="header_subtitle pt-4 text-white mx-auto">SIstem ini membantu dalam pemetaan potensi
                            pengembangan kawasan pemukiman layar huni menggunakan metode TOPSIS dan SWOT</p>
                        <div class="header_btn position-relative">
                            <a href="{{route('daftar')}}" class="btn btn-primary rounded-pill mt-4">Daftar Akun  </a>
                        </div>
                    </div>
                </div>
            </div>


        </div>

    </section>
    <div class="row ">
        <div class="col-lg-12">
            <div id="map" style="height: 600px; width: 100%; z-index: 0;"></div>
        </div>
    </div>
    <!--End Home-->

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script type="text/javascript">
        const map = L.map('map').setView([-2.5744, 140.5178], 10);

        const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        });

        const esriSat = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: '&copy; Esri, Maxar, Earthstar Geographics'
            });

        osm.addTo(map);

        const geojsonData = {!! $geojson !!};

        function getRandomColor() {
            return '#' + Math.floor(Math.random() * 16777215).toString(16);
        }

        const distrikLayers = {};

        if (
            geojsonData &&
            geojsonData.type === 'FeatureCollection' &&
            Array.isArray(geojsonData.features) &&
            geojsonData.features.length > 0
        ) {
            geojsonData.features.forEach((feature) => {
                const geometryStr = JSON.stringify(feature.geometry || {});
                const nama = feature.properties?.nama_distrik;

                if (
                    feature &&
                    feature.type === 'Feature' &&
                    feature.geometry &&
                    geometryStr.length >= 20 &&
                    nama
                ) {
                    const ket = feature.properties.keterangan || '';
                    const color = getRandomColor();

                    const layer = L.geoJSON(feature, {
                        style: {
                            color: color,
                            weight: 2,
                            fillOpacity: 0.5
                        },
                        onEachFeature: function(feature, layer) {
                            layer.bindPopup(`<strong>${nama}</strong><br>${ket}`);
                        }
                    });

                    distrikLayers[nama] = layer;
                    layer.addTo(map);

                }
            });
        } else {
            alert("GeoJSON tidak valid atau kosong.");
        }

        const baseMaps = {
            "OpenStreetMap": osm,
            "ESRI Satellite": esriSat
        };

        L.control.layers(baseMaps, distrikLayers, {
            collapsed: false,
            position: 'topleft'
        }).addTo(map);
    </script>

    <!-- Start How It Work -->
    <section class="section bg-light" id="tentang">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">

                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4">
                <div class="col-lg-6">
                    <div class="mt-3">
                        <div>
                            <h2 class="features-heading">Sistem Informasi Pemetaan Potensi Pengembangan Kawasan
                                Pemukiman Layak Huni</h2>
                            <div class="main-title-border bg-primary "></div>
                            <p>Sistem Informasi Pemetaan Potensi Pengembangan Kawasan Pemukiman Layak Huni Kabupaten
                                Jayapura merupakan platform digital yang dikembangkan untuk memetakan potensi wilayah,
                                menganalisis kondisi eksisting, dan memberikan rekomendasi strategis dalam pengembangan
                                kawasan pemukiman yang aman, sehat, dan berkelanjutan. Sistem ini dirancang untuk
                                mendukung pemerintah daerah, pemangku kepentingan, dan masyarakat dalam perencanaan tata
                                ruang berbasis data spasial dan analisis SWOT secara terpadu.</p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-3">
                        <img src="assets/images/features.png" class="img-fluid mx-auto d-block" alt=""
                            title="Features">
                    </div>
                </div>
            </div>

            <div class="row mt-4 pt-4 vertical-content">
                <div class="col-lg-6">
                    <div class="mt-3">
                        <img src="assets/images/features-2.png" class="img-fluid mx-auto d-block" alt=""
                            title="Features">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mt-3">
                        <div>
                            <h2 class="features-heading">Menghadirkan Solusi Cerdas untuk Pengembangan Pemukiman di
                                Kabupaten Jayapura</h2>
                            <div class="main-title-border bg-primary "></div>
                        </div>
                        <div class="features position-relative">
                            <div
                                class="features-icon float-start fs-18 position-absolute rounded-pill text-primary bg-primary bg-opacity-25 text-center">
                                <i class="mdi mdi-check"></i>
                            </div>
                            <div class="ms-5">
                                <h3 class="fs-18 fw-bold">Pemetaan Berbasis Data Spasial
                                    <p class="pt-2 text-secondary">Menampilkan peta interaktif yang memuat informasi
                                        potensi wilayah, infrastruktur, dan kondisi eksisting guna mendukung
                                        identifikasi kawasan strategis secara akurat.</p>
                            </div>
                        </div>

                        <div class="features position-relative">
                            <div
                                class="features-icon float-start fs-18 position-absolute rounded-pill text-primary bg-primary bg-opacity-25 text-center">
                                <i class="mdi mdi-check"></i>
                            </div>
                            <div class="ms-5">
                                <h3 class="fs-18 fw-bold">Analisis SWOT Terintegrasi</h3>
                                <p class="pt-2 text-secondary">Menganalisis kekuatan, kelemahan, peluang, dan ancaman
                                    di setiap kawasan sebagai dasar evaluasi dan perencanaan pengembangan pemukiman
                                    secara menyeluruh.</p>
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
                        <p class="text-secondary sec_subtitle mx-auto mt-2">Jika Anda memiliki pertanyaan, masukan,
                            atau ingin mengetahui lebih lanjut tentang sistem ini, jangan ragu untuk menghubungi kami.
                            Kami siap membantu Anda dalam upaya mewujudkan kawasan pemukiman yang lebih baik di
                            Kabupaten Jayapura.</p>
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
                            <p class="text-secondary">sip4lh@gmail.com</p>
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
@endsection
