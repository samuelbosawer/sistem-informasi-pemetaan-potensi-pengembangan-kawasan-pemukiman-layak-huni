@extends('visitor.layout.tamplate')
@section('title')
    Topsis
@endsection

@section('content')
    <!-- Start How It Work -->
    <section class="section bg-light mt-5" id="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="mb-0 text-capitalize"> <span class="fw-bold">Rekomendasi</span></h3>
                        <div class="main-title-border bg-primary mx-auto"></div>
                        <p class="text-secondary mx-auto mt-2">  Hasil rekomendasi diperoleh dari proses perankingan menggunakan metode TOPSIS, di mana alternatif dengan nilai tertinggi dianggap sebagai pilihan terbaik karena paling mendekati solusi ideal. </p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4">
                <div class="col-lg-12">
                    {{-- <h2>Nilai AS dari setiap Kriteria</h2> --}}

                      <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th class="">Peringkat</th>
                                                <th class="">Distrik</th>
                                                <th class="">Nilai Preferensi</th>
                                                <th class="">Strategi</th>

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
    </section>
@endsection
