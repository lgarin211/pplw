@extends('simptl.template')
@section('content')
<style>
    table #baris1 .kolom1{
        margin-left: 10px;
    }
    table #baris .kolom{
        margin-left: 20px;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="alert alert-info" role="alert">
    Pengawasan
  </div>
<div class="card mb-4">
    <div class="card-header">Data Penugasan</div>
    <div class="card-body">
        <form action="{{ url('/jabatan_baru'.$surat->id) }}" method="post" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Nomor Surat </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ "094/".$surat->surat->noSurat."/03/2023" }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Jenis Pengawasan </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->jenis->nama }}" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Obrik Pengawasan </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->obrik->nama }}">
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Tanggal surat </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->Tanggalsurat }}"  >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Tanggal Akhir </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->TanggalAkhir }}" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Status LHP </label>
                    <input type="text" name="nama" readonly class="form-control" value="Belum Jadi">
                </div>
            </div>
        </form>
    </div>
</div>


<div class="card" id="card">
<div class="card-header">Tambah Jenis Temuan & Rekomendasi</div>
<div class="card">
    <div class="d-flex justify-content-end" style="background-color:bisque"><button type="button" class="btn btn-primary btn-sm" id="add_card"><i class="fa-solid fa-plus"></i></button></div>
    @php
        $no = 1;
    @endphp
    <div class="card-header">Tambah Jenis Temuan {{ $no++; }} </div>
    <div class="card-body">
         <form action="{{ url('simptl/jenisTemuan/'.$surat->id) }}" method="post" enctype="multipart/form-data">
           @method('POST')
           @csrf
           <table class="table">
               <thead>
                   <tr>
                       <th scope="col">KODE TEMUAN</th>
                       <th scope="col">NAMA TEMUAN</th>
                   </tr>
               </thead>
               <tbody>
                   <tr>
                   <td>
                       <input type="text" name="kode_temuan[0]"  class="form-control" >
                   </td>
                   <td>
                       <input type="text" name="nama_temuan[0]"  class="form-control" >
                   </td>
                   </tr>
               </tbody>
           </table>

           <table class="table">
            <thead>
              <tr>
                <th scope="col">KODE REKOMENDASI</th>
                <th scope="col">NAMA REKOMENDASI</th>
                <th scope="col">KETERANGAN REKOMENDASI</th>
                <th scope="col">PENGEMBALIAN KEUANGAN</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody class="body">
              <tr>
                <td><input type="text" class="form-control" name="kode_rekomendasi[0]"></td>
                <td><input type="text" class="form-control" name="rekomendasi[0]"></td>
                <td><input type="text" class="form-control" name="keterangan[0]"></td>
                <td><input type="text" class="form-control rupiah" name="pengembalian[0]" ></td>
                <td><button type="button" class="btn btn-primary" id="add_btn1"><i class="fa-solid fa-plus"></i></button></td>
              </tr>
            </tbody>
          </table>

</div>
</div>
</div>

<br><br>

<div class="card mb-4">
            <button class="btn btn-primary">Tambah PKPT</button>
            <button class="btn btn-success">Batal</button>
        </form>
    </div>

<div class="card" id="card"></div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="{{ asset('skydash/js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('skydash/js/jquery.min.js') }}"></script>
  <script>
    $(document).ready(function(){
        $('.rupiah').mask('#.##0,00',{
            reverse:true
        });
    });
  </script>
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
            });
        </script>
   <script type="text/javascript">
    $(document).ready(function () {
        let index = 0;
        let index1 = 0;

        $('#add_btn1').on('click',function () {
            index++;
            var html='';
            html+='<tr id="baris1">';
            html+='<td><input type="text" class="form-control kolom1" name="kode_rekomendasi['+index+']"></td>';
            html+='<td><input type="text" class="form-control kolom1" name="rekomendasi['+index+']"></td>';
            html+='<td><input type="text" class="form-control kolom1" name="keterangan['+index+']"></td>';
            html+='<td><input type="text" class="form-control kolom1" name="pengembalian['+index+']"></td>';
            html+='<td><button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
            html+='<td><button type="button" class="btn btn-success" id="add_btn"><i class="fa-solid fa-plus"></i></button></td>';
            html+='</tr>';
            $('.body').append(html);
        })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })

        $(document).on('click','#add_btn',function () {
            index++;
            var html='';
            html+='<tr id="baris">';
            html+='<td><input type="text" class="form-control kolom" name="kode_rekomendasi['+index+']"></td>';
            html+='<td><input type="text" class="form-control kolom" name="rekomendasi['+index+']"></td>';
            html+='<td><input type="text" class="form-control kolom" name="keterangan['+index+']"></td>';
            html+='<td><input type="text" class="form-control kolom" name="pengembalian['+index+']"></td>';
            html+='<td><button type="button" class="btn btn-primary" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
            html+='</tr>';
            $('.body').append(html);
        })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })

        $('#add_card').on('click',function () {
            $("#card").append("<div class='card-header'>Tambah Jenis Temuan {{ $no++; }} </div> <div class='card-body'><table class='table'><thead><tr>                <th scope='col'>KODE TEMUAN</th><th scope='col'>NAMA TEMUAN</th></tr></thead> <tbody><tr><td><input type='text' name='nama'  class='form-control'></td><td><input type='text' name='nama'  class='form-control' ></td></tr></tbody></table> <table class='table'><thead><tr><th scope='col'>KODE REKOMENDASI</th><th scope='col'>NAMA REKOMENDASI</th><th scope='col'>KETERANGAN REKOMENDASI</th><th scope='col'>PENGEMBALIAN KEUANGAN</th><th>Aksi</th></tr></thead>  <tbody class='body'>     <tr><td><textarea name='' id='' class='form-control'></textarea></td><td><textarea name='' id='' class='form-control'></textarea></td><td><textarea name='' id='' class='form-control'></textarea></td>            <td><textarea name='' id='' class='form-control'></textarea></td><td><button type='button' class='btn btn-primary' id='add_btn'><i class='fa-solid fa-plus'></i></button></td></tr></tbody></table></div>");
        })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })

    });




</script>


















@endsection
