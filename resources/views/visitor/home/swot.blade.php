@extends('visitor.layout.tamplate')
@section('title')
    Swot
@endsection

@section('content')
    <!-- Start How It Work -->
    <section class="section bg-light mt-5" id="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h3 class="mb-0 text-capitalize"> <span class="fw-bold">Langkah-langkah analisis SWOT</span></h3>
                        <div class="main-title-border bg-primary mx-auto"></div>
                        <p class="text-secondary mx-auto mt-2"> Melakukan penilaian terhadap faktor internal seperti kekuatan
                            dan kelemahan, serta faktor eksternal seperti peluang dan ancaman, untuk membantu dalam
                            pengambilan keputusan strategis. </p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4">
                <div class="col-lg-12">
                    <h2>Penilaian Bobot</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="bg-dark">
                                    <th scope="col " width="5" class=" fw-bolder">Kode</th>
                                    <th scope="col " class=" fw-bolder">Kriteria dan faktor</th>
                                    <th scope="col " class=" fw-bolder">Penilaian</th>
                                    <th scope="col " class=" fw-bolder">Label</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($datas as $data)
                                    <tr>
                                        <td> {{ $data->kode_kriteria }}</td>
                                        <td> {{ $data->kriteria }}</td>
                                        <td> {{ $data->penilaian }} </td>
                                        <td> {{ $data->label }} </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> Data tidak ada</td>
                                    </tr>
                                @endforelse


                            </tbody>
                        </table>

                        <div>

                        </div>
                    </div>



                </div>
                <h2>Pencarian Nilai IFAS dan EFAS</h2>
                <div class="col-lg-6">

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="bg-primary ">
                                    <th scope="col " width="5" class=" fw-bolder">Kode</th>
                                    <th scope="col " class=" fw-bolder">Faktor Internal</th>
                                    <th scope="col " class=" fw-bolder">Penilaian</th>
                                    <th scope="col " class=" fw-bolder">Bobot</th>
                                    <th scope="col " class=" fw-bolder">Rating</th>
                                    <th scope="col " class=" fw-bolder">Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nilaiA as $data)
                                    <tr>
                                        <td> {{ $data->kode_kriteria }}</td>
                                        <td> {{ $data->kriteria }}</td>
                                        <td> {{ $data->penilaian }} </td>
                                        <td> {{ $bobot = number_format($data->penilaian / $totalNilaiA, 3) }}
                                        </td>
                                        <td> {{ $data->rating }} </td>
                                        <td> {{ $skor = $data->rating * $bobot }} </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> Data tidak ada</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="2">Jumlah Faktor Internal </td>
                                    <td>{{ $totalNilaiA }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                            </tbody>
                        </table>

                        <div>

                        </div>
                    </div>
                </div>



                <div class="col-lg-6">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="bg-primary ">
                                    <th scope="col " width="5" class=" fw-bolder">Kode</th>
                                    <th scope="col " class=" fw-bolder">Faktor Eksternal</th>
                                    <th scope="col " class=" fw-bolder">Penilaian</th>
                                    <th scope="col " class=" fw-bolder">Bobot</th>
                                    <th scope="col " class=" fw-bolder">Rating</th>
                                    <th scope="col " class=" fw-bolder">Skor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($nilaiB as $data)
                                    <tr>
                                        <td> {{ $data->kode_kriteria }}</td>
                                        <td> {{ $data->kriteria }}</td>
                                        <td> {{ $data->penilaian }} </td>
                                        <td> {{ $bobot = number_format($data->penilaian / $totalNilaiB, 3) }}
                                        </td>
                                        <td> {{ $data->rating }} </td>
                                        <td> {{ $skor = $data->rating * $bobot }} </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> Data tidak ada</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="2">Jumlah Faktor Eksternal </td>
                                    <td>{{ $totalNilaiB }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                            </tbody>
                        </table>

                        <div>

                        </div>
                    </div>
                </div>


                <div class="col-lg-12">
                    <h2>Rekomendasi SWOT</h2>
                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr class="bg-primary  text-center">
                                                    <th style="width:10%"></th>
                                                    <th style="width:45%" class="fw-bolder ">Kekuatan (Strength/S)</th>
                                                    <th style="width:45%" class="fw-bolder ">Kelemahan (Weakness/W)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th class="bg-warning  text-center align-middle"
                                                        rowspan="2">
                                                        Peluang (Opportunity/O)
                                                    </th>
                                                    <td>
                                                        <strong>Strategi SO</strong>
                                                        <ol type="1">
                                                            {{-- @dd($so) --}}
                                                           @foreach ($so as $s)
                                                                @if (!empty($s->satu->kriteria))
                                                                    <li>{{ $s->satu->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($s->dua->kriteria))
                                                                    <li>{{ $s->dua->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($s->tiga->kriteria))
                                                                    <li>{{ $s->tiga->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($s->empat->kriteria))
                                                                    <li>{{ $s->empat->kriteria }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ol>
                                                    </td>
                                                    <td>
                                                        <strong>Strategi WO</strong>
                                                        <ol type="1">
                                                            @foreach ($wo as $w)
                                                                @if (!empty($w->satu->kriteria))
                                                                    <li>{{ $w->satu->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($w->dua->kriteria))
                                                                    <li>{{ $w->dua->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($w->tiga->kriteria))
                                                                    <li>{{ $w->tiga->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($w->empat->kriteria))
                                                                    <li>{{ $w->empat->kriteria }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ol>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <strong>Strategi ST</strong>
                                                        <ol type="1">
                                                            @foreach ($st as $s)
                                                                 @if (!empty($s->satu->kriteria))
                                                                    <li>{{ $s->satu->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($s->dua->kriteria))
                                                                    <li>{{ $s->dua->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($s->tiga->kriteria))
                                                                    <li>{{ $s->tiga->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($s->empat->kriteria))
                                                                    <li>{{ $s->empat->kriteria }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ol>
                                                    </td>
                                                    <td>
                                                        <strong>Strategi WT</strong>
                                                        <ol type="1">
                                                            @foreach ($wt as $w)
                                                               @if (!empty($w->satu->kriteria))
                                                                    <li>{{ $w->satu->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($w->dua->kriteria))
                                                                    <li>{{ $w->dua->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($w->tiga->kriteria))
                                                                    <li>{{ $w->tiga->kriteria }}</li>
                                                                @endif

                                                                @if (!empty($w->empat->kriteria))
                                                                    <li>{{ $w->empat->kriteria }}</li>
                                                                @endif
                                                            @endforeach
                                                        </ol>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                </div>
            </div>





        </div>
        </div>
    </section>
@endsection
