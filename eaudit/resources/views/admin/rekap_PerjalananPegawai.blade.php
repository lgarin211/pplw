<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title> REKAPITULASI ANGGARAN PERJALANAN DINAS </title>
    <style type="text/css">
        .page {
            width: 215.9mm;
            min-height: 355.6mm;
            padding: 10mm;
            margin: 10mm auto;
            border: 1px #D3D3D3 solid;
            background: white;
            page-break-after: always;
        }

        table,
        td,
        th {
            vertical-align: top !important;
            text-align: justify;
        }

        h1 {
            text-align: center;
        }

        @page {
            size: legal;
            margin: 20mm auto;

        }
    </style>
</head>

<body>
    @for ($bulan = 1; $bulan <= 12; $bulan++)
        <div class="page">
            @if ($bulan == 1)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Januari Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 2)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Februari Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 3)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Maret Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 4)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN April Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 5)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Mei Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 6)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Juni Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 7)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Juli Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 8)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Agustus Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 9)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN September Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 10)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Oktober Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 11)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN November Tahun {{ session('tahun') }}</h3>
            @endif
            @if ($bulan == 12)
                <h1> REKAPITULASI ANGGARAN </h1>
                <h3 class="text-center">PERJALANAN DINAS BULAN Desember Tahun {{ session('tahun') }}</h3>
            @endif

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Rekening</th>
                        <th>Nama Pegawai</th>
                        <th>Pos Anggaran</th>
                        <th>Penugasan</th>
                        <th>Nominal</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $no = 1; ?>
                    <?php $total = 0;?>
                    <?php $nomor = 0; ?>
                    @foreach ($surat[$bulan] as $k => $v)
                    @if ($v->perhitunganHari > 0)
                    <tr>
                        <td>{{ $no++; }}</td>
                        <td>{{ $v->pegawai->rekening }}</td>
                        <td>{{$v->pegawai->nama_karyawan }}</td>
                           <td><?php echo isset($v->surat->anggaran->kegiatan) ? $v->surat->anggaran->kegiatan : 'Tidak Memiliki anggaran'; ?></td>
                        <td>{{ $v->surat->jenis->nama . ' Pada ' . $v->surat->obrik->nama }}</td>




                        <td>{{ number_format($v->Perhitungan) }}</td>
                            {{-- <td>0</td> --}}

                        <?php $total += ($v->Perhitungan) ?>

                    </tr>

                    @endif
                        <?php $nomor += 1; ?>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Total</td>
                        <td>{{ number_format($total) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    @endfor

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
