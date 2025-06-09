@extends('admin.layout.tamplate')
@section('title')
    Perhitungan Topsis - Admin
@endsection
@section('content')
    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">
            <div class="middle-content container-xxl p-0">
                <div class="row layout-top-spacing">
                    @include('admin.layout.breadcumb')


                    <div id="" class="col-lg-12 col-12 layout-spacing p-3">
                        <div class="statbox widget box box-shadow">
                            <div class="widget-header">
                                <div class="row">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                        <h4 class="fw-bolder ">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-clipboard">
                                                <path
                                                    d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                                </path>
                                                <rect x="8" y="2" width="8" height="4" rx="1"
                                                    ry="1"></rect>
                                            </svg>
                                            Perhitungan Topsis
                                        </h4>
                                    </div>

                                    <div class="">
                                        <div class="col-6">
                                            <a href="{{ route('dashboard.topsis.tambah') }}" class="btn btn-primary"> Tambah
                                                Data Topsis </a>
                                            <a href="{{ route('dashboard.topsis') }}?result=hitung#hitung"
                                                class="btn btn-primary">Hitung Topsis</a>
                                        </div>
                                        <div class="col-6">
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="widget-content widget-content-area mb-5">

                                <div class="d-flex justify-content-between">

                                    <div class="col-6">
                                        <h3>Nilai AS dari setiap Kriteria</h3>
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th scope="col " width="5" class="text-light fw-bolder">Kriteria</th>
                                                @foreach ($distriks as $distrik)
                                                    <th scope="col " class="text-light fw-bolder">{{ $distrik }}</th>
                                                @endforeach
                                                <th class="text-light fw-bolder">BOBOT</th>
                                                <th class="text-light fw-bolder">LABEL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($kriterias as $kriteria)
                                                <tr>
                                                    <td> {{ $kriteria }}</td>
                                                    @foreach ($distriks as $distrik)
                                                        <td> <a
                                                                href="{{ route('dashboard.topsis.ubah', $topsisIds[$kriteria][$distrik] ?? '#') }}">
                                                                {{ $matrix[$kriteria][$distrik] ?? '' }} </a> </td>
                                                    @endforeach
                                                    <td>{{ $scores[$kriteria] ?? '-' }}</td>
                                                    <td> {{ $labels[$kriteria] ?? '-' }} </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center"> Data tidak ada</td>

                                                </tr>
                                            @endforelse


                                        </tbody>
                                    </table>


                                </div>






                            </div>

                            @if (request('result'))
                                <div id="" class="mt-5">
                                    <div class="widget-content widget-content-area">
                                        <div id="hitung">
                                            <h1 class="">Hasil Perhitungan</h1>
                                        </div>
                                        <h3>Matriks Keputusan Ternormalisasi</h3>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th scope="col" width="5" class="text-light fw-bolder">
                                                            Kriteria</th>
                                                        @foreach ($distriks as $distrik)
                                                            <th scope="col" class="text-light fw-bolder">
                                                                {{ $distrik }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($kriterias as $kriteria)
                                                        <tr>
                                                            <td>{{ $kriteria }}</td>
                                                            @foreach ($distriks as $distrik)
                                                                <td>{{ $normal[$kriteria][$distrik] ?? '-' }}</td>
                                                            @endforeach
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="{{ count($distriks) + 1 }}" class="text-center">
                                                                Data tidak
                                                                ada</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="widget-content widget-content-area mt-4">
                                        <h3>Matriks Keputusan Ternormalisasi Terbobot</h3>

                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th class="text-white">Kriteria</th>
                                                        @foreach ($distriks as $distrik)
                                                            <th class="text-white">{{ $distrik }}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kriterias as $kriteria)
                                                        <tr>
                                                            <td>{{ $kriteria }}</td>
                                                            @foreach ($distriks as $distrik)
                                                                <td>{{ $weighted[$kriteria][$distrik] ?? '-' }}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="widget-content widget-content-area">
                                        <h3>Solusi Ideal Positif (A⁺) & Negatif (A⁻)</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th class="text-white">Kriteria</th>
                                                        <th class="text-white">A⁺ (Ideal Positif)</th>
                                                        <th class="text-white">A⁻ (Ideal Negatif)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($kriterias as $kriteria)
                                                        <tr>
                                                            <td>{{ $kriteria }}</td>
                                                            <td>{{ $idealPositive[$kriteria] ?? '-' }}</td>
                                                            <td>{{ $idealNegative[$kriteria] ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="widget-content widget-content-area">
                                        <h3>Jarak ke Solusi Ideal Positif (D⁺) dan Negatif (D⁻)</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th class="text-white">Distrik</th>
                                                        <th class="text-white">D⁺</th>
                                                        <th class="text-white">D⁻</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($distriks as $distrik)
                                                        <tr>
                                                            <td>{{ $distrik }}</td>
                                                            <td>{{ $jarakIdealPositif[$distrik] ?? '-' }}</td>
                                                            <td>{{ $jarakIdealNegatif[$distrik] ?? '-' }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="widget-content widget-content-area">
                                        <h3>Preferensi dan Ranking Akhir</h3>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr class="bg-success text-white">
                                                        <th class=" text-white">Peringkat</th>
                                                        <th class=" text-white">Kode Distrik</th>
                                                        <th class=" text-white">Nilai Preferensi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($ranking as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $item['distrik'] }}</td>
                                                            <td>{{ $item['nilai'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>



                    </div>
                </div>


            </div>
        </div>

    @endsection
