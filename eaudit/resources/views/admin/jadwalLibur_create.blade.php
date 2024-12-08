@extends('admin.template')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <link href='chosen/chosen.min.css' rel='stylesheet' type='text/css'>
  <script src='chosen/chosen.jquery.min.js' type='text/javascript'></script>
<style>
    .warning{
        font-size: 14px;
        text-align: justify;
    }
</style>
<div class="alert alert-info" role="alert">
    Tambah Data Jadwal Libur
  </div>

    <div class="card-body">
        <form action="{{ url('/jadwal_libur') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Tanggal Awal </label>
                    <input type="text" name="tanggalawal" class="form-control datepicker22" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Tanggal Akhir </label>
                    <input type="text" name="tanggalakhir" class="form-control datepicker22" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">keterangan </label>
                    <input type="text" name="keterangan" class="form-control" >
                </div>
            </div>

            <button class="btn btn-primary">Tambah  Jadwal Libur</button>
        </form>
    </div>
    </div>

    <script>

        $( function() {

            $( ".datepicker22" ).datepicker({
                dateFormat: "yy-mm-dd",
                beforeShowDay:$.datepicker.noWeekends
            });

        } );

         </script>
@endsection
