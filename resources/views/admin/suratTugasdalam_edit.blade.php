@extends('admin.template')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

 <div class="alert alert-info" role="alert">
    Edit Data Penugasan
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('perjalananDalam/'.$penugasan->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf

            <div class="row">
                <div class="col-3 mt-4">
                   <label>NO SURAT</label>
                </div>
                <div class="col-2 mt-4">
                    <input type="text" value="{{ "700.1.1/" }}" class="form-control" readonly>
                 </div>
                <div class="col-5 mt-4">
                   <input type="text" name="noSurat" value="{{ old('noSurat',$penugasan->noSurat) }}" class="form-control">
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
                    <select class="form-control"  name="id_jenis_pengawasan" id="jp">
                        <option value="">Pilih</option>
                       @foreach ($jp as $key => $p)
                           <option value="{{ $p->id }}" {{ $p->id == old('id_jenis_pengawasan',$penugasan->id_jenis_pengawasan) ? 'selected':'' }}>
                            {{ $p->nama }}
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
                        <option value="{{ $p->id }}" {{ $p->id == old('id_obrik',$penugasan->id_obrik) ? 'selected':'' }}>
                            {{ $p->nama }}
                        @endforeach
                     </select>
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Tanggal </label>
                </div>
                <div class="col-3 mt-3">
                    <input type="text" name="Tanggalsurat" class="form-control datepicker" value="{{ old('Tanggalsurat',$penugasan->Tanggalsurat) }}">
                </div>
                <div class="col-1 mt-4">
                    <label for="">s/d</label>
                </div>
                <div class="col-5 mt-3">
                    <input type="text" name="TanggalAkhir" class="form-control datepicker" id="tp" value="{{ old('TanggalAkhir',$penugasan->TanggalAkhir) }}" >
                </div>
            </div>

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Anggaran Kegiatan </label>
                </div>
                <div class="col-9 mt-3">
                    <select class="form-control"  name="id_anggaran" id="kegiatan">
                        <option value="">Pilih</option>
                         @foreach ($ag as $key => $p)
                        <option value="{{ $p->id }}" {{ $p->id==$penugasan->id_anggaran?'selected':''}}>
                            {{ $p->kegiatan }}
                        @endforeach
                     </select>
                </div>
            </div>

            <hr>

            Tim
            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">Peran </label>
                </div>
                <div class="col-4 mt-3">
                    <label for="">Pegawai </label>
                </div>
                <div class="col-5 mt-3">
                    <label for="">Tanggal Penugasan </label>
                </div>
            </div>

            <?php $no = 1.; ?>
            @foreach ($peran as $item)
            @if ($item->nama != 'Anggota')

            <div class="row">
                <div class="col-3 mt-3">
                    <label for="">{{ $no++ }} {{ $item->nama }} </label>
                </div>
                <div class="col-4 mt-3">
                    @php
                        $selectname = isset($suratTugas[$item->id])? 'ubahtugas':'tugas';
                    @endphp
                    @if(isset($suratTugas[$item->id]))
                    <input type="hidden" name="ubahtugas[{{ $suratTugas[$item->id]->id }}][id_peran]" value="{{ $item->id }}">

                    @endif
                    <select class="form-control namaPeran"  @if(isset($suratTugas[$item->id])) name="ubahtugas[{{ $suratTugas[$item->id]->id }}][id_karyawan]" @else name="tugas[{{ $item->id }}][id_karyawan]" @endif >
                        <option value="">Pilih</option>
                        @foreach ($pe as $key => $p)
                        @php
                            if (isset($suratTugas[$item->id])) {
                                $selectedvalue = old($selectname.'.'.$suratTugas[$item->id]->id.'.id_karyawan',$suratTugas[$item->id]->id_karyawan);
                                # code...
                            }else {
                                # code...
                                $selectedvalue = old($selectname.'.'.$item->id.'.id_karyawan');
                            }
                        @endphp
                           {{-- <option value="{{ $p->id }}" @if(isset($suratTugas[$item->id]) AND $suratTugas[$item->id]->id_karyawan == $p->id  ) selected @endif >{{ $p->gelar_depan }}{{$p->nama_karyawan }}{{",".$p->gelar }}</option> --}}
                            <option value="{{ $p->id }}" {{ $p->id == $selectedvalue ? 'selected':'' }}  >{{ $p->gelar_depan }}{{$p->nama_karyawan }}{{",".$p->gelar }}</option>
                        @endforeach
                     </select>
                </div>
                <div class="col-3 mt-3">
                    @php
                    if (isset($suratTugas[$item->id])) {
                        $selectedvalue = old('ubahtugas'.'.'.$suratTugas[$item->id]->id.'.ta',$suratTugas[$item->id]->ta);
                        # code...
                    }else {
                        # code...
                        $selectedvalue = old('tugas'.'.'.$item->id.'.ta');
                    }
                    @endphp
                    <input type="text" @if(isset($suratTugas[$item->id])) name="ubahtugas[{{ $suratTugas[$item->id]->id }}][ta]" @else name="tugas[{{ $item->id }}][ta]" @endif class="form-control datepicker2" value="{{ $selectedvalue }}">
                </div>
                <div class="col-2 mt-3">
                    @php
                    if (isset($suratTugas[$item->id])) {
                        $selectedvalue = old('ubahtugas'.'.'.$suratTugas[$item->id]->id.'.tp',$suratTugas[$item->id]->tp);
                        # code...
                    }else {
                        # code...
                        $selectedvalue = old('tugas'.'.'.$item->id.'.tp');
                    }
                    @endphp
                    <input type="text" @if(isset($suratTugas[$item->id])) name="ubahtugas[{{ $suratTugas[$item->id]->id }}][tp]" @else name="tugas[{{ $item->id }}][tp]" @endif class="form-control datepicker2" value="{{ $selectedvalue }}">
                </div>
            </div>
            @else
                @for ($i = 1; $i <= 15; $i++)
                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">{{ $item->nama }} {{ $i }}</label>
                    </div>
                    <div class="col-4 mt-3">
                        <select class="form-control namaAnggota" @if(isset($suratAnggota[$i])) name="ubahanggota[{{ $suratAnggota[$i]->id }}][id_karyawan]" @else name="anggota[{{ $item->id }}][{{ $i }}][id_karyawan]" @endif >
                            <option value="">Pilih</option>
                             @foreach ($pe as $key => $p)
                             @php
                             if (isset($suratAnggota[$i])) {
                                 $selectedvalue = old('ubahanggota'.'.'.$suratAnggota[$i]->id.'.id_karyawan',$suratAnggota[$i]->id_karyawan);
                                 # code...
                             }else {
                                 # code...
                                 $selectedvalue = old('anggota'.'.'.$item->id.'.'.$i.'.id_karyawan');
                             }
                         @endphp
                               <option value="{{ $p->id }}" {{ $p->id == $selectedvalue ? 'selected':'' }}>{{ $p->gelar_depan }}{{$p->nama_karyawan }}{{",".$p->gelar }}</option>
                            @endforeach
                         </select>
                    </div>
                    <div class="col-3 mt-3">
                        @php
                        if (isset($suratAnggota[$i])) {
                            $selectedvalue = old('ubahanggota'.'.'.$suratAnggota[$i]->id.'.ta',$suratAnggota[$i]->ta);
                            # code...
                        }else {
                            # code...
                            $selectedvalue = old('anggota'.'.'.$item->id.'.'.$i.'.ta');
                        }
                        @endphp
                        <input type="text" @if(isset($suratAnggota[$i])) name="ubahanggota[{{ $suratAnggota[$i]->id }}][ta]" @else name="anggota[{{ $item->id }}][{{ $i }}][ta]" @endif  class="form-control datepicker2" value="{{ $selectedvalue }}">
                    </div>
                    <div class="col-2 mt-3">
                        @php
                        if (isset($suratAnggota[$i])) {
                            $selectedvalue = old('ubahanggota'.'.'.$suratAnggota[$i]->id.'.tp',$suratAnggota[$i]->tp);
                            # code...
                        }else {
                            # code...
                            $selectedvalue = old('anggota'.'.'.$item->id.'.'.$i.'.tp');
                        }
                        @endphp
                        <input type="text" @if(isset($suratAnggota[$i])) name="ubahanggota[{{ $suratAnggota[$i]->id }}][tp]" @else name="anggota[{{ $item->id }}][{{ $i }}][tp]" @endif class="form-control datepicker2" value="{{ $selectedvalue }}" >
                   </div>
                </div>

                @endfor
            @endif


            @endforeach

            <hr>

            <div class="row">
                <div class="col-12 mb-3">
                    <label for="">Tanggal Pembuatan Surat  </label>
                    <input type="text" name="tanggalterbitSurat" class="form-control datepicker" value=" {{Carbon\Carbon::parse($penugasan->tanggalterbitSurat)->translatedFormat('Y-m-d')}}">
                </div>
            </div>

             <button class="btn btn-primary">Edit Penugasan</button>

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

            $(document).ready(function () {
                    var tanggalawal =  $("input[name=Tanggalsurat]").val();
                    var tanggalakhir =  $("input[name=TanggalAkhir]").val();

                 $( ".datepicker2" ).datepicker({
                     minDate: tanggalawal,
                     maxDate: tanggalakhir,
                     beforeShowDay:$.datepicker.noWeekends,
                     dateFormat: "yy-mm-dd"
                 });


            });




  </script>

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
          <form action="{{ url('suratTugasEdit/'.$penugasan->id) }}" method="post">
            @method('put')
            @csrf
              <button type="submit" class="btn btn-primary" >Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>

    @if(session('danger'))
        $(document).ready(function(){
    $("#myModal2").modal('show');
        });
    @endif

  </script>

@endsection
