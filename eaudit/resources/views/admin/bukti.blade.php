
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Penerimaan</title>
    <link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/css/style3.css') }}" />
    <style type="text/css">
        .page {
            width: 210mm;
            min-height: 297mm;
                padding-right: 10mm;
                padding-left: 10mm;
                padding-top: 10mm;
                margin: 10mm auto;
                border: 1px #D3D3D3 solid;
                background: white;
        }
        @page {
            size: A4;
            margin: 0;
        }
    </style>
</head>
<body onload="window.print()">
     <!-- Container START -->
     <div id="colres" >
        <div class="disp" ><h2 class='judul mt-5'>DAFTAR BUKTI PENERIMAAN UANG PERJALANAN DINAS DALAM DAERAH<br>
        TAHUN ANGGARAN 2023<br>Kode Rekening <?php echo isset($penugasan->anggaran->nomor)?$penugasan->anggaran->nomor:'Belum di tentukan ' ?></h2></div><br><div><table border='0' >
        <tr ><td >Diterima Dari</td><td>:</td><td>Inspektorat Kabupaten Sragen</td></tr>
        <tr ><td >Uang sebesar</td><td>:</td><td>Tersebut dibawah ini</td></tr>
        <tr><td >Untuk &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;</td><td> : </td><td> {{ $penugasan->jenis->nama }} ke {{ $penugasan->obrik->nama }}</td></tr>
        <tr><td >Tanggal Mulai </td><td>:</td><td>{{ Carbon\Carbon::parse($penugasan->Tanggalsurat)->translatedFormat('d F Y') }}</td></tr>
        <tr ><td >Tanggal Akhir</td><td>:</td><td>{{ Carbon\Carbon::parse($penugasan->TanggalAkhir)->translatedFormat('d F Y') }}</td></tr>
        <tr><td >Atas nama</td><td></td><td></td></tr>
        </table></div>
        <div>
        <table class="table1" id="tbl" style="align:center"><thead><tr><th>NO</th><th>NAMA</th><th>JABATAN DALAM TIM</th><th style="width:50px;">JUMLAH HARI</th> <th>PERHARI</th><th>JUMLAH</th><th>NO REKENING</th></tr></thead>
        <tbody>
            <?php
            $total = 0;
            $no = 1;
            ?>
            @foreach ($surat as $s => $v)


                @if ($v->perhitunganHari > 0)

            <tr>
               <td>{{ $no++ }}</td>
               <td> {{ $v->pegawai->nama_karyawan }} </td>
               <td>{{ $v->peran->nama }}</td>
               <td style="text-align: center"> {{ $v->perhitunganHari }} </td>
               <td>{{ $v->peran->tarif }}</td>
               <td>{{  number_format($v->perhitungan)  }}</td>
               <td>{{ $v->pegawai->rekening }}</td>
            </tr>
            <?php  $total += ($v->perhitungan)  ?>
                @endif
            @endforeach
            <tr>
                <td></td>
                <td colspan="4" style="text-align: center">Jumlah</td>
                <td>{{ number_format($total) }}</td>
                <td></td>
            </tr>
        </tbody></table></div></center>

        <div class='lt'> Terbilang {{ $penugasan->totalTerbilang }}</div>
        <div id="lead" class="e">
        <p class="tgh">Sragen, {{ Carbon\Carbon::parse($penugasan->TanggalAkhir)->translatedFormat('d F Y') }}</p>
        </div>
        <table>
         <tr>
          <td class="tgh" colspan="4" width="350"><p style="margin-left: -100px">Pengguna Anggaran</p>
            <br><br><br>{{$skpd->Pemimpin->NamaBaru}} <p style="margin-left: -50px">NIP. {{ $skpd->Pemimpin->nip }}</p> </td>
          <td  class="tgh" colspan="4" width="300"> <p style="margin-left: -50px">PPTK</p>
            <br><br><br> <p style=" margin-left:3px">
                <?php echo isset($penugasan->anggaran->pptk->NamaBaru)?$penugasan->anggaran->pptk->NamaBaru:'Belum di tentukan ' ?></p>
            <p style="margin-left: -5px; margin-top:-15px"> NIP. <?php echo isset($penugasan->anggaran->pptk->nip)?$penugasan->anggaran->pptk->nip:'Belum di tentukan ' ?>
            </p>
        </td>
          <td class="tgh" colspan="4" width="300"> <p style="margin-left: -30px ">Bendahara Pengeluaran</p> <br><br><br>
           <p style="margin-left: -10px">{{ $skpd->bendahara->NamaBaru }}</p> <p style="margin-left: -5px; margin-top:-15px">NIP. {{ $skpd->bendahara->nip }}</p> </td>
         </tr>
        </table>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
