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
    Tambah Data Jadwal Lain
  </div>

    <div class="card-body">
        <form action="{{ url('/jadwal_lain') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-3 mb-3">
                    <label for="">Nama Pegawai </label>
                     <select id="pangkat" class="form-control" name="id_pegawai">
                         @foreach ($pegawai as $key => $p)
                           <option value="{{ $p->id }}">{{ $p->gelar_depan }}{{ $p->nama_karyawan }}{{ ",".$p->gelar }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-3 mb-3">
                    <label for="">Tanggal Awal </label>
                    <input type="text" name="tanggalawal" class="form-control datepicker" >
                </div>
                <div class="col-3 mb-3">
                    <label for="">Tanggal Akhir </label>
                    <input type="text" name="tanggalakhir" class="form-control datepicker" >
                </div>
                <div class="col-3 mb-3">
                    <label for="">keterangan </label>
                    <input type="text" name="keterangan" class="form-control" >
                </div>
            </div>

            <button class="btn btn-primary">Tambah  Jadwal Lain</button>
        </form>
    </div>

  <script>
            $(document).ready(function () {
                $("#pangkat").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#jabatan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                 $("#eselon").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
            });

            </script>
           <script>

            $( function() {

                $( ".datepicker" ).datepicker({
                    dateFormat: "yy-mm-dd",
                    beforeShowDay:$.datepicker.noWeekends
                });

            } );

             </script>
@endsection
