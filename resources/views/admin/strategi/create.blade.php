@extends('admin.layout.tamplate')
@section('title')
    {{ $judul ?? 'Tambah Data Strategi' }} - Admin
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
                                            {{ $judul ?? 'Tambah Data Strategi' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-content widget-content-area">

                                @if (Request::segment(4) == 'ubah')
                                    <form action="{{ route('dashboard.strategi.update', $data->id) }}" method="post"
                                        enctype="multipart/form-data" class="row g-3">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('dashboard.strategi.store') }}" method="post"
                                            enctype="multipart/form-data" class="row g-3">
                                @endif
                                @csrf
                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="tipe"> Tipe
                                        </label>
                                        <select class="form-control" aria-label="Default select example" name="tipe"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            <option value="SO" @if (isset($data) && $data->tipe == 'SO') selected @endif>SO
                                            </option>

                                            <option value="WO" @if (isset($data) && $data->tipe == 'WO') selected @endif>WO
                                            </option>

                                            <option value="ST" @if (isset($data) && $data->tipe == 'ST') selected @endif>ST
                                            </option>

                                            <option value="WT" @if (isset($data) && $data->tipe == 'WT') selected @endif>WT
                                            </option>

                                        </select>
                                        @if ($errors->has('tipe'))
                                            <label class="text-danger">
                                                {{ $errors->first('tipe') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="strategi_satu"> Strategi Satu
                                        </label>

                                        <select class="form-control" aria-label="Default select example"
                                            name="strategi_satu"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>
                                            <option value="">Tidak Ada</option>
                                            @foreach ($kriteria as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ (old('strategi_satu') ?? ($data->strategi_satu ?? '')) == $k->id ? 'selected' : '' }}>

                                                    {{ $k->kode_kriteria . '-' . $k->kriteria }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('strategi_satu'))
                                            <label class="text-danger">
                                                {{ $errors->first('strategi_satu') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="strategi_dua"> Strategi Dua
                                        </label>

                                        <select class="form-control" aria-label="Default select example"
                                            name="strategi_dua"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>
                                            <option value="">Tidak Ada</option>
                                            @foreach ($kriteria as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ (old('strategi_dua') ?? ($data->strategi_dua ?? '')) == $k->id ? 'selected' : '' }}>

                                                    {{ $k->kode_kriteria . '-' . $k->kriteria }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('strategi_dua'))
                                            <label class="text-danger">
                                                {{ $errors->first('strategi_dua') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                  <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="strategi_tiga"> Strategi Tiga
                                        </label>

                                        <select class="form-control" aria-label="Default select example"
                                            name="strategi_tiga"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>
                                            <option value="">Tidak Ada</option>
                                            @foreach ($kriteria as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ (old('strategi_tiga') ?? ($data->strategi_tiga ?? '')) == $k->id ? 'selected' : '' }}>

                                                    {{ $k->kode_kriteria . '-' . $k->kriteria }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('strategi_tiga'))
                                            <label class="text-danger">
                                                {{ $errors->first('strategi_tiga') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>



                                  <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="strategi_empat"> Strategi Empat
                                        </label>

                                        <select class="form-control" aria-label="Default select example"
                                            name="strategi_empat"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>
                                            <option value="">Tidak Ada</option>
                                            @foreach ($kriteria as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ (old('strategi_empat') ?? ($data->strategi_empat ?? '')) == $k->id ? 'selected' : '' }}>

                                                    {{ $k->kode_kriteria . '-' . $k->kriteria }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('strategi_empat'))
                                            <label class="text-danger">
                                                {{ $errors->first('strategi_empat') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>










                                 {{-- <div class="col-md-6">
                                    <div class="form-check">
                                            @foreach ($kriteria as $k )
                                                @php
                                                    $checkboxId = 'strategi_' . ($k->kode_kriteria ?? $loop->index);
                                                @endphp
                                                <input class="form-check-input"
                                                    type="checkbox"
                                                    value="{{ $k->kode_kriteria ?? '' }}"
                                                    name="strategi[]"
                                                    id="{{ $checkboxId }}">
                                                <label class="form-check-label"
                                                    for="{{ $checkboxId }}">
                                                    {{ $k->kriteria }} ({{ $k->kode_kriteria }})
                                                </label>
                                                <br>
                                            @endforeach
                                            @if ($errors->has('strategi'))
                                            <label class="text-danger"> {{ $errors->first('strategi') }}
                                            </label>
                                        @endif
                                    </div>

                                </div> --}}











                                <div class="col-md-12">
                                    @if (Request::segment(3) == 'detail')
                                        <a href="{{ route('dashboard.strategi.ubah', $data->id) }}" class="btn btn-primary">
                                            Ubah Data</a>
                                        <a href="{{ route('dashboard.strategi') }}" class="btn btn-success">
                                            Kembali</a>
                                    @else
                                        <button class="btn btn-primary">Simpan </button>
                                    @endif

                                </div>



                                </form>




                            </div>



                        </div>
                    </div>


                </div>
            </div>

        </div>
    @endsection
