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
         <form action="{{ url('UploadDatadukung/'.$surat->id) }}" method="post" enctype="multipart/form-data">
           @method('POST')
           @csrf
           <table class="table">
            <thead>
              <tr>
                <th scope="col">NAMA REKOMENDASI</th>
                <th scope="col">KETERANGAN REKOMENDASI</th>
                <th scope="col">PENGEMBALIAN KEUANGAN</th>
              </tr>
            </thead>
            <tbody class="body">
                @foreach ($jt as $item)
                <tr>
                <td><input type="text" class="form-control" name="rekomendasi[]" value="{{ $item->rekomendasi }}" readonly></td>
                <td><input type="text" class="form-control" name="keterangan[]" value="{{ $item->keterangan }}" readonly></td>
                <td><input type="text" class="form-control" name="pengembalian[]" value="{{ $item->pengembalian }}" readonly></td>
              </tr>
                @foreach ($item->sub as $v)
                <tr id="baris1">
                    <td><input type="text" class="form-control kolom1" value="{{ $v->rekomendasi }}" readonly name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][rekomendasi]"      ></td>
                    <td><input type="text" class="form-control kolom1" value="{{ $v->keterangan }}" readonly name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][keterangan]"       ></td>
                    <td><input type="text" class="form-control kolom1" value="{{ $v->pengembalian }}" readonly name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][pengembalian]"     ></td>
                </tr>
                @foreach ($v->sub as $r)
                <tr id="baris1">
                    <input type="hidden" name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][id]" value="{{ $r->id }}">
                    <td><input type="text" class="form-control kolom" value="{{ $r->rekomendasi }}" readonly name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][rekomendasi]"      ></td>
                    <td><input type="text" class="form-control kolom" value="{{ $r->keterangan }}" readonly name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][keterangan]"       ></td>
                    <td><input type="text" class="form-control kolom" value="{{ $r->pengembalian }}" readonly name="ubahTipeA[{{ $item->id }}][sub][{{ $v->id }}][sub][{{ $r->id }}][pengembalian]"     ></td>
                </tr>
                @endforeach
                @endforeach
                @endforeach
            </tbody>
          </table>
     </form>
    </div>
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
        $('#add_btn').on('click',function () {
            var html='';
            html+='<tr>';
            html+='<td><input type="text" class="form-control" name="kode_rekomendasi[]"></td>';
            html+='<td><input type="text" class="form-control" name="rekomendasi[]"></td>';
            html+='<td><input type="text" class="form-control" name="keterangan[]"></td>';
            html+='<td><input type="text" class="form-control" name="pengembalian[]"></td>';
            html+='<td><button type="button" class="btn btn-primary" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
            html+='</tr>';
            $('.body').append(html);
        })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })
    });


</script>
@endsection
