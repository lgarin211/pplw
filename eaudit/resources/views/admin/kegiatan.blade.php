@extends('admin.template')
@section('content')
<style>
    #mytable {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #mytable td, #mytable th {
      border: 1px solid #ddd;
      padding: 8px;
    }

    #mytable tr:nth-child(even){background-color: #f2f2f2;}

    #mytable tr:hover {background-color: #ddd;}

    #mytable th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color:coral;
      color: white;
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <h5>Daftar Kegiatan</h5>

    <form action="{{ url('kegiatan') }}" method="get">
        @method('get')
        @csrf
        <div class="row">
            <div class="col-8"><input type="search" class="form-control" name="search" id="search" value="{{ $kegiatan }}"></div>
            {{-- <div class="col-2"><button class="btn btn-primary">SEARCH</button></div> --}}
    </form>
    <div class="col-4"><a href="{{ url('kegiatan_baru') }}" class="btn btn-success">Tambah Kegiatan</a></div>
    </div>

    <table id="mytable"  style="width: 100%; margin-top:20px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Kegiatan</th>
                <th>Kegiatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $v)
            <tr>
                <td>{{ $index + $data->firstItem() }}</td>
                <td>{{ $v->nomor }}</td>
                <td>{{ $v->kegiatan }}</td>
                <td>
                    <div class="row">
                        <div class="col-2">
                            <a href="{{ url('kegiatan_baru/' . $v->id . '/edit') }}"
                                class="btn btn-outline-primary btn-sm">Edit</a>
                        </div>
                        <div class="col-2">
                                <form action="{{ url('kegiatan_baru/' . $v->id . '/hapus') }}" method="POST"
                                    class="d-inline mb-3 ms-4">
                                    @method('delete')
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                        </div>
                    </div>


                </td>
            </tr>
            @endforeach
            </tbody>
            </table>
<div class="d-flex mt-3 justify-content-end">{{ $data->links() }}</div>


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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

    <script>
        $(document).ready(function() {
            $("#obrik").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Obrik"
            });
            $("#jenis_pengawasan").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Jenis Pengawasan"
            });
            $("#bulan").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Bulan"
            });
            $("#tahun23").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Bulan"
            });
            $("#tahun").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Anggaran Kegiatan"
            });
        });
    </script>
@endsection