@extends('admin.layout.tamplate')
@section('title')
{{$judul ?? 'Tambah Data Jenis Kriteria' }} - Admin
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                            {{$judul ?? 'Tambah Data Jenis Kriteria' }} </h4>
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
                                    <label for="kriteria" class="form-label">Nama kriteria</label>
                                    <input type="text" name="kriteria" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('kriteria') ?? ($data->kriteria ?? '')}}" class="form-control" id="kriteria">
                                    @if ($errors->has('kriteria'))
                                        <label class="text-danger"> {{ $errors->first('kriteria') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="jenis_kriteria" class="form-label">Jenis Kriteria</label>
                                    <input type="text" name="jenis_kriteria" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('jenis_kriteria') ?? ($data->jenis_kriteria ?? '')}}" class="form-control" id="jenis_kriteria">
                                    @if ($errors->has('jenis_kriteria'))
                                        <label class="text-danger"> {{ $errors->first('jenis_kriteria') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="nilai" class="form-label">Nilai</label>
                                    <input type="text" name="nilai" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('nilai') ?? ($data->nilai ?? '')}}" class="form-control" id="nilai">
                                    @if ($errors->has('nilai'))
                                        <label class="text-danger"> {{ $errors->first('nilai') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="total_nilai" class="form-label">Total Nilai</label>
                                    <input type="text" name="total_nilai" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('total_nilai') ?? ($data->total_nilai ?? '')}}" class="form-control" id="total_nilai">
                                    @if ($errors->has('total_nilai'))
                                        <label class="text-danger"> {{ $errors->first('total_nilai') }}
                                        </label>
                                    @endif
                                </div>


                                <div class="col-md-6">
                                    @if (Request::segment(3) == 'detail')

                                    <a href="{{route('dashboard.jenis-kriteria.ubah',$data->id)}}" class="btn btn-primary"> Ubah Data</a>
                                    <a href="{{route('dashboard.jenis-kriteria')}}" class="btn btn-success"> Kembali</a>
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
