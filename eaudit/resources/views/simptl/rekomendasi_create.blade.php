@extends('simptl.template')
@section('content')

<div class="alert alert-info" role="alert">
    Tambah Data Rekomendasi
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/jabatan_baru') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Kode Rekomendasi </label>
                    <input type="text" name="nama" class="form-control" >
                </div>
                <div class="col-6 mb-3">
                    <label for="">Nama Rekomendasi </label>
                    <input type="text" name="nama" class="form-control" >
                </div>
            </div>
            <button class="btn btn-primary">Tambah jabatan</button>

        </form>
    </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script>
            $(document).ready(function () {
                $("#pangkat").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#kendaraan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#jabatan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                 $("#status").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#eselon").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                 $("#tahun").select2({
                    theme: 'bootstrap4'
                });
            });
        </script>

@endsection
