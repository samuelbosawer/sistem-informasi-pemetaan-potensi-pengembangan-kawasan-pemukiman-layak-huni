@extends('admin.layout.tamplate')
@section('title')
    Dashboard - Admin
@endsection
@section('content')
    <style>
        #map {
            height: 100vh;
        }

        /* Pindahkan kontrol layer ke kiri atas */
        .leaflet-left .leaflet-control-layers {
            text-align: left;
        }

        /* Atur agar teks layer di dalam kontrol rata kiri */
        .leaflet-control-layers-base label,
        .leaflet-control-layers-overlays label {
            text-align: left;
            display: block;
            width: 100%;
            white-space: normal;
        }
    </style>

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="row layout-top-spacing">
                    @include('admin.layout.breadcumb')
                @if (Auth::user()->hasRole('admin'))

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                        <div class="widget widget-t-sales-widget widget-m-sales">
                            <div class="media">
                                <div class="icon ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-map">
                                        <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
                                        <line x1="8" y1="2" x2="8" y2="18"></line>
                                        <line x1="16" y1="6" x2="16" y2="22"></line>
                                    </svg>
                                </div>
                                <div class="media-body">
                                    <p class="widget-text">Distrik</p>
                                    <p class="widget-numeric-value">{{ $distrik_jumlah }}</p>
                                </div>
                            </div>
                            <div class="d-flex w-bottom text-center">
                                <p class="widget-total-stats"></p>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-more-horizontal">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu left" aria-labelledby="statistics"
                                            style="will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('dashboard.distrik') }}">Lihat Data</a>
                                            <a class="dropdown-item" href="{{ route('dashboard.distrik.tambah') }}">Tambah
                                                Data</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                        <div class="widget widget-t-sales-widget widget-m-sales">
                            <div class="media">
                                <div class="icon ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                </div>
                                <div class="media-body">
                                    <p class="widget-text">Jenis Kriteria</p>
                                    <p class="widget-numeric-value">{{ $kriteria_sum }}</p>
                                </div>
                            </div>
                            <div class="d-flex w-bottom text-center">
                                <p class="widget-total-stats"></p>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-more-horizontal">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu left" aria-labelledby="statistics"
                                            style="will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('dashboard.jenis-kriteria') }}">Lihat
                                                Data</a>
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.jenis-kriteria.tambah') }}">Tambah Data</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif



                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 layout-spacing">
                        <div class="widget widget-t-sales-widget widget-m-sales">
                            <div class="media">
                                <div class="icon ml-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        <line x1="16" y1="13" x2="8" y2="13"></line>
                                        <line x1="16" y1="17" x2="8" y2="17"></line>
                                        <polyline points="10 9 9 9 8 9"></polyline>
                                    </svg>
                                </div>
                                <div class="media-body">
                                    <p class="widget-text">Keluhan</p>
                                    <p class="widget-numeric-value"> {{ $keluhan }}</p>
                                </div>
                            </div>
                            <div class="d-flex w-bottom text-center">
                                <p class="widget-total-stats"></p>
                                <div class="task-action">
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" id="statistics"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-more-horizontal">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="19" cy="12" r="1"></circle>
                                                <circle cx="5" cy="12" r="1"></circle>
                                            </svg>
                                        </a>

                                        <div class="dropdown-menu left" aria-labelledby="statistics"
                                            style="will-change: transform;">
                                            <a class="dropdown-item" href="{{ route('dashboard.keluhan') }}">Lihat
                                                Data</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-spacing">
                        <div class="widget widget-t-sales-widget widget-m-sales text-center">

                            <h5 class="widget-text text-primary">Pemetaan Potensi Pengembangan Kawasan Pemukiman Layak Huni
                            </h5>
                            <hr>
                            <div style="height: 600px; width: 100%;" id="map"></div>
                        </div>
                    </div>






                </div>
            </div>

        </div>


        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <script>
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
    @endsection
