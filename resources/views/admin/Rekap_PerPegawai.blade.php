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
        <h2 class="text-center">REKAPITULASI ANGGARAN</h2>
        <h3  class="text-center mt-3">PERJALANAN DINAS BULAN Januari Tahun 2023</h3>

        <h4>Total Anggaran : </h4>
        <table class="table mt-3">
            <thead>
              <tr>
                <th scope="col">NO REKENING</th>
                <th scope="col">NAMA PEGAWAI</th>
                <th scope="col">POS ANGGARAN</th>
                <th scope="col">PENUGASAN</th>
                <th scope="col">NOMINAL</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($penugasan as $v)

              <tr>
                <td>{{ $v->anggaran->nomor }}</td>
                <td> @foreach ($v->surat as $item)
                     <li> {{ $item->pegawai->nama_karyawan }}</li>
                  @endforeach
                </td>
                <td>{{ $v->anggaran->kegiatan }}</td>
                <td>{{ $v->jenis->nama }}</td>
                {{-- <td>nominal</td> --}}
              </tr>
                 @endforeach
            </tbody>
          </table>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
