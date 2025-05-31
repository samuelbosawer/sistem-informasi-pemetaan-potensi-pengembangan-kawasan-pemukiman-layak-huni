@extends('admin.layout.tamplate')
@section('title')
    {{ $judul ?? 'Tambah Data Topsis' }} - Admin
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
                                            {{ $judul ?? 'Tambah Data Topsis' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-content widget-content-area">

                                @if (Request::segment(4) == 'ubah')
                                    <form action="{{ route('dashboard.topsis.update', $data->id) }}" method="post"
                                        enctype="multipart/form-data" class="row g-3">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('dashboard.topsis.store') }}" method="post"
                                            enctype="multipart/form-data" class="row g-3">
                                @endif
                                @csrf

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="kode_distrik"> Kode Distrik
                                        </label>
                                        <select class="form-control" aria-label="Default select example" name="kode_distrik"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            @foreach ($distriks as $d)
                                                <option value="{{ $d->kode_distrik }}"
                                                    {{ (old('kode_distrik') ?? ($data->kode_distrik ?? '')) == $d->kode_distrik ? 'selected' : '' }}>
                                                    {{ $d->kode_distrik . '-' . $d->nama_distrik }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('kode_distrik'))
                                            <label class="text-danger">
                                                {{ $errors->first('kode_distrik') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="kode_kriteria"> Kode Kriteria
                                        </label>
                                        <select class="form-control" aria-label="Default select example"
                                            name="kode_kriteria"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            @foreach ($kriterias as $k)
                                                <option value="{{ $k->kode_kriteria }}"
                                                    {{ (old('kode_kriteria') ?? ($data->kode_kriteria ?? '')) == $k->kode_kriteria ? 'selected' : '' }}>

                                                    {{ $k->kode_kriteria . '-' . $k->kriteria }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('kode_kriteria'))
                                            <label class="text-danger">
                                                {{ $errors->first('kode_kriteria') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input type="text" name="nilai" @if (Request::segment(3) == 'detail') disabled @endif
                                        value="{{ old('nilai') ?? ($data->nilai ?? '') }}" class="form-control"
                                        id="nilai">
                                    @if ($errors->has('nilai'))
                                        <label class="text-danger"> {{ $errors->first('nilai') }}
                                        </label>
                                    @endif
                                </div>






                                <div class="col-md-10">
                                    @if (Request::segment(3) == 'detail')
                                        <a href="{{ route('dashboard.kriteria.ubah', $data->id) }}" class="btn btn-primary">
                                            Ubah Data</a>
                                        <a href="{{ route('dashboard.kriteria') }}" class="btn btn-success"> Kembali</a>
                                    @else
                                        <button class="btn btn-primary">Simpan </button>

                                        <a class="btn btn-primary" href="{{route('dashboard.topsis')}}">Kembali</a>
                                  </form>

                                  @if (isset($data))
                                      <form class="d-inline" action="{{ route('dashboard.topsis.hapus', $data->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('DELETE')
                                            <button class="action-btn btn btn-danger  border-0  bs-tooltip"
                                                data-toggle="tooltip" data-placement="top" title="Hapus"
                                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
                                                type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-trash-2">
                                                    <polyline points="3 6 5 6 21 6"></polyline>
                                                    <path
                                                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                    </path>
                                                    <line x1="10" y1="11" x2="10" y2="17">
                                                    </line>
                                                    <line x1="14" y1="11" x2="14" y2="17">
                                                    </line>
                                                </svg>

                                            </button>
                                        </form>
                                  @endif


                                    @endif

                                </div>





                            </div>



                        </div>
                    </div>


                </div>
            </div>

        </div>
    @endsection
