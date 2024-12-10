@extends('admin.template')
@section('content')
    <div class="alert alert-info" role="alert">
        Tambah Data Pengguna
    </div>
    <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ url('/register') }}" method="post" enctype="multipart/form-data">
                @method('post')
                @csrf
                <div class="row">
                    <div class="col-3 mb-3">
                        <label for="">Nama Pengguna </label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="">Username Pengguna </label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="col-3 mb-3">
                        <label for="">Email Pengguna </label>
                        <input type="email" name="email" class="form-control">
                    </div>
                    <div class="form-password-toggle col-3 mb-3">
                        <label class="form-label" for="basic-default-password12">Password Pengguna</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="basic-default-password12"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="basic-default-password" name="password" />
                            <span id="basic-default-password" class="input-group-text cursor-pointer"><i
                                    class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary">Tambah Pengguna</button>

            </form>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {
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
