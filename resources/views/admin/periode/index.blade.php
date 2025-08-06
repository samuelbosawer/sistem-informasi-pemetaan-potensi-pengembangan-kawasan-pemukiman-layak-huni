@extends('admin.layout.tamplate')
@section('title')
    Data Perhitungan Berdasarkan Periode - Admin
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
                                        <h4 class="fw-bolder text-black">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                stroke-linecap="round" stroke-linejoin="round"
                                                class="feather feather-clipboard">
                                                <path
                                                    d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2">
                                                </path>
                                                <rect x="8" y="2" width="8" height="4" rx="1"
                                                    ry="1">
                                                </rect>
                                            </svg>
                                            Data Perhitungan Berdasarkan Periode
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content widget-content-area">

                                <div class="d-flex justify-content-between">
                                    <div class="col-6">
                                        @if (Auth::user()->hasRole('investor'))
                                            <a href="{{ route('dashboard.keluhan.tambah') }}" class="btn btn-primary">
                                                Tambah Data </a>
                                        @endif
                                        @if (Auth::user()->hasRole('kepalaBidang'))
                                            <a target="_blank" href="{{ route('dashboard.keluhan.pdf') }}"
                                                class="btn btn-danger"> Export PDF </a>
                                        @endif

                                    </div>
                                    <div class="col-6 p-3">

                                        <form action="{{ url(Request::segment(1) . '/' . Request::segment(2)) }}" method="get">
                                        <div class="form-group">
                                            <label for="tanggal">Filter Berdasarkan Tanggal & Jam</label>
                                            <select class="form-control" name="tanggal" onchange="this.form.submit()">
                                                <option value="">Pilih Tanggal & Jam</option>
                                                @foreach ($dates as $date)
                                                    <option value="{{ $date->created_at }}"
                                                        {{ request('tanggal') == $date->created_at ? 'selected' : '' }}>
                                                        {{ \Carbon\Carbon::parse($date->created_at)->translatedFormat('d F Y H:i:s') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        </form>

                                    </div>
                                </div>

                                {{-- <div class="col-12 text-center">
                                    <h5>Data Periode
                                        {{ \Carbon\Carbon::parse(request('tanggal') ?? $date->date)->translatedFormat('d F Y') }}
                                    </h5>
                                </div> --}}


                                <div class="table-responsive">
                                    <div class="col-12 mx-auto">
                                        <table class="table col-6 table-bordered table-hover table-striped">
                                            <thead>

                                                <tr class="bg-primary text-white">

                                                    <th scope="col " width="5" class="text-light fw-bolder">Tanggal
                                                    </th>
                                                    <th scope="col " width="5" class="text-light fw-bolder">Peringkat
                                                    </th>
                                                    <th scope="col " class="text-light fw-bolder">Distrik</th>
                                                    <th scope="col " class="text-light fw-bolder">Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($datas as $data)
                                                    <tr>
                                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->translatedFormat('d F Y H:i:s') }}
                                                        </td>
                                                        <td>{{ $data->peringkat }}</td>
                                                        <td>{{ $data->distrik->nama_distrik }}</td>
                                                        <td>{{ $data->nilai }}</td>

                                                    </tr>
                                                @empty

                                                    <tr>
                                                        <td colspan="3"> Data tidak ada</td>
                                                    </tr>
                                                @endforelse



                                            </tbody>
                                        </table>
                                    </div>

                                </div>



                            </div>
                        </div>


                    </div>
                </div>

            </div>
        @endsection
