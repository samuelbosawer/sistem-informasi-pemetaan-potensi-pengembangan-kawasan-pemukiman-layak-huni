@extends('admin.layout.tamplate')
@section('title')
 Jenis Kriteria - Admin
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                                     Data Jenis Kriteria</h4>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="widget-content widget-content-area">

                                      <div class="d-flex justify-content-between">
                                        <div class="col-6">
                                            <a href="{{route('dashboard.jenis-kriteria.tambah')}}" class="btn btn-primary">   Tambah Data </a>
                                        </div>
                                        <div class="col-6">
                                           @include('admin.layout.seraching')
                                       </div>
                                      </div>


                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover table-striped">
                                                <thead>
                                                    <tr class="bg-primary text-white">
                                                        <th scope="col " width="5" class="text-light fw-bolder">Kode</th>
                                                        <th scope="col " class="text-light fw-bolder">Kriteria</th>
                                                        <th scope="col " class="text-light fw-bolder">Penilaian</th>
                                                        <th scope="col " class="text-light fw-bolder">Rating</th>
                                                        <th scope="col " class="text-light fw-bolder">Faktor</th>
                                                        <th scope="col " class="text-light fw-bolder">Label</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($datas as $data )
                                                    <tr>
                                                        <td> {{$data->kode_kriteria}}</td>
                                                        <td> {{$data->kriteria}}</td>
                                                        <td> {{$data->penilaian}}  </td>
                                                        <td> {{$data->rating}} </td>
                                                        <td> {{$data->faktor}} </td>
                                                        <td> {{$data->label}} </td>
                                                        <td class="text-center">
                                                            <div class="action-btns">
                                                                <a href="{{route('dashboard.jenis-kriteria.detail', $data->id)}}" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Detail">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                                                </a>
                                                                <a href="{{route('dashboard.jenis-kriteria.ubah', $data->id)}}" class="action-btn btn-edit bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="Ubah">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                </a>

                                                                <form class="d-inline"
                                                                action="{{ route('dashboard.jenis-kriteria.hapus', $data->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button
                                                                    class="action-btn btn-delete border-0 bg-transparent bs-tooltip" data-toggle="tooltip" data-placement="top" title="Hapus"
                                                                    onclick="return confirm('Apakah anda yakin ingin menghapus data ini ?')"
                                                                    type="submit">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>

                                                                </button>
                                                            </form>



                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="7" class="text-center">  Data tidak ada</td>
                                                    </tr>

                                                    @endforelse


                                                </tbody>
                                            </table>

                                            <div>
                                                {{ $datas->links() }}
                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>


                    </div>
                </div>

            </div>

@endsection
