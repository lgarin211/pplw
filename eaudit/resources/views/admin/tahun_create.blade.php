@extends('admin.template')
@section('content')
<div class="alert alert-info" role="alert">
    Tambah Data Tahun
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/tahun') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Tahun </label>
                    <input type="text" name="tahun" class="form-control" >
                </div>
            </div>
                       
            <button class="btn btn-primary">Tambah Tahun</button>
        </form>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function () {
     $(".toggle-password").on("click",function () {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $(".input-password input");
        if (input.attr("type")=="password") {
        input.attr("type","text");
        }else{
        input.attr("type","password");
        }
     })
   })
</script>