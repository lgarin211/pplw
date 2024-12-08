@extends('admin.template')
@section('content')

<h4>Laporan Surat Tugas Berdasarkan Pegawai</h4>
  <div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/rekap_suratpegawaiPDF') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Nama Pegawai </label>
                    <select name="id_karyawan" id="pegawai" class="form-control" required>
                        <option value="">-- Pilih Nama Pegawai --</option>
                          @foreach ($pegawai as $key => $p)
                           <option value="{{ $p->id }}">{{ $p->gelar_depan }}{{ $p->nama_karyawan }}{{ ",".$p->gelar }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="col-4 mb-3">
                    <label for="">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control" required>
                        <option value="">-- Pilih Bulan --</option>
                    <option value="01" @if ($filterbulan == "01") selected  @endif>Januari</option>
                    <option value="02" @if ($filterbulan == "02") selected  @endif>Februari</option>
                    <option value="03" @if ($filterbulan == "03") selected  @endif>Maret</option>
                    <option value="04" @if ($filterbulan == "04") selected  @endif>April</option>
                    <option value="05" @if ($filterbulan == "05") selected  @endif>Mei</option>
                    <option value="06" @if ($filterbulan == "06") selected  @endif>Juni</option>
                    <option value="07" @if ($filterbulan == "07") selected  @endif>Juli</option>
                    <option value="08" @if ($filterbulan == "08") selected  @endif>Agustus</option>
                    <option value="09" @if ($filterbulan == "09") selected  @endif>September</option>
                    <option value="10" @if ($filterbulan == "10") selected  @endif>Oktober</option>
                    <option value="11" @if ($filterbulan == "11") selected  @endif>November</option>
                    <option value="12" @if ($filterbulan == "12") selected  @endif>Desember</option>
                    </select>
                </div>

                  <div class="col-4 mb-3">
                    <label for="">Peran Pegawai </label>
                    <select name="id_peran" id="peran" class="form-control" required>
                        <option value="">-- Pilih Peran Pegawai --</option>
                          @foreach ($peran as $key => $p)
                           <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>

                </div>
                </div>

            <button  type="submit" class="btn btn-primary">VIEW PDF</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script>
     $(document).ready(function () {
                $("#pegawai").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                  $("#bulan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
                 $("#peran").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih tahun"
                });
            });
</script>
@endsection
