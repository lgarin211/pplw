@extends('simptl.template')
@section('content')
<style>
    #mytable {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #mytable td, #mytable th {
      border: 2px solid #000;
      padding: 8px;
    }



    #mytable th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }

    #mytable1 {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #mytable1 td, #mytable th {
      border: 2px solid #000;
      padding: 8px;
    }



    #mytable1 th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color:#32CD32;
      color: white;
    }
    </style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Tambah Penugasan
  </button>

  <table id="mytable" class="table-light mt-2" style="width: 100%">
    <thead>
        <tr>
            <tr>
                <th>#</th>
                <th>Penugasan</th>
                <th>Tipe Rekomendasi</th>
                <th>Tipe Pemeriksaan</th>
                <th>Wilayah Pemeriksaan</th>
                <th>Tim Pemeriksaan</th>
                <th>Aksi</th>
            </tr>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0" style="background-color: white">
        @foreach ($pengawasan as $index => $v)
            <tr>
                <td>{{ $index + $pengawasan->firstItem() }}</td>
                <td>{{ $v->surat->jenis->nama }}pada{{ $v->surat->obrik->nama }} </td>
                <td>{{ $v->tipe }}</td>
                <td>{{ $v->jenis }}</td>
                <td>{{ $v->wilayah}}</td>
                <td>{{ $v->pemeriksa }}</td>
                <td><form action="{{ url('simptl/pkpt_hapus/'.$v->id.'/hapus') }}" method="POST" class="d-inline mb-3">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger btn-sm ">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Penugasan</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ url('arsip/cari') }}" method="post">
                @csrf
                @method('post')
                <div class="row">
                    <div class="col-3 mt-3">
                        <label for="">Obrik</label>
                        <input type="text" class="form-control" name="obrik" >
                    </div>
                    <div class="col-3 mt-3">
                        <label for="">Jenis Pengawasan</label>
                        <input type="text" name="jenisPengawasan" class="form-control" id="search">
                    </div>
                    <div class="col-3 mt-3">
                        <label for="">Bulan</label>
                        <select name="bulan" id="bulan" class="form-control filter">
                            <option value="">Pilih Bulan</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="col-3 mt-3">
                        <label for="">Tahun</label>
                        <select name="filtertahun" id="filtertahun" class="form-control" >
                            <option value="">PILIH TAHUN</option>
                            @for ($i = 2022; $i <= date('Y'); $i++)
                             <option value="{{ $i }}">{{ $i }}</option>
                             @endfor
                         </select>
                    </div>
                </div>
                <button class="btn btn-info mt-3" type="button" id="submit">SUBMIT</button>
            </form>

                {{-- <table id="mytable1" class="table mt-2">
                    <thead>
                            <tr>
                                <th>Nomor Surat</th>
                                <th>Obrik</th>
                                <th>Jenis Pengawasan</th>
                                <th>Bulan Penugasan</th>
                                <th>Tahun Penugasan</th>
                                <th>Aksi</th>
                            </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="tbody">
                        @foreach ($penugasan as $k => $v)
                            <tr>
                                <td>{{ "094/".$v->noSurat."/03"."/".session('tahun') }}</td>
                                <td><?php echo isset($v->obrik->nama)?$v->obrik->nama:' ' ?></td>
                                <td><?php echo isset($v->jenis->nama)?$v->jenis->nama:' ' ?></td>
                                <td class="kolom">{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('F') }} </td>
                                <td class="kolom">{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('Y') }}   </td>
                                <td><a href="{{ url('simptl/pkpt_tambah/' . $v->id) }}"
                                    class="btn btn-outline-primary ">Pilih </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}

                <table id="mytable" class="mt-2"  style="width: 100%">
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Obrik</th>
                            <th>Jenis Pengawasan</th>
                            <th>Bulan Penugasan</th>
                            <th>Tahun Penugasan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0" id="tbody">
                        @foreach ($penugasan as $k => $v)
                            <tr>
                                <td>{{ "094/".$v->noSurat."/03"."/".session('tahun') }}</td>
                                <td><?php echo isset($v->obrik->nama)?$v->obrik->nama:' ' ?></td>
                                <td><?php echo isset($v->jenis->nama)?$v->jenis->nama:' ' ?></td>
                                <td class="kolom">{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('F') }} </td>
                                <td class="kolom">{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('Y') }}   </td>
                                <td><a href="{{ url('simptl/pkpt_tambah/' . $v->id) }}"
                                    class="btn btn-outline-primary ">Pilih </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                        </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(document).on('click','#submit',function () {
        $.ajax({
        type : 'get',
        url : '{{URL::to('searchJP')}}',
        data:{'obrik':$('input[name=obrik]').val(),'jenisPengawasan':$('input[name=jenisPengawasan]').val(),'bulan':$('select[name=bulan] option:selected').val(),'tahun':$('select[name=filtertahun] option:selected').val()},
        success:function(data){
        $('#tbody').html(data);
        }
        });
    });

//   let keyword = document.querySelector('#search');
// //   var key = document.querySelector('#search1');

//   keyword.addEventListener('keyup',function () {
//     $value=$(keyword).val();
//     $.ajax({
//     type : 'get',
//     url : '{{URL::to('searchJP')}}',
//     data:{'search':$value},
//     success:function(data){
//     $('tbody').html(data);
//     }
//     });
//   });




//   key.addEventListener('keyup',function () {
//     $value=$(key).val();
//     $.ajax({
//     type : 'get',
//     url : '{{URL::to('searchObrik')}}',
//     data:{'search':$value},
//     success:function(data){
//     $('tbody').html(data);
//     }
//     });

//   if ((keyword.keyup) AND (key.keyup)) {
//     alert('cek');
//   }

// $('#search',).on('keyup',function(){
// $value=$(this).val();
// $.ajax({
// type : 'get',
// url : '{{URL::to('searchPKPT')}}',
// data:{'search':$value},
// success:function(data){
// $('tbody').html(data);
// }
// });


  </script>
@endsection
