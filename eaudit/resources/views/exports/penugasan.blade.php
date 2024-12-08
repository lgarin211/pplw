<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>



<div class="table-responsive">
    <table class="table">
    <thead>
    <tr>
        <th>No</th>
        <th>Jenis Pengawasan</th>
        <th>Kegiatan</th>
        <th>Obrik</th>
        <th>Anggaran</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody>
      @foreach($list_penugasan as $k => $v)
    <?php 
    $total = 0;    
    ?>
    <?php 
    $sampai = strtotime($v->tp); // or your date as well
    $dari = strtotime($v->ta);
    $datediff = $sampai - $dari;
                
    if (empty($sampai)) {
        $jumlahHari = 0;
    } else {
      $jumlahHari =  round($datediff / (60 * 60 * 24))+1;
    }
                
    ?>
    
        <tr>
            <td>{{ $k+1 }}</td>
            <td>{{ $v->jenis->nama }}</td>
            <td>{{ $v->anggaran->kegiatan }}</td>
            <td>{{ $v->obrik->nama  }}</td>
            <td>{{ number_format($total) }}</td>
            <td><?php echo date("d", strtotime($v->Tanggalsurat))  ?> s/d <?php echo date("d F Y", strtotime($v->TanggalAkhir))  ?></td>
        </tr>
    @endforeach
    </tbody>
</table>
</div> 

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>