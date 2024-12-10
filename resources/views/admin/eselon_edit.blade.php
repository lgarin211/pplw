@extends('admin.template')
@section('content')
<div class="alert alert-info" role="alert">
    Edit Data Eselon
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('eselon_baru/'.$eselon->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Nama Eselon </label>
                    <input type="text" name="nama" class="form-control" value="{{ $eselon->nama }}">
                </div>
            </div> 
               
            <button class="btn btn-primary">Edit Eselon</button>
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
 