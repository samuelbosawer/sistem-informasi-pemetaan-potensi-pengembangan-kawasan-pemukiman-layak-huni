@extends('admin.layout.tamplate')
@section('title')
    Tambah Data Kriteria - Admin
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            {{$judul ?? 'Tambah Data Kriteria' }} </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-content widget-content-area">

                                @if (Request::segment(4) == 'ubah')
                                    <form action="{{ route('dashboard.kriteria.update', $data->id) }}" method="post"
                                        enctype="multipart/form-data" class="row g-3">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('dashboard.kriteria.store') }}" method="post"
                                            enctype="multipart/form-data" class="row g-3">
                                @endif
                                @csrf
                                <div class="col-md-6">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input type="text" name="rating" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('rating') ?? ($data->rating ?? '')}}" class="form-control" id="rating">
                                    @if ($errors->has('rating'))
                                        <label class="text-danger"> {{ $errors->first('rating') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">

                                        <label for="jenis_kriteria_id"> Jenis Kategori
                                        </label>
                                        <select class="form-control" aria-label="Default select example"
                                            name="jenis_kriteria_id"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            @foreach ($kriteria as $k )
                                                <option value="{{$k->id}}"
                                                {{ (old('jenis_kriteria_id') ?? ($data->jenis_kriteria_id ?? '')) == $k->id ? 'selected' : '' }}>
                                                {{$k->kriteria}}</option>
                                            @endforeach


                                        </select>
                                        @if ($errors->has('jenis_kriteria_id'))
                                            <label class="text-danger">
                                                {{ $errors->first('jenis_kriteria_id') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="bobot" class="form-label">Bobot</label>
                                    <input type="text" name="bobot" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('bobot') ?? ($data->bobot ?? '')}}" class="form-control" id="bobot">
                                    @if ($errors->has('bobot'))
                                        <label class="text-danger"> {{ $errors->first('bobot') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="skor" class="form-label">Skor</label>
                                    <input type="text" name="skor" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('skor') ?? ($data->skor ?? '')}}" class="form-control" id="skor">
                                    @if ($errors->has('skor'))
                                        <label class="text-danger"> {{ $errors->first('skor') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="total_nilai" class="form-label">Total Nilai Faktor</label>
                                    <input type="text" name="total_nilai_faktor" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('total_nilai_faktor') ?? ($data->total_nilai_faktor ?? '')}}" class="form-control" id="total_nilai_faktor">
                                    @if ($errors->has('total_nilai_faktor'))
                                        <label class="text-danger"> {{ $errors->first('total_nilai_faktor') }}
                                        </label>
                                    @endif
                                </div>




                                <div class="col-md-10">
                                    @if (Request::segment(3) == 'detail')

                                    <a href="{{route('dashboard.kriteria.ubah',$data->id)}}" class="btn btn-primary"> Ubah Data</a>
                                    <a href="{{route('dashboard.kriteria')}}" class="btn btn-success"> Kembali</a>
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
