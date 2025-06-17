<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF - {!! $title !!} - {{ now()->format('d F Y') }} </title>
    <style>
        .data {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th {
            font-weight: 600;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            position: fixed;
            bottom: -30px;
            /* Posisi footer di bawah halaman */
            left: 0;
            right: 0;
            height: 30px;
            text-align: center;
            font-size: 12px;
            color: gray;
            fon
        }
    </style>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"> --}}
</head>

<body>
    <div class="container">

        <div class="row">
            @include('admin.layout.pdf.kop')
            <div class="text-center">
                <h3 style="text-transform: uppercase;">{!! $title !!} <br>
                    {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y ') }} </h3>
            </div>
        </div>

        <div class="row">
            <div class="">
                <div class="">
                    <table class="data" border="1" width="100%">
                        <tr class="data">
                                   <th class=" text-center">Peringkat</th>
                                                <th class=" text-center">Distrik</th>
                                                <th class=" text-center">Nilai Preferensi</th>
                                                <th class=" text-center">Strategi</th>
                        </tr>
                        @php
                            $i = 0;
                        @endphp
  @foreach ($ranking as $item)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
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


                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach

                    </table>

                </div>
            </div>
        </div>
    </div>



</body>

</html>
