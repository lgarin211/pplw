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
    <div class="card-header" style="background-color: white">Data Penugasan</div>
    <div class="card-body" style="background-color: white">
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
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->jenis->nama }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Jenis Pengawasan </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->obrik->nama }}">
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Tanggal surat </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->Tanggalsurat }}" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Tanggal Akhir </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->surat->TanggalAkhir }}" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Status LHP </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $surat->status_LHP }}" >
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card" id="card">
<div class="card-header">Tambah Rekomendasi</div>
<div class="card">
    <div class="card-body">
         <form action="{{ url('simptl/datadukung_editRekom/'.$surat->id) }}" method="post" enctype="multipart/form-data">
           @method('POST')
           @csrf
           <table class="table">
            <thead>
              <tr>
                <th scope="col">NAMA REKOMENDASI</th>
                <th scope="col">KETERANGAN REKOMENDASI</th>
                <th scope="col">PENGEMBALIAN KEUANGAN</th>
                <th scope="col">Upload File</th>
              </tr>
            </thead>
            <tbody class="body">
                @foreach ($jt as $item)
                <tr>
                    <input type="hidden" name="ubahTipeA[{{ $item->id }}][id]" value="{{ $item->id }}">
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $item->rekomendasi }}" name="ubahTipeA[{{ $item->id }}][rekomendasi]"      ></td>
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $item->keterangan }}" name="ubahTipeA[{{ $item->id }}][keterangan]"       ></td>
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $item->pengembalian }}" name="ubahTipeA[{{ $item->id }}][pengembalian]"     ></td>
                    <td><input type="file" class="form-control kolom1"  readonly value="{{ $item->files }}" name="files[{{ $item->id }}]"     >
                    <a href="{{ url('viewBerkas/'.$item->file) }}" target="_blank">View PDF</a></td>
                </tr>
                @foreach ($item->sub as $v)
                <tr id="baris1">
                    <input type="hidden" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][id]" value="{{ $v->id }}">
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $v->rekomendasi }}" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][rekomendasi]"      ></td>
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $v->keterangan }}" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][keterangan]"       ></td>
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $v->pengembalian }}" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][pengembalian]"     ></td>
                </tr>
                @foreach ($v->sub as $r)
                <tr id="baris1">
                    <input type="hidden" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][id]" value="{{ $r->id }}">
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $r->rekomendasi }}" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][rekomendasi]"      ></td>
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $r->keterangan }}" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][keterangan]"       ></td>
                    <td><input type="text" class="form-control kolom1" readonly value="{{ $r->pengembalian }}" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][pengembalian]"     ></td>
                </tr>
                @endforeach
                @endforeach
                @endforeach
            </tbody>
          </table>
          <button class="btn btn-primary">Tambah Rekom</button>
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
            });
        </script>

<script type="text/javascript">
    $(document).ready(function () {
        let index = 0;
        let index1 = 0;
        let index2 = 0;
        let indexEdit = 0;
        let indexEdit1 = 0;
//         let tanpa_rupiah = document.getElementById('tanpa-rupiah');

//         tanpa_rupiah.addEventListener('keyup', function (e) {
//     tanpa_rupiah.value = formatRupiah(this.value);
// });
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



        // $('#add_btnEdit1').on('click',function () {
        //     indexEdit1++;
        //     var html='';
        //     var level1=$(this).data('level1');
        //     var level2=$(this).data('level2');
        //     var parentId = $(this).data('parentid');
        //     html+='<tr>';
        //     html+='<input type="hidden" name="ubahTipeA['+level1+'][sub]['+level2+'][sub]['+indexEdit1+'][parentid]" value="'+parentId+'">';
        //     html+='<td><input type="text" class="form-control"  name="ubahTipeA['+level1+'][sub]['+level2+'][sub]['+indexEdit1+'][rekomendasi]"></td>';
        //     html+='<td><input type="text" class="form-control" name="ubahTipeA['+level1+'][sub]['+level2+'][sub]['+indexEdit1+'][keterangan]"></td>';
        //     html+='<td><input type="text" class="form-control tanparupiah"  name="ubahTipeA['+level1+'][sub]['+level2+'][sub]['+indexEdit1+'][pengembalian]"></td>';
        //     html+='<td><button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
        //    //sesuaikan idnya button
        //     html+='<td><button data-level1="'+index+'"  type="button" class="btn btn-success" id="add_btn1"><i class="fa-solid fa-plus"></i></button></td>';
        //     html+='</tr>';
        //     $(this).closest('tr').after(html);

        // })


        // $('#add_btnEdit').on('click',function () {
        //     var html='';
        //     indexEdit++;
        //     var level1=$(this).data('level1');
        //     var parentId = $(this).data('parentid');
        //     html+='<tr id="baris1">';
        //     html+='<input type="hidden" name="ubahTipeA['+level1+'][sub]['+indexEdit+'][parentid]" value="'+parentId+'">';
        //     html+='<td><input type="text" class="form-control kolom1" name="ubahTipeA['+level1+'][sub]['+indexEdit+'][rekomendasi]"></td>';
        //     html+='<td><input type="text" class="form-control kolom1" name="ubahTipeA['+level1+'][sub]['+indexEdit+'][keterangan]"></td>';
        //     html+='<td><input type="text" class="form-control kolom1 tanparupiah" name="ubahTipeA['+level1+'][sub]['+indexEdit+'][pengembalian]"></td>';
        //     html+='<td><button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
        //     //sesuaikan idnya button
        //     html+='<td><button data-level2="'+index1+'" data-level1="'+level1+'" type="button" class="btn btn-success" id="add_btn2"><i class="fa-solid fa-plus"></i></button></td>';
        //     html+='</tr>';
        //     $(this).closest('tr').after(html);
        // })

        // $('#add_btn1').on('click',function () {
        //     var html='';
        //     index1++;
        //     var level1=$(this).data('level1');
        //     html+='<tr id="baris1">';
        //     html+='<td><input type="text" class="form-control kolom1" name="tipeA['+level1+'][sub]['+index1+'][rekomendasi]"></td>';
        //     html+='<td><input type="text" class="form-control kolom1" name="tipeA['+level1+'][sub]['+index1+'][keterangan]"></td>';
        //     html+='<td><input type="text" class="form-control kolom1 tanparupiah" name="tipeA['+level1+'][sub]['+index1+'][pengembalian]"></td>';
        //     html+='<td><button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
        //     html+='<td><button data-level2="'+index1+'" data-level1="'+level1+'" type="button" class="btn btn-success" id="add_btn2"><i class="fa-solid fa-plus"></i></button></td>';
        //     html+='</tr>';
        //     $(this).closest('tr').after(html);
        // })

        // $('#add_btn').on('click',function () {
        //     index++;
        //     var html='';
        //     html+='<tr>';
        //     html+='<td><input type="text" class="form-control" name="tipeA['+index+'][rekomendasi]"></td>';
        //     html+='<td><input type="text" class="form-control" name="tipeA['+index+'][keterangan]"></td>';
        //     html+='<td><input type="text" class="form-control tanparupiah" name="tipeA['+index+'][pengembalian]"></td>';
        //     html+='<td><button type="button" class="btn btn-danger" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
        //     html+='<td><button data-level1="'+index1+'"  type="button" class="btn btn-success" id="add_btn1"><i class="fa-solid fa-plus"></i></button></td>';
        //     html+='</tr>';
        //     $(this).closest('tr').after(html);

        // })




        // $(document).on('click','#remove',function () {
        //     $(this).closest('tr').remove();
        // })

        // $(document).on('click','#add_btn2',function () {
        //     index2++;
        //     var html='';
        //     var level1=$(this).data('level1');
        //     var level2=$(this).data('level2');
        //     html+='<tr id="baris">';
        //     html+='<td><input type="text" class="form-control kolom" name="tipeA['+level1+'][sub]['+level2+'][sub]['+index2+'][rekomendasi]"></td>';
        //     html+='<td><input type="text" class="form-control kolom" name="tipeA['+level1+'][sub]['+level2+'][sub]['+index2+'][keterangan]"></td>';
        //     html+='<td><input type="text" class="form-control kolom tanparupiah" name="tipeA['+level1+'][sub]['+level2+'][sub]['+index2+'][pengembalian]"></td>';
        //     html+='<td><button type="button" class="btn btn-primary" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
        //     html+='</tr>';
        //     $(this).closest('tr').after(html);
        // })

    });





</script>
@endsection
