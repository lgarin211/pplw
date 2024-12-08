@extends('admin.template')
@section('content')


 <h5>Daftar Jadwal Lain
        <div class="d-flex justify-content-end"><a href="{{ url('jadwal_lain_create') }}" class="btn btn-success">Tambah Jadwal</a></div>
    </h5>

    <div class="table-responsive text-nowrap">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pegawai</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
            <th>keterangan</th>
            <th>hari</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <?php $no = 1; ?>
            @foreach ($jd as $index => $jds)
              <?php
                $pengurangan = 0;
                $sekarang = strtotime($jds->tanggalawal);
                $akhir = strtotime($jds->tanggalakhir);

                // Loop between timestamps, 24 hours at a time
                for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
                  if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
                      $pengurangan += 1;
                  }
                }

                $sampai = $akhir; // or your date as well
                $dari = $sekarang;
                $datediff = $sampai - $dari;

                if (empty($sampai)) {
                  $jumlahHari = 0;
                } else {
                  $jumlahHari =  round($datediff / (60 * 60 * 24))+1 - $pengurangan;
                }
                ?>
          <tr>
              <td>{{ $no++ }}</td>
              <td>                                <?php echo isset($jds->Pegawai->nama_karyawan)?$jds->Pegawai->nama_karyawan:' ' ?></td>
              <td>{{ $jds->tanggalawal }}</td>
              <td>{{ $jds->tanggalakhir }}</td>
              <td>{{ $jds->keterangan }}</td>
              <td>{{ $jumlahHari }}</td>
              <td>
                <form action="{{ url('jabatan_baru/'.$jds->id.'/hapus') }}" method="POST" class="d-inline mb-3">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger">Hapus</button>
              </form>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script>

    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif

     @if (Session::has('info'))
        toastr.info("{{ Session::get('info') }}")
    @endif

      @if (Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}")
    @endif
  </script>

@endsection
