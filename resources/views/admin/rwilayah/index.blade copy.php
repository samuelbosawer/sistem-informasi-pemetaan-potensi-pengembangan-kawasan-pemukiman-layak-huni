@extends('admin.layout.tamplate')
@section('title')
    Data Perhitungan Swot - Admin
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
                                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                            </svg>
                                            Rekomendasi
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            <div class="widget-content widget-content-area">
                                <div class="d-flex justify-content-between">
                                    <div class="col-6 mb-3">

                                        @if (Auth::user()->hasRole('admin'))
                                            <a href="{{ route('dashboard.rekomendasi.tambah') }}" class="btn btn-primary">
                                                Tambah
                                                Rekomendasi </a>
                                        @endif
                                             @if(Auth::user()->hasRole('kepalaBidang'))
                                                <a target="_blank" href="{{route('dashboard.rekomendasi.pdf')}}" class="btn btn-danger">   Export PDF </a>
                                            @endif
                                    </div>
                                    <div class="col-6">
                                        {{-- @include('admin.layout.seraching') --}}
                                    </div>
                                </div>
                                {{-- <h3>Preferensi dan Ranking Akhir</h3> --}}
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-primary text-white">
                                                <th class=" text-white">Peringkat</th>
                                                <th class=" text-white">Distrik</th>
                                                <th class=" text-white">Nilai Preferensi</th>
                                                {{-- <th class=" text-white">Strategi</th> --}}

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ranking as $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $item['nama_distrik'] }}</td>
                                                    <td>{{ $item['nilai'] }}</td>
                                                    <td>
                                                        @foreach ($item['strategi_bertipe'] as $tipe => $strategis)
                                                            <strong>{{ $tipe }}</strong>
                                                            <ul>
                                                                @foreach ($strategis as $strat)
                                                                    <li>{{ $strat }}</li>
                                                                @endforeach
                                                            </ul>

                                                            {{-- Tombol hapus rekomendasi berdasarkan tipe --}}
                                                            @php
                                                                $idRekom = \App\Models\Rekomendasi::whereHas(
                                                                    'distrik',
                                                                    fn($q) => $q->where(
                                                                        'kode_distrik',
                                                                        $item['kode_distrik'],
                                                                    ),
                                                                )
                                                                    ->whereHas(
                                                                        'strategi',
                                                                        fn($q) => $q->where('tipe', $tipe),
                                                                    )
                                                                    ->pluck('id');
                                                            @endphp

                                                            @foreach ($idRekom as $id)
                                                                @if (Auth::user()->hasRole('admin'))
                                                                    <form
                                                                        action="{{ route('dashboard.rekomendasi.hapus', $id) }}"
                                                                        method="POST" style="display:inline;">
                                                                        @csrf @method('DELETE')
                                                                        <button class="btn btn-sm btn-danger"
                                                                            onclick="return confirm('Yakin ingin menghapus rekomendasi tipe {{ $tipe }} untuk distrik {{ $item['nama_distrik'] }}?')">
                                                                            Hapus {{ $tipe }}
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                                <br>
                                                            @endforeach
                                                        @endforeach
                                                    </td>
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

        </div>
    @endsection
