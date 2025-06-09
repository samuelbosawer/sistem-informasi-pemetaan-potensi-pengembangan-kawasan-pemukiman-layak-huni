@extends('admin.layout.tamplate')
@section('title')
    Tambah Data rekomendasi - Admin
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
                                            {{$judul ?? 'Tambah Data rekomendasi' }} </h4>
                                    </div>
                                </div>
                            </div>


                            <div class="widget-content widget-content-area">

                                @if (Request::segment(4) == 'ubah')
                                    <form action="{{ route('dashboard.rekomendasi.update', $data->id) }}" method="post"
                                        enctype="multipart/form-data" class="row g-3">
                                        @method('PUT')
                                    @else
                                        <form action="{{ route('dashboard.rekomendasi.store') }}" method="post"
                                            enctype="multipart/form-data" class="row g-3">
                                @endif
                                @csrf
                                 <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="strategi_id"> Strategi
                                        </label>

                                        <select class="form-control" aria-label="Default select example"
                                            name="strategi_id"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>
                                            @foreach ($strategi as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ (old('strategi_id') ?? ($data->strategi_id ?? '')) == $s->id ? 'selected' : '' }}>

                                                 @if ($s->satu)
                                                    {{ $s->tipe . ' - ' }}  {{ $s->satu->kriteria }},
                                                @endif

                                                @if ($s->dua)
                                                 {{ $s->dua->kriteria }},
                                                @endif

                                                @if ($s->tiga)
                                                     {{ $s->tiga->kriteria }},
                                                @endif

                                                @if ($s->empat)
                                                    {{ $s->empat->kriteria }},
                                                @endif

                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('strategi_id'))
                                            <label class="text-danger">
                                                {{ $errors->first('strategi_id') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>

                                  <div class="col-md-8">
                                    <div class="form-group mb-3">
                                        <label for="kode_distrik"> Distrik
                                        </label>

                                        <select class="form-control" aria-label="Default select example"
                                            name="kode_distrik"
                                            @if (Request::segment(3) == 'detail') {{ 'disabled' }} @endif>
                                            @foreach ($distrik as $s)
                                                <option value="{{ $s->kode_distrik}}"
                                                    {{ (old('kode_distrik') ?? ($data->kode_distrik ?? '')) == $s->kode_distrik? 'selected' : '' }}>

                                                {{ $s->nama_distrik }}

                                                </option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('kode_distrik'))
                                            <label class="text-danger">
                                                {{ $errors->first('kode_distrik') }}
                                            </label>
                                        @endif
                                    </div>
                                </div>



                                <div class="col-md-10">
                                    @if (Request::segment(3) == 'detail')

                                    <a href="{{route('dashboard.rekomendasi.ubah',$data->id)}}" class="btn btn-primary"> Ubah Data</a>
                                    <a href="{{route('dashboard.rekomendasi')}}" class="btn btn-success"> Kembali</a>
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
