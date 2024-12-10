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

{{-- @if (session('Gagal'))
    {{ session('Gagal') }}
@endif --}}

 <div class="alert alert-info" role="alert">
    Tambah Data Penugasan
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/perjalananDalam') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-3 mt-4">
                   <label>NO SURAT</label>
                </div>
                <div class="col-2 mt-4">
                    <input type="text" value="{{ "700.1.1/" }}" class="form-control" readonly>
                 </div>
                <div class="col-5 mt-4">
                   <input type="text" name="noSurat" class="form-control" value="{{ old('noSurat') }}">
                </div>
                 <div class="col-2 mt-4">
                   <input type="text" value="{{ "/03"."/".session('tahun') }}" class="form-control" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Jenis Pengawasan </label>
                </div>
                <div class="col-9 mt-3">
                    <select class="form-control"  name="id_jenis_pengawasan" id="jp" >
                        <option value="">Pilih</option>
                       @foreach ($jp as $key => $p)
                          <option value="{{ $p->id }}" {{ $p->id == old('id_jenis_pengawasan') ? 'selected':'' }}>{{ $p->nama }}</option>
                       @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Obrik </label>
                </div>
                <div class="col-9 mt-3">
                    <select class="form-control"  name="id_obrik" id="obrik">
                        <option value="">Pilih</option>
                        @foreach ($obrik as $key => $p)
                           <option value="{{ $p->id }}" {{ $p->id == old('id_obrik') ? 'selected':'' }}>{{ $p->nama }}</option>
                        @endforeach
                     </select>
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Tanggal </label>
                </div>
                <div class="col-3 mt-3">
                    <input type="text" name="Tanggalsurat" class="form-control datepicker" id="ta" value="{{ old('Tanggalsurat') }}" >
                </div>
                <div class="col-1 mt-4">
                    <label for="">s/d</label>
                </div>
                <div class="col-5 mt-3">
                    <input type="text" name="TanggalAkhir" class="form-control datepicker" id="tp" value="{{ old('TanggalAkhir') }}" >
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Anggaran Kegiatan </label>
                </div>
                <div class="col-9 mt-3">
                    <select class="form-control"  name="id_anggaran" id="kegiatan">
                        <option value="">Pilih</option>
                        @foreach ($K as $key => $p)
                        <option value="{{ $p->id }}" {{ $p->id == old('id_anggaran') ? 'selected':'' }}>{{ $p->kegiatan }}</option>
                        @endforeach
                     </select>
                </div>
            </div>

            <hr>

            Tim

            <div class="row">
                <div class="col-2 mt-3">
                    <label for="">Peran </label>
                </div>
                <div class="col-5 mt-3">
                    <label for="">Pegawai </label>
                </div>
                <div class="col-5 mt-3">
                    <label for="">Tanggal Penugasan </label>
                </div>
            </div>



            <hr>
            <?php $no = 1; ?>
            @foreach ($peran as $item)
            @if ($item->nama != 'Anggota')

            <div class="row">
                <div class="col-2 mt-3">
                    <label for="">{{ $no++ }} ) {{ $item->nama }} </label>
                </div>
                <div class="col-5 mt-3">
                    <select class="form-control namaPeran chosen " name="tugas[{{ $item->id }}][id_karyawan]" >
                        <option value="">Pilih</option>
                           <option>- Pilih Nama  Pegawai -</option>
                        @foreach ($pe as $key => $p)
                           <option value="{{ $p->id }}" {{ $p->id==old('tugas.'.$item->id.'.id_karyawan')? 'selected':'' }}>{{$p->nama_karyawan }} </option>
                        @endforeach
                     </select>
                </div>
                <div class="col-3 mt-3">
                    <input type="text" name="tugas[{{ $item->id }}][ta]" class="form-control datepicker2"  value="{{ old('tugas.'. $item->id.'.ta') }}">
                </div>
                <div class="col-2 mt-3">
                    <input type="text" name="tugas[{{ $item->id }}][tp]" class="form-control datepicker2" value="{{ old('tugas.'. $item->id.'.tp') }}" >
                </div>
            </div>




            @else
            <div class="row">
                <div class="col-2 mt-3">
                    <label for=""> {{ $no++ }} Anggota </label>
                </div>
            </div>
                @for ($i = 1; $i <= 15; $i++)

                <div class="row">
                    <div class="col-2 mt-3">
                        <label for=""> {{ $item->nama }} {{ $i }} </label>
                    </div>
                    <div class="col-5 mt-3">
                        <select class="form-control namaAnggota"  name="anggota[{{ $item->id }}][{{ $i }}][id_karyawan]" >
                            <option value="">Pilih</option>
                            <option>- Pilih Nama  Pegawai -</option>
                            @foreach ($pe as $key => $p)
                               <option value="{{ $p->id }}" {{ $p->id==old('anggota.'.$item->id.'.'.$i.'.id_karyawan')? 'selected':'' }}>{{ $p->gelar_depan }}{{$p->nama_karyawan }}{{",".$p->gelar }}</option>
                            @endforeach
                         </select>
                    </div>
                    <div class="col-3 mt-3">
                         <input type="text" name="anggota[{{ $item->id }}][{{ $i }}][ta]" class="form-control datepicker2" value="{{ old('anggota.'. $item->id.'.'.$i.'.ta') }}">
                    </div>
                    <div class="col-2 mt-3">
                        <input type="text" name="anggota[{{ $item->id }}][{{ $i }}][tp]" class="form-control datepicker2" value="{{ old('anggota.'. $item->id.'.'.$i.'.tp') }}" >
                   </div>
                </div>
                @endfor
            @endif



            @endforeach

            <hr>

            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Tanggal Pembuatan Surat  </label>
                    <input type="text" name="tanggalterbitSurat" class="form-control datepicker" value="{{ old('tanggalterbitSurat') }}"  >
                </div>
            </div>

            <button class="btn btn-primary tambah">Tambah Penugasan</button>

            {{-- <button class="btn btn-danger" id="tombol">Tambah Penugasan</button> --}}


        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $("#jp").select2({
            placeholder: "Please Select",
            allowClear:true,
        });

        $("#obrik").select2({
            placeholder: "Please Select",
            allowClear:true,
        });


         $("#kegiatan").select2({
            placeholder: "Please Select",
            allowClear:true,
        });

         $(".namaPeran").select2({
            placeholder: "Please Select",
            allowClear:true,
        });

         $(".namaAnggota").select2({
            placeholder: "Please Select",
            allowClear:true,
        });
          $("#tahun").select2({
            theme: 'bootstrap4'
        });

    });
</script>

  <script>



    $( function() {
        $( ".datepicker" ).datepicker({
            dateFormat: "yy-mm-dd",
            beforeShowDay:$.datepicker.noWeekends
            //  dateFormat: "dd-mm-yy"
        });
    } );

    $(document).ready(function () {
               $("input[name=TanggalAkhir]").on("change",function(){

                    var tanggalawal =  $("input[name=Tanggalsurat]").val();
                    var tanggalakhir =  $("input[name=TanggalAkhir]").val();
                    $(".datepicker2").datepicker('destroy');

                $( ".datepicker2" ).datepicker({
                    minDate: tanggalawal,
                    maxDate: tanggalakhir,
                     dateFormat: "yy-mm-dd"
                });

               });
             });




</script>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body justify-content-center" style="text-align: justify;">
        @if (session('warning'))
        <?php  echo session('warning') ?>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body justify-content-center" style="text-align: justify;">
        @if (session('danger'))
        <?php  echo session('danger') ?>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ url('suratTugasBaru') }}" method="post">
            @csrf
            @method('post')
            <button type="submit" class="btn btn-primary" >Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

  <script>

   @if(session('warning'))
       $(document).ready(function(){
    $("#myModal").modal('show');
        });
    @endif
    // $(".chosen-select").chosen({ allow_single_deselect:true });


  </script>

<script type="text/javascript">
    $(document).ready(function(){
        $(".chosen").chosen({
        allow_single_deselect: true
    });
    });
    </script>


  <script>

    @if(session('danger'))
        $(document).ready(function(){
    $("#myModal2").modal('show');
        });
    @endif

  </script>



@endsection
