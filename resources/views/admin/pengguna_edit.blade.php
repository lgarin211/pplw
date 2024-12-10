@extends('admin.template')
@section('content')
<div class="alert alert-info" role="alert">
    Edit Data Pengguna
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
          <form action="{{ url('pengguna_baru/'.$pengguna->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Name Pengguna  </label>
                    <input type="text" name="username" class="form-control" value="{{ $pengguna->name }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">username Pengguna  </label>
                    <input type="text" name="level" class="form-control" value="{{ $pengguna->username }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Email Pengguna  </label>
                    <input type="text" name="email" class="form-control" value="{{ $pengguna->email }}">
                </div>
            </div>
               
            <button class="btn btn-primary">Edit Pengguna</button>
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
 
