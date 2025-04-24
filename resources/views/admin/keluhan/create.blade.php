@extends('admin.layout.tamplate')
@section('title')
{{$judul ?? 'Tambah Keluhan' }} - Admin
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                                            {{$judul ?? 'Tambah Keluhan' }} </h4>
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
                                <div class="col-md-6">
                                    <label for="keluhan" class="form-label">Keluhan</label>
                                    <input type="text" name="keluhan" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('keluhan') ?? ($data->keluhan ?? '')}}" class="form-control" id="keluhan">
                                    @if ($errors->has('keluhan'))
                                        <label class="text-danger"> {{ $errors->first('keluhan') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <label for="tanggal" class="form-label">Tanggal</label>
                                    <input type="date" name="tanggal" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('tanggal') ?? ($data->tanggal ?? '')}}" class="form-control" id="tanggal">
                                    @if ($errors->has('tanggal'))
                                        <label class="text-danger"> {{ $errors->first('tanggal') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    @if (isset($data) && $data->foto)
                                    <img src="{{asset($data->foto)}}" width="100" rounded alt="" srcset="">
                                    @endif
                                    <label for="foto" class="form-label">foto</label>
                                    <input type="file" name="foto" @if (Request::segment(3) == 'detail') disabled @endif  value="{{old('foto') ?? ($data->foto ?? '')}}" class="form-control" id="foto">
                                    @if ($errors->has('foto'))
                                        <label class="text-danger"> {{ $errors->first('foto') }}
                                        </label>
                                    @endif
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">

                                        <label for="user_id"> Pelapor
                                        </label>
                                        <select class="form-control" aria-label="Default select example"
                                            name="user_id"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>

                                            @foreach ($users as $k )
                                                <option value="{{$k->id}}"
                                                {{ (old('user_id') ?? ($data->user_id ?? '')) == $k->id ? 'selected' : '' }}>
                                                {{$k->nama}}</option>
                                            @endforeach


                                        </select>
                                        @if ($errors->has('user_id'))
                                            <label class="text-danger">
                                                {{ $errors->first('user_id') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    @if (Request::segment(3) == 'detail')

                                    <a href="{{route('dashboard.keluhan.ubah',$data->id)}}" class="btn btn-primary"> Ubah Data</a>
                                    <a href="{{route('dashboard.keluhan')}}" class="btn btn-success"> Kembali</a>
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
