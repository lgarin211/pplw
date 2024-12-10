@extends('simptl.template')
@section('content')

<div class="alert alert-info" role="alert">
    Pengawasan
  </div>

<div class="card mb-4">
    <div class="card-header">Data Penugasan</div>
    <div class="card-body">
        <form action="{{ url('/jabatan_baru'.$penugasan->id) }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Nomor Surat </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ "094/".$penugasan->noSurat."/03/2023" }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Jenis Pengawasan </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $penugasan->jenis->nama }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Obrik Pengawasan </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $penugasan->obrik->nama }}">
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Tanggal Awal </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $penugasan->Tanggalsurat }}" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Tanggal Akhir </label>
                    <input type="text" name="nama" readonly class="form-control" value="{{ $penugasan->TanggalAkhir }}" >
                </div>
                <div class="col-4 mb-3">
                    <label for="">Status LHP </label>
                    <input type="text" name="nama" readonly class="form-control" value="Belum Jadi">
                </div>
            </div>
        </form>
    </div>
</div>





<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('simptl/pkpt_baru/'.$penugasan->id) }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Tanggal Surat Keluar </label>
                    <input type="date" name="nama" class="form-control" value="{{ date('Y-m-d') }}" >
                </div>
                 <div class="col-4 mb-3">
                    <label for="">Tipe Rekomendasi </label>
                    <select name="tipe" id="" class="form-control" style="color: black">
                        <option value="Rekomendasi">Rekomendasi</option>
                        <option value="TemuandanRekomendasi">Temuan dan Rekomendasi</option>
                    </select>
                </div>
                <div class="col-4 mb-3">
                    <label for="">Jenis Pemeriksaan </label>
                     <select name="jenis" id="" class="form-control" style="color: black">
                        <option value="pdtt">PDTT</option>
                        <option value="nspk">NSPK</option>
                     </select>
                </div>
            </div>
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">Wilayah </label>
                     <select name="wilayah" id="" class="form-control" style="color: black">
                        <option value="wilayah1">Wilayah 1</option>
                        <option value="wilayah2">Wilayah 2</option>
                     </select>
                </div>
                <div class="col-6 mb-3">
                    <label for="">Pemeriksa </label>
                     <select name="pemeriksa" id="" class="form-control" style="color: black">
                        <option value="auditor">Auditor</option>
                        <option value="ppupd">PPUPD</option>
                     </select>
                </div>
            </div>
            <button class="btn btn-primary">Tambah PKPT</button>
            <button class="btn btn-success">Batal</button>

    </div>
</div>

{{-- <div class="card mb-4">
    <div class="card-header">Data User</div>
    <div class="card-body">
        <div class="row">
            <div class="col-6 mb-3">
                <label for="">username </label>
                <input type="text" name="username"  class="form-control">
            </div>
            <div class="col-6 mb-3">
                <label for="">Password </label>
                <input type="text" name="password"  class="form-control">
            </div>
        </div>

        </form>
    </div>
</div> --}}
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
