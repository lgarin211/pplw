<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table class="table">
    <thead>
    <tr>
        <th>No</th>
        <th>No Rekening</th>
        <th>Nama Pegawai</th>
        <th>Pos Anggaran</th>
        <th>penugasan</th>
        <th>Nominal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($penugasan as $k => $ps)
         <tr>
                 <td>{{ $k+1 }}</td>
                <td>{{ $ps->anggaran->nomor }}</td>
                <td> @foreach ($ps->surat as $item)
                     <li> {{ $item->pegawai->nama_karyawan }}</li>
                  @endforeach
                </td>
                <td>{{ $ps->anggaran->kegiatan }}</td>
                <td>{{ $ps->jenis->nama }} di {{ $ps->obrik->nama }}</td>
                {{-- <td>nominal</td> --}}
              </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>