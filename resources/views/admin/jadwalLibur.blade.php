@extends('admin.template')
@section('content')

 <h5>Daftar Jadwal Libur
        <div class="d-flex justify-content-end"><a href="{{ url('jadwal_libur_create') }}" class="btn btn-success">Tambah Jadwal Libur</a></div>
    </h5>

    <div class="table-responsive text-nowrap">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal Awal</th>
            <th>Tanggal Akhir</th>
            <th>keterangan</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <?php $no = 1; ?>
            @foreach ($jl as $index => $jls)
          <tr>
              <td>{{ $no++ }}</td>
              <td>{{ $jls->tanggalawal }}</td>
              <td>{{ $jls->tanggalakhir }}</td>
              <td>{{ $jls->keterangan }}</td>
              <td>
                <form action="{{ url('jadwal_libur/'.$jls->id.'/hapus') }}" method="POST" class="d-inline mb-3">
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
