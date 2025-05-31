@extends('admin.layout.tamplate')
@section('title')
    Perhitungan SWOT - Admin
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
                                            Perhitungan Swot
                                        </h4>
                                    </div>
                                        <div class="col-6 p-3">
                                            <a href="{{ route('dashboard.swot') }}?result=hitung" class="btn btn-primary">Hitung SWOT</a>
                                        </div>
                                    </div>



                                </div>
                            </div>
@if(request('result'))

                            <div class="widget-content widget-content-area">

                                <div class="d-flex justify-content-between">

                                    <div class="col-6">
                                        <h3>Penilaian dan Bobot</h3>
                                    </div>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th scope="col " width="5" class="text-light fw-bolder">Kode</th>
                                                <th scope="col " class="text-light fw-bolder">Kriteria dan faktor</th>
                                                <th scope="col " class="text-light fw-bolder">Penilaian</th>
                                                <th scope="col " class="text-light fw-bolder">Label</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($datas as $data)
                                                <tr>
                                                    <td> {{ $data->kode_kriteria }}</td>
                                                    <td> {{ $data->kriteria }}</td>
                                                    <td> {{ $data->penilaian }} </td>
                                                    <td> {{ $data->label }} </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="text-center"> Data tidak ada</td>
                                                </tr>
                                            @endforelse


                                        </tbody>
                                    </table>

                                    <div>

                                    </div>
                                </div>






                            </div>




                            <div class="widget-content widget-content-area mt-5">

                                <div class="d-flex justify-content-between">

                                    <div class="col-6">
                                        <h3>Pencarian Nilai IFAS dan EFAS</h3>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th scope="col " width="5" class="text-light fw-bolder">Kode</th>
                                                    <th scope="col " class="text-light fw-bolder">Faktor Internal</th>
                                                    <th scope="col " class="text-light fw-bolder">Penilaian</th>
                                                    <th scope="col " class="text-light fw-bolder">Bobot</th>
                                                    <th scope="col " class="text-light fw-bolder">Rating</th>
                                                    <th scope="col " class="text-light fw-bolder">Skor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($nilaiA as $data)
                                                    <tr>
                                                        <td> {{ $data->kode_kriteria }}</td>
                                                        <td> {{ $data->kriteria }}</td>
                                                        <td> {{ $data->penilaian }} </td>
                                                        <td> {{ $bobot = number_format($data->penilaian / $totalNilaiA, 3) }}
                                                        </td>
                                                        <td> {{ $data->rating }} </td>
                                                        <td> {{ $skor = $data->rating * $bobot }} </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center"> Data tidak ada</td>
                                                    </tr>
                                                @endforelse
                                                <tr>
                                                    <td colspan="2">Jumlah Faktor Internal </td>
                                                    <td>{{ $totalNilaiA }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                        <div>

                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr class="bg-primary text-white">
                                                    <th scope="col " width="5" class="text-light fw-bolder">Kode</th>
                                                    <th scope="col " class="text-light fw-bolder">Faktor Internal</th>
                                                    <th scope="col " class="text-light fw-bolder">Penilaian</th>
                                                    <th scope="col " class="text-light fw-bolder">Bobot</th>
                                                    <th scope="col " class="text-light fw-bolder">Rating</th>
                                                    <th scope="col " class="text-light fw-bolder">Skor</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($nilaiB as $data)
                                                    <tr>
                                                        <td> {{ $data->kode_kriteria }}</td>
                                                        <td> {{ $data->kriteria }}</td>
                                                        <td> {{ $data->penilaian }} </td>
                                                        <td> {{ $bobot = number_format($data->penilaian / $totalNilaiB, 3) }}
                                                        </td>
                                                        <td> {{ $data->rating }} </td>
                                                        <td> {{ $skor = $data->rating * $bobot }} </td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="4" class="text-center"> Data tidak ada</td>
                                                    </tr>
                                                @endforelse
                                                <tr>
                                                    <td colspan="2">Jumlah Faktor Internal </td>
                                                    <td>{{ $totalNilaiB }}</td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>

                                                </tr>

                                            </tbody>
                                        </table>

                                        <div>

                                        </div>
                                    </div>
                                </div>

{{--
                                <h3 class="text-xl font-bold mb-2">Hasil Strategi SWOT</h3>

<div class="grid grid-cols-2 gap-4">
    <div class="p-4 border bg-green-50">
        <h4 class="font-bold">Strategi SO</h4>
        <ul class="list-disc pl-4">
            <li>Manfaatkan akses transportasi dan fasilitas kesehatan untuk mendukung pengembangan ekowisata.</li>
            <li>Gunakan pendidikan lanjutan untuk pelatihan tenaga kerja pariwisata.</li>
            <li>Bangun kerjasama untuk pengembangan air bersih dan sanitasi.</li>
        </ul>
    </div>

    <div class="p-4 border bg-yellow-50">
        <h4 class="font-bold">Strategi ST</h4>
        <ul class="list-disc pl-4">
            <li>Tingkatkan pendidikan dan infrastruktur untuk hadapi perubahan iklim.</li>
            <li>Gunakan fasilitas kesehatan untuk mitigasi risiko bencana.</li>
        </ul>
    </div>

    <div class="p-4 border bg-blue-50">
        <h4 class="font-bold">Strategi WO</h4>
        <ul class="list-disc pl-4">
            <li>Bangun sarana sosial dari peluang pariwisata.</li>
            <li>Perbaiki infrastruktur digital dengan proyek pemerintah.</li>
        </ul>
    </div>

    <div class="p-4 border bg-red-50">
        <h4 class="font-bold">Strategi WT</h4>
        <ul class="list-disc pl-4">
            <li>Perkuat keamanan untuk menarik investasi.</li>
            <li>Lakukan edukasi masyarakat untuk mitigasi bencana.</li>
        </ul>
    </div>
</div> --}}

@endif











                            </div>



                        </div>
                    </div>


                </div>
            </div>

        </div>
    @endsection
