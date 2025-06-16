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
                        <h3 class="mb-0 text-capitalize"> <span class="fw-bold">Langkah-langkah analisis Topsis</span></h3>
                        <div class="main-title-border bg-primary mx-auto"></div>
                        <p class="text-secondary mx-auto mt-2"> Metode TOPSIS digunakan untuk menentukan alternatif terbaik
                            berdasarkan kedekatannya dengan solusi ideal positif dan menjauhi solusi ideal negatif, melalui
                            tahapan normalisasi, pembobotan, hingga perankingan. </p>
                    </div>
                </div>
            </div>
            <div class="row mt-4 pt-4">
                <div class="col-lg-12">
                    <h2>Nilai AS dari setiap Kriteria</h2>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="bg-primary fw-bold">
                                    <th scope="col " width="5" class=" fw-bolder">Kriteria</th>
                                    @foreach ($distriks as $distrik)
                                        <th scope="col " class=" fw-bolder">{{ $distrik }}</th>
                                    @endforeach
                                    <th class=" fw-bolder">BOBOT</th>
                                    <th class=" fw-bolder">LABEL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kriterias as $kriteria)
                                    <tr>
                                        <td> {{ $kriteria }}</td>
                                        @foreach ($distriks as $distrik)
                                            <td>
                                                    {{ $matrix[$kriteria][$distrik] ?? '' }} </td>
                                        @endforeach
                                        <td>{{ $scores[$kriteria] ?? '-' }}</td>
                                        <td> {{ $labels[$kriteria] ?? '-' }} </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center"> Data tidak ada</td>

                                    </tr>
                                @endforelse


                            </tbody>
                        </table>
                    </div>



                </div>
                <div class="col-lg-12">
                    <h2>Matriks Keputusan Ternormalisasi</h2>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="bg-primary fw-bold">
                                    <th scope="col" width="5" class=" fw-bolder">
                                        Kriteria</th>
                                    @foreach ($distriks as $distrik)
                                        <th scope="col" class=" fw-bolder">
                                            {{ $distrik }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kriterias as $kriteria)
                                    <tr>
                                        <td>{{ $kriteria }}</td>
                                        @foreach ($distriks as $distrik)
                                            <td>{{ $normal[$kriteria][$distrik] ?? '-' }}</td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ count($distriks) + 1 }}" class="text-center">
                                            Data tidak
                                            ada</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>



                <div class="col-lg-12">
                    <h2>Solusi Ideal Positif (A⁺) & Negatif (A⁻)</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="bg-primary fw-bold">
                                    <th class="fw-bold">Kriteria</th>
                                    <th class="fw-bold">A⁺ (Ideal Positif)</th>
                                    <th class="fw-bold">A⁻ (Ideal Negatif)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kriterias as $kriteria)
                                    <tr>
                                        <td>{{ $kriteria }}</td>
                                        <td>{{ $idealPositive[$kriteria] ?? '-' }}</td>
                                        <td>{{ $idealNegative[$kriteria] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="col-lg-12">
                    <h2>Jarak ke Solusi Ideal Positif (D⁺) dan Negatif (D⁻)</h2>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr class="bg-primary fw-bold">
                                    <th class="fw-bold">Distrik</th>
                                    <th class="fw-bold">D⁺</th>
                                    <th class="fw-bold">D⁻</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($distriks as $distrik)
                                    <tr>
                                        <td>{{ $distrik }}</td>
                                        <td>{{ $jarakIdealPositif[$distrik] ?? '-' }}</td>
                                        <td>{{ $jarakIdealNegatif[$distrik] ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>


            <div class="col-lg-12">
                <h2>Preferensi dan Ranking Akhir</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr class="bg-success fw-bold">
                                <th class=" fw-bold">Peringkat</th>
                                <th class=" fw-bold">Kode Distrik</th>
                                <th class=" fw-bold">Nilai Preferensi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ranking as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item['distrik'] }}</td>
                                    <td>{{ $item['nilai'] }}</td>
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
