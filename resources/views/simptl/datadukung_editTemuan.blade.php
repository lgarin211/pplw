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


<div class="card-header" style="background-color: white">Tambah Jenis Temuan & Rekomendasi</div>
<form action="{{ url('simptl/jenisTemuan/'.$surat->id) }}" method="post" enctype="multipart/form-data">
    @method('POST')
    @csrf
<div class="card">
    <div class="d-flex justify-content-end" style="background-color:bisque"><button type="button" class="btn btn-primary btn-sm" id="add_card"><i class="fa-solid fa-plus"></i></button></div>
    @php
        $no = 1;
    @endphp

{{-- data yang sudah ada --}}
@foreach ($jt as $item)
<div class="card-header">Tambah Jenis Temuan {{ $no++; }} </div>
<div class="card-body">
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
                   <input type="text" name="edittemuan[0][kode_temuan]" value="{{ $item->first()->kode_temuan }}"  class="form-control" >
               </td>
               <td>
                   <input type="text" name="edittemuan[0][nama_temuan]" value="{{ $item->first()->nama_temuan }}"  class="form-control" >
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
            <th>Upload File</th>
          </tr>
        </thead>
        <tbody class="body">
            @foreach ($item as $jet)
            <tr>
                <td><input type="text" class="form-control" name="edittemuan[0][rekomendasi][0][kode_rekomendasi]" value="{{ $jet->kode_rekomendasi }}"></td>
                <td><input type="text" class="form-control" name="edittemuan[0][rekomendasi][0][rekomendasi]" value="{{ $jet->rekomendasi }}"></td>
                <td><input type="text" class="form-control" name="edittemuan[0][rekomendasi][0][keterangan]" value="{{ $jet->keterangan }}"></td>
                <td><input type="text" class="form-control tanparupiah " name="edittemuan[0][rekomendasi][0][pengembalian]" value="{{ $jet->pengembalian }}"></td>
                <td><input type="file" class="form-control "  readonly value="{{ $jet->files }}" name="files[{{ $jet->id }}]"     >
                    <a href="{{ url('viewBerkas/'.$jet->file) }}" target="_blank">View PDF</a></td>
            </tr>
            @foreach ($jet->sub as $w)
            <tr>
                <td><input type="text" class="form-control" name="edittemuan[0][rekomendasi][0][kode_rekomendasi]" value="{{ $w->kode_rekomendasi }}"></td>
                <td><input type="text" class="form-control" name="edittemuan[0][rekomendasi][0][rekomendasi]" value="{{ $w->rekomendasi }}"></td>
                <td><input type="text" class="form-control" name="edittemuan[0][rekomendasi][0][keterangan]" value="{{ $w->keterangan }}"></td>
                <td><input type="text" class="form-control tanparupiah " name="edittemuan[0][rekomendasi][0][pengembalian]" value="{{ $w->pengembalian }}"></td>
                <td><button type="button" data-indextemuan=0 class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus"></i></button></td>
                <td><button type="button" data-level1="0" data-indextemuan=0 class="btn btn-success" id="add_btn1"><i class="fa-solid fa-plus"></i></button></td>
                <td>                    <button type="button" class="btn btn-danger" id="hapus_btn1"><i class="fa-solid fa-minus"></i></button></td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
      </table>
    </div>

@endforeach

    <div class="card-header">Tambah Jenis Temuan {{ $no++; }} </div>
    <div class="card-body">
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
                       <input type="text" name="temuan[0][kode_temuan]"  class="form-control" >
                   </td>
                   <td>
                       <input type="text" name="temuan[0][nama_temuan]"  class="form-control" >
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
                <td><input type="text" class="form-control" name="temuan[0][rekomendasi][0][kode_rekomendasi]"></td>
                <td><input type="text" class="form-control" name="temuan[0][rekomendasi][0][rekomendasi]"></td>
                <td><input type="text" class="form-control" name="temuan[0][rekomendasi][0][keterangan]"></td>
                <td><input type="text" class="form-control tanparupiah " name="temuan[0][rekomendasi][0][pengembalian]"></td>
                <td><button type="button" data-indextemuan=0 class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus"></i></button></td>
                <td><button type="button" data-level1="0" data-indextemuan=0 class="btn btn-success" id="add_btn1"><i class="fa-solid fa-plus"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="tambahtemuan" class="mt-2"></div>
        <button class="btn btn-primary">Tambah PKPT</button>
        <button class="btn btn-success">Batal</button>
    </form>





  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="{{ asset('skydash/js/jquery.mask.min.js') }}"></script>
  <script src="{{ asset('skydash/js/jquery.min.js') }}"></script>
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
        let indexrekomendasi = 0;
        let indextemuan = 0;
        let indexsub = 0;
        let countertemuan = 1;
        let tanparupiah = document.querySelector('.tanparupiah');

        $(document).on('keyup','.tanparupiah',function (e) {
            let rupiah = formatRupiah($(this).val());
            console.log(rupiah);
            $(this).val(rupiah);
        })

        function formatRupiah(angka, prefix) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}


        $(document).on('click','#add_btn',function () {
            indextemuan=$(this).data('indextemuan');
            indexrekomendasi++;
            var html='';
            html+='<tr class="parent">';
            html+='<td><input type="text" class="form-control" name="temuan['+indextemuan+'][rekomendasi]['+indexrekomendasi+'][kode_rekomendasi]"></td>';
            html+='<td><input type="text" class="form-control" name="temuan['+indextemuan+'][rekomendasi]['+indexrekomendasi+'][rekomendasi]"></td>';
            html+='<td><input type="text" class="form-control" name="temuan['+indextemuan+'][rekomendasi]['+indexrekomendasi+'][keterangan]"></td>';
            html+='<td><input type="text" class="form-control tanparupiah" name="temuan['+indextemuan+'][rekomendasi]['+indexrekomendasi+'][pengembalian]" ></td>';
            html+='<td><button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
            html+='<td><button type="button" data-level1="'+indexrekomendasi+'" data-indextemuan="'+indextemuan+'" class="btn btn-success" id="add_btn1"><i class="fa-solid fa-plus"></i></button></td>';
            html+='</tr>';
            $(this).closest('tr').after(html);
        })




        $(document).on('click','#add_btn1',function (){
            var html='';
            var level1=$(this).data('level1');
            indextemuan = $(this).data('indextemuan');
            indexsub++;
            html+='<tr id="baris1" class="sub">';
            html+='<td><input type="text" class="form-control kolom1" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+indexsub+'][kode_rekomendasi]"></td>';
            html+='<td><input type="text" class="form-control kolom1" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+indexsub+'][rekomendasi]"></td>';
            html+='<td><input type="text" class="form-control kolom1" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+indexsub+'][keterangan]"></td>';
            html+='<td><input type="text" class="form-control kolom1 tanparupiah" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+indexsub+'][pengembalian]" ></td>';
            html+='<td><button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
            html+='<td><button data-level2="'+indexsub+'" data-level1="'+level1+'" type="button" class="btn btn-success" id="add_btn2" data-indextemuan="'+indextemuan+'" ><i class="fa-solid fa-plus"></i></button></td>';
            html+='</tr>';
            $(this).closest('tr').after(html);
        })

        $(document).on('click','#add_btn2',function () {
            indexsub++;
            indextemuan = $(this).data('indextemuan');
            var html='';
            var level1=$(this).data('level1');
            var level2=$(this).data('level2');
            html+='<tr id="baris">';
            html+='<td><input type="text" class="form-control kolom" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+level2+'][sub]['+indexsub+'][kode_rekomendasi]"></td>';
            html+='<td><input type="text" class="form-control kolom" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+level2+'][sub]['+indexsub+'][rekomendasi]"></td>';
            html+='<td><input type="text" class="form-control kolom" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+level2+'][sub]['+indexsub+'][keterangan]"></td>';
            html+='<td><input type="text" class="form-control kolom tanparupiah" name="temuan['+indextemuan+'][rekomendasi]['+level1+'][sub]['+level2+'][sub]['+indexsub+'][pengembalian]" ></td>';
            html+='<td><button type="button" class="btn btn-primary" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
            html+='</tr>';
            $(this).closest('tr').after(html);
        })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })

        $(document).on('click','#hapus_btn1',function () {
            $(this).closest('tr').remove();
        })

        $(document).on('click','#hapus_btn',function () {
            $(this).closest('tr').remove();
        })

        // $(document).on('click','#add_btn',function () {
        //     index++;
        //     var html='';
        //     html+='<tr id="baris">';
        //     html+='<td><input type="text" class="form-control kolom" name="kode_rekomendasi['+index+']"></td>';
        //     html+='<td><input type="text" class="form-control kolom" name="rekomendasi['+index+']"></td>';
        //     html+='<td><input type="text" class="form-control kolom" name="keterangan['+index+']"></td>';
        //     html+='<td><input type="text" class="form-control kolom" name="pengembalian['+index+']"></td>';
        //     html+='<td><button type="button" class="btn btn-primary" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
        //     html+='</tr>';
        //     $('.body').append(html);
        // })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })

        $('#add_card').on('click',function () {
            countertemuan++;
            indexrekomendasi++;
            $("#tambahtemuan").append("<div class='card-header'>Tambah Jenis Temuan "+countertemuan+"  </div> <div class='card-body'><table class='table'><thead><tr><th scope='col'>KODE TEMUAN</th><th scope='col'>NAMA TEMUAN</th></tr></thead> <tbody><tr><td><input type='text' name='temuan["+countertemuan+"][kode_temuan]'  class='form-control'></td><td><input type='text' name='temuan["+countertemuan+"][nama_temuan]'  class='form-control' ></td></tr></tbody></table> <table class='table'><thead><tr><th scope='col'>KODE REKOMENDASI</th><th scope='col'>NAMA REKOMENDASI</th><th scope='col'>KETERANGAN REKOMENDASI</th><th scope='col'>PENGEMBALIAN KEUANGAN</th><th>Aksi</th></tr></thead>  <tbody class='body'><tr><td><input name='temuan["+countertemuan+"][rekomendasi]["+indexrekomendasi+"][kode_rekomendasi]' id='' class='form-control'></td><td><input name='temuan["+countertemuan+"][rekomendasi]["+indexrekomendasi+"][rekomendasi]' id='' class='form-control'></td><td><input name='temuan["+countertemuan+"][rekomendasi]["+indexrekomendasi+"][keterangan]' id='' class='form-control'></td><td><input name='temuan["+countertemuan+"][rekomendasi]["+indexrekomendasi+"][pengembalian]' id='' class='form-control tanparupiah'></td><td><button type='button' class='btn btn-primary' id='add_btn' data-indextemuan="+countertemuan+"><i class='fa-solid fa-plus'></i></button></td><td><button type='button' data-level1="+indexrekomendasi+" data-indextemuan="+countertemuan+" class='btn btn-primary' id='add_btn1'><i class='fa-solid fa-plus'></i></button></td></tr></tbody></table></div>");
        })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })





    });




</script>


















@endsection
