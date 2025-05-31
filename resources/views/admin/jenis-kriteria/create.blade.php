@extends('admin.layout.tamplate')
@section('title')
    {{ $judul ?? 'Tambah Data Jenis Kriteria' }} - Admin
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
                                            {{ $judul ?? 'Tambah Data Jenis Kriteria' }}
                                        </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-content widget-content-area">

                                @if (Request::segment(4) == 'ubah')
                                    <form action="{{ route('dashboard.jenis-kriteria.update', $data->id) }}" method="post"
                                        enctype="multipart/form-data" class="row g-3">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('dashboard.jenis-kriteria.store') }}" method="post"
                                            enctype="multipart/form-data" class="row g-3">
                                @endif
                                @csrf
                                <div class="col-md-6">
                                    <label for="kriteria" class="form-label">Nama kriteria <span
                                            class="text-danger">*</span> </label>
                                    <input type="text" name="kriteria" @if (Request::segment(3) == 'detail') disabled @endif
                                        value="{{ old('kriteria') ?? ($data->kriteria ?? '') }}" class="form-control"
                                        id="kriteria">
                                    @if ($errors->has('kriteria'))
                                        <label class="text-danger"> {{ $errors->first('kriteria') }}
                                        </label>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label for="kode_kriteria" class="form-label">Kode Kriteria <span
                                            class="text-danger">*</span> </label>
                                    <input type="text" name="kode_kriteria"
                                        @if (Request::segment(3) == 'detail') disabled @endif
                                        value="{{ old('kode_kriteria') ?? ($data->kode_kriteria ?? '') }}"
                                        class="form-control" id="kode_kriteria">
                                    @if ($errors->has('kode_kriteria'))
                                        <label class="text-danger"> {{ $errors->first('kode_kriteria') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">

                                        <label for="penilaian"> Penilaian
                                        </label>
                                        <select class="form-control" aria-label="Default select example" name="penilaian"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            <option value="1" @if (isset($data) && $data->penilaian == 1) selected @endif>1
                                            </option>

                                            <option value="2" @if (isset($data) && $data->penilaian == 2) selected @endif>2
                                            </option>

                                            <option value="3" @if (isset($data) && $data->penilaian == 3) selected @endif>3
                                            </option>

                                            <option value="4" @if (isset($data) && $data->penilaian == 4) selected @endif>4
                                            </option>

                                            <option value="5" @if (isset($data) && $data->penilaian == 5) selected @endif>5
                                            </option>
                                        </select>
                                        @if ($errors->has('penilaian'))
                                            <label class="text-danger">
                                                {{ $errors->first('penilaian') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">

                                        <label for="rating"> Rating
                                        </label>
                                        <select class="form-control" aria-label="Default select example" name="rating"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            <option value="1" @if (isset($data) && $data->rating == 1) selected @endif>1
                                            </option>

                                            <option value="2" @if (isset($data) && $data->rating == 2) selected @endif>2
                                            </option>

                                            <option value="3" @if (isset($data) && $data->rating == 3) selected @endif>3
                                            </option>

                                            <option value="4" @if (isset($data) && $data->rating == 4) selected @endif>4
                                            </option>

                                            <option value="5" @if (isset($data) && $data->rating == 5) selected @endif>5
                                            </option>
                                        </select>
                                        @if ($errors->has('rating'))
                                            <label class="text-danger">
                                                {{ $errors->first('rating') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group mb-3">

                                        <label for="faktor"> Faktor
                                        </label>
                                        <select class="form-control" aria-label="Default select example" name="faktor"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            <option value="Strengths" @if (isset($data) && $data->faktor == 'Strengths') selected @endif>
                                                Strengths</option>

                                            <option value="Weaknesses" @if (isset($data) && $data->faktor == 'Weaknesses') selected @endif>
                                                Weaknesses</option>

                                            <option value="Opportunities"
                                                @if (isset($data) && $data->faktor == 'Opportunities') selected @endif>Opportunities</option>

                                            <option value="Threats" @if (isset($data) && $data->faktor == 'Threats') selected @endif>
                                                Threats</option>

                                        </select>
                                        @if ($errors->has('faktor'))
                                            <label class="text-danger">
                                                {{ $errors->first('faktor') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group mb-3">

                                        <label for="label"> Label
                                        </label>
                                        <select class="form-control" aria-label="Default select example" name="label"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            <option value="Benefit" @if (isset($data) && $data->label == 'Benefit') selected @endif>
                                                Benefit</option>

                                            <option value="Cost" @if (isset($data) && $data->label == 'Cost') selected @endif>
                                                Cost</option>

                                        </select>
                                        @if ($errors->has('label'))
                                            <label class="text-danger">
                                                {{ $errors->first('label') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>






                                <div class="col-md-12">
                                    @if (Request::segment(3) == 'detail')
                                        <a href="{{ route('dashboard.jenis-kriteria.ubah', $data->id) }}"
                                            class="btn btn-primary"> Ubah Data</a>
                                        <a href="{{ route('dashboard.jenis-kriteria') }}" class="btn btn-success">
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
