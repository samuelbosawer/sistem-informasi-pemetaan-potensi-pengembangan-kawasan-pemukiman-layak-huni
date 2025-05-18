@extends('admin.layout.tamplate')
@section('title')
    Kriteria - Admin
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
                                        <h4 class="fw-bolder">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            Data Topsis
                                        </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-content widget-content-area">

                                <div class="d-flex justify-content-between">
                                    <div class="col-6">
                                        <a href="{{ route('dashboard.kriteria.tambah') }}" class="btn btn-primary"> Tambah
                                            Data </a>
                                    </div>

                                </div>


                                <div class="table-responsive mt-3">
                                    <h4>Nilai AS dari setiap Kriteria</h4>
                                    <table border="1" cellpadding="5" cellspacing="0" class="table">
                                        <thead>
                                            <tr style="background-color: #e0e0ff">
                                                <th>Kriteria</th>
                                                @foreach ($distriks as $distrik)
                                                    <th>{{ $distrik }}</th>
                                                @endforeach
                                                {{-- <th style="background-color: #00c853; color:white">LABEL</th> --}}
                                                <th style="background-color: #d50000; color:white">BOBOT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kriterias as $kriteria)
                                                <tr>
                                                    <td>{{ $kriteria }}</td>
                                                    @foreach ($distriks as $distrik)
                                                        <td>{{ $matrix[$kriteria][$distrik] ?? '-' }}</td>
                                                    @endforeach
                                                    {{-- <td style="background-color: #00c853; color:white">{{ $labels[$kriteria] }}</td> --}}
                                                    <td style="background-color: #d50000; color:white">
                                                        {{ $bobot[$kriteria] ?? '-' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                                <div class="table-responsive mt-3">
                                    <h4>Matriks keputusan ternormalisasi</h4>
                                    <table border="1" class="table">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                @foreach ($distriks as $distrik)
                                                    <th>{{ $distrik }}</th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($kriterias as $kriteria)
                                                <tr>
                                                    <td>{{ $kriteria }}</td>
                                                    @foreach ($distriks as $distrik)
                                                        <td>{{ $normal[$kriteria][$distrik] ?? '-' }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>



                                <h4>Matriks Terbobot</h4>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Kriteria</th>
                                            @foreach ($distriks as $distrik)
                                                <th>{{ $distrik }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($kriterias as $kriteria)
                                            <tr>
                                                <td>{{ $kriteria }}</td>
                                                @foreach ($distriks as $distrik)
                                                    <td>{{ number_format($terbobot[$kriteria][$distrik] ?? 0, 3) }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                                <h4>Solusi Ideal</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Kriteria</th>
            <th>Ideal (+)</th>
            <th>Ideal (-)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kriterias as $kriteria)
            <tr>
                <td>{{ $kriteria }}</td>
                <td>{{ number_format($idealPositif[$kriteria] ?? 0, 3) }}</td>
                <td>{{ number_format($idealNegatif[$kriteria] ?? 0, 3) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Jarak ke Solusi Ideal</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Distrik</th>
            <th>Jarak (+)</th>
            <th>Jarak (-)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($distriks as $distrik)
            <tr>
                <td>{{ $distrik }}</td>
                <td>{{ number_format($jarakPositif[$distrik] ?? 0, 3) }}</td>
                <td>{{ number_format($jarakNegatif[$distrik] ?? 0, 3) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<h4>Ranking Akhir</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Distrik</th>
            <th>Skor Preferensi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ranking as $distrik => $nilai)
            <tr>
                <td>{{ $distrik }}</td>
                <td>{{ number_format($nilai, 4) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>


                            </div>



                        </div>
                    </div>


                </div>
            </div>

        </div>
    @endsection
