@extends('admin.layout.tamplate')
@section('title')
    Dashboard - Detail
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


                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 layout-spacing">
                        <div class="widget widget-t-sales-widget widget-m-sales ">
                            <h5 class="widget-text text-primary text-center">Keluhan
                            </h5>
                            @php
                                $i = 1;
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr class="bg-primary text-white">
                                            <th scope="col " width="5" class="text-light fw-bolder">No</th>
                                            <th scope="col " class="text-light fw-bolder">Keluhan</th>
                                            <th scope="col " class="text-light fw-bolder">Tanggal</th>
                                            <th scope="col " class="text-light fw-bolder">Distrik</th>
                                            <th scope="col " class="text-light fw-bolder">Foto</th>
                                            <th scope="col " class="text-light fw-bolder">Pelapor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($keluhanes as $data)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td> {{ $data->keluhan }}</td>
                                                <td> {{ $data->tanggal }} </td>
                                                <td>{{$data->distrik->nama_distrik}}</td>
                                                <td>
                                                    @if ($data->foto != null)
                                                        <img src="{{ asset($data->foto) }}" width="100" class="rounded"
                                                            alt="" srcset="">
                                                    @else
                                                        -
                                                    @endif

                                                </td>
                                                <td> {{ $data->user->nama ?? '' }} </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center"> Data tidak ada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
    const map = L.map('map').setView([{{ $firstPoint->latitude ?? -2.5744 }}, {{ $firstPoint->longitude ?? 140.5178 }}], 10);

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

    // TAMBAHKAN MARKER KELUHAN DARI DATABASE
    const keluhanData = @json($keluhanes);
    keluhanData.forEach(function(item) {
        if (item.latitude && item.longitude) {
            L.marker([item.latitude, item.longitude])
                .addTo(map)
                .bindPopup(`<strong>${item.keluhan ?? 'Keluhan'}</strong><br>${item.tanggal ?? ''}`);
        }
    });

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
