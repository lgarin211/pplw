<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Surat Pengalaman Kerja</title>
    <link href="{{ url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('sneat-1.0.0/assets/css/style2.css') }}" />
  </head>
  <style>
    .tes {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
}



  </style>

  <body onload="window.print()" >

    <div class="container">
        <h2 class="text-center">REKAPITULASI PENILAIAN</h2>
        <h3  class="text-center mt-3">PERJALANAN DINAS BULAN Januari Tahun 2023</h3>       
    </div>

     <table style="width:100%">
            <thead>
              <tr>
                <th>NO</th>
                <th>Jenis Pemeriksaan</th>
                <th>Kegiatan</th>
                <th>Obrik</th>
                <th>Anggaran</th>
                <th>Tanggal</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($penugasan as $k => $v)   
              <tr>
                <th scope="row">{{ $k+1 }}</th>
                <td>{{ $v->jenis->nama }}</td>
                <td>{{ $v->anggaran->kegiatan }}</td>
                <td>{{ $v->obrik->nama }}</td>
                <td>Mark</td>
                <td><?php echo date("d", strtotime($v->Tanggalsurat))  ?> s/d <?php echo date("d F Y", strtotime($v->TanggalAkhir))  ?></td>
              </tr>
              @endforeach
              <tr>
                <td colspan="4">TOTAL</td>
                <td>x</td>
                <td></td>
              </tr>
            </tbody>
          </table>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>