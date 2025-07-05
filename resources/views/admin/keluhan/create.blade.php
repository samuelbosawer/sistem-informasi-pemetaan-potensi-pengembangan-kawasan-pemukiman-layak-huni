@extends('admin.layout.tamplate')
@section('title')
    {{ $judul ?? 'Tambah Keluhan' }} - Admin
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
                                                class="feather feather-file-text">
                                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                                <polyline points="14 2 14 8 20 8"></polyline>
                                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                                <polyline points="10 9 9 9 8 9"></polyline>
                                            </svg>
                                            {{ $judul ?? 'Tambah Keluhan' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-content widget-content-area">

                                @if (Request::segment(4) == 'ubah')
                                    <form action="{{ route('dashboard.keluhan.update', $data->id) }}" method="post"
                                        enctype="multipart/form-data" class="row g-3">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('dashboard.keluhan.store') }}" method="post"
                                            enctype="multipart/form-data" class="row g-3">
                                @endif
                                @csrf
                                <div class="col-md-12">
                                    <label for="keluhan" class="form-label">Keluhan</label>
                                    <textarea name="keluhan" @if (Request::segment(3) == 'detail') disabled @endif class="form-control" id="keluhan"
                                        cols="30" rows="10">{{ old('keluhan') ?? ($data->keluhan ?? '') }}</textarea>
                                    @if ($errors->has('keluhan'))
                                        <label class="text-danger"> {{ $errors->first('keluhan') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" @if (Request::segment(3) == 'detail') disabled @endif
                                        value="{{ old('tanggal') ?? ($data->tanggal ?? '') }}" class="form-control"
                                        id="tanggal">
                                    @if ($errors->has('tanggal'))
                                        <label class="text-danger"> {{ $errors->first('tanggal') }}
                                        </label>
                                    @endif
                                </div>



                                <div class="col-md-6">
                                    <label for="latitude" class="form-label">Latitude</label>
                                    <input type="text" name="latitude" @if (Request::segment(3) == 'detail') disabled @endif
                                        value="{{ old('latitude') ?? ($data->latitude ?? '') }}" class="form-control"
                                        id="latitude">
                                    @if ($errors->has('latitude'))
                                        <label class="text-danger"> {{ $errors->first('latitude') }}
                                        </label>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    <label for="longitude" class="form-label">Longitude</label>
                                    <input type="text" name="longitude" @if (Request::segment(3) == 'detail') disabled @endif
                                        value="{{ old('longitude') ?? ($data->longitude ?? '') }}" class="form-control"
                                        id="longitude">
                                    @if ($errors->has('longitude'))
                                        <label class="text-danger"> {{ $errors->first('longitude') }}
                                        </label>
                                    @endif
                                </div>


                                @if (Auth::user()->hasRole('admin'))
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="status"> Status
                                            </label>
                                            <select class="form-control" aria-label="Default select example" name="status"
                                                @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                                <option value="">Pilih Status
                                                </option>

                                                <option value="Publish" @if (isset($data) && $data->status == 'Publish') selected @endif>
                                                    Publish
                                                </option>

                                                <option value="Draft" @if (isset($data) && $data->status == 'Draft') selected @endif>
                                                    Draft
                                                </option>

                                            </select>
                                            @if ($errors->has('status'))
                                                <label class="text-danger">
                                                    {{ $errors->first('status') }}
                                                </label>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="kode_distrik"> Distrik
                                        </label>
                                        <select class="form-control" aria-label="Default select example" name="distrik_id"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            @foreach ($distriks as $d)
                                                <option value="{{ $d->id }}"
                                                    {{ (old('distrik_id') ?? ($data->distrik_id ?? '')) == $d->id ? 'selected' : '' }}>
                                                    {{ $d->kode_distrik . '-' . $d->nama_distrik }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('distrik_id'))
                                            <label class="text-danger">
                                                {{ $errors->first('distrik_id') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>


                                    <div class="col-md-6">

                                    <label for="foto" class="form-label">Foto</label>
                                    <br>

                                      @if (isset($data) && $data->foto)
                                        <img src="{{ asset($data->foto) }}" width="200" class="mb-3" rounded alt=""
                                            srcset="">
                                    @endif
                                    <br>
                                    <input type="file" name="foto" @if (Request::segment(3) == 'detail') disabled @endif
                                        value="{{ old('foto') ?? ($data->foto ?? '') }}" class="form-control"
                                        id="foto">
                                    @if ($errors->has('foto'))
                                        <label class="text-danger"> {{ $errors->first('foto') }}
                                        </label>
                                    @endif
                                </div>







                                <div class="col-md-12">
                                    @if (Request::segment(3) == 'detail')
                                        @if (Auth::user()->hasRole('investor') || Auth::user()->hasRole('admin'))
                                            <a href="{{ route('dashboard.keluhan.ubah', $data->id) }}"
                                                class="btn btn-primary"> Ubah Data</a>
                                        @endif
                                    @else
                                        @if (Auth::user()->hasRole('investor')|| Auth::user()->hasRole('admin') )
                                            <button class="btn btn-primary">Simpan </button>
                                        @endif
                                    @endif
                                        <a href="{{ route('dashboard.keluhan') }}" class="btn btn-success"> Kembali</a>


                                </div>



                                </form>




                            </div>



                        </div>
                    </div>


                </div>
            </div>

        </div>
    @endsection
