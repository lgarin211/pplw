<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Rekap Surat Tugas Pegawai Per Peran</title>
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

    <div class="page">
        <h4>Nama Pegawai : {{ $pegawai->gelar_depan }}{{ $pegawai->nama_karyawan }}{{ ",".$pegawai->gelar }}</h4>
        <h5>Peran Pegawai : {{ $peran->nama }}</h5>

        @if ($bulan == '01')
            <h5>Bulan : Januari</h5>
        @endif
        @if ($bulan == '02')
            <h5>Bulan : Februari</h5>
        @endif
        @if ($bulan == '03')
            <h5>Bulan : Maret</h5>
        @endif
        @if ($bulan == '04')
            <h5>Bulan : April</h5>
        @endif
        @if ($bulan == '05')
            <h5>Bulan : Mei</h5>
        @endif
        @if ($bulan == '06')
            <h5>Bulan : Juni</h5>
        @endif
        @if ($bulan == '07')
            <h5>Bulan : Juli</h5>
        @endif
        @if ($bulan == '08')
            <h5>Bulan : Agustus</h5>
        @endif
        @if ($bulan == '09')
            <h5>Bulan : September</h5>
        @endif
        @if ($bulan == '10')
            <h5>Bulan : Oktober</h5>
        @endif
        @if ($bulan == '11')
            <h5>Bulan : November</h5>
        @endif
        @if ($bulan == '12')
            <h5>Bulan : Desember</h5>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Rekening</th>
                    <th>Nama Pegawai</th>
                    <th>Penugasan</th>
                    <th>Nominal</th>
                    <th>Tanggal Penugasan</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php $no = 1; ?>
                <?php $total = 0; ?>
                @foreach ($surat as $ts)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $ts->pegawai->rekening }}</td>
                        <td>{{ $ts->pegawai->nama_karyawan }}</td>
                        <td>{{ $ts->surat->jenis->nama . ' Pada ' . $ts->surat->obrik->nama }}</td>
                        <td>{{ number_format($ts->perhitungan) }}</td>
                        @if (date('m', strtotime($ts->ta)) == date('m', strtotime($ts->tp)))
                            <td>{{ date('d', strtotime($ts->ta)) . ' s/d ' . Carbon\Carbon::parse($ts->tp)->translatedFormat('d F Y') }}
                            </td>
                        @else
                            <td>{{ Carbon\Carbon::parse($ts->ta)->translatedFormat(' d F') . ' s/d ' . Carbon\Carbon::parse($ts->tp)->translatedFormat(' d F Y') }}
                            </td>
                        @endif
                    </tr>
                    <?php  $total += ($ts->perhitungan)  ?>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4">Total</td>
                    <td>{{ number_format($total) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>



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
