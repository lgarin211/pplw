@extends('simptl.template')
@section('content')

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
                    <label for="">Obrik Pengawasan </label>
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

<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('pkpt_edit/'.$surat->id."/edit") }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Tanggal Surat Keluar </label>
                    <input type="date" name="nama" class="form-control" value="{{ $surat->nama }}" >
                </div>
                 <div class="col-4 mb-3">
                    <label for="">Tipe Rekomendasi </label>
                    <select name="tipe" id="" class="form-control" style="color: black">
                        <option value="Rekomendasi" {{ $surat->tipe == 'Rekomendasi' ? 'selected' : '' }}>TIPE A</option>
                        <option value="TemuandanRekomendasi" {{ $surat->tipe == 'TemuandanRekomendasi' ? 'selected' : '' }}>TIPE B</option>
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="">Jenis Pemeriksaan </label>
                     <select name="jenis" id="" class="form-control" style="color: black">
                        <option value="pdtt" {{ $surat->jenis == 'pdtt' ? 'selected' : '' }}>PDTT</option>
                        <option value="nspk" {{ $surat->jenis == 'nspk' ? 'selected' : '' }}>NSPK</option>
                     </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Wilayah </label>
                     <select name="wilayah" id="" class="form-control" style="color: black">
                        <option value="wilayah1" {{ $surat->wilayah == 'wilayah1' ? 'selected' : '' }}>Wilayah 1</option>
                        <option value="wilayah2" {{ $surat->wilayah == 'wilayah2' ? 'selected' : '' }}>Wilayah 2</option>
                     </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="">Pemeriksa </label>
                     <select name="pemeriksa" id="" class="form-control" style="color: black">
                        <option value="auditor" {{ $surat->pemeriksa == 'auditor' ? 'selected' : '' }}>Auditor</option>
                        <option value="ppupd" {{ $surat->pemeriksa == 'ppupd' ? 'selected' : '' }}>PPUPD</option>
                     </select>
                </div>
            </div>
            <button class="btn btn-primary">Tambah PKPT</button>
            <button class="btn btn-success">Batal</button>
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
                 $("#tahun").select2({
                    theme: 'bootstrap4'
                });
            });
        </script>

@endsection
