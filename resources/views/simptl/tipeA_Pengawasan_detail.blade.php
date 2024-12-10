@extends('simptl.template')
@section('content')

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
                        <input type="text" name="nama" readonly class="form-control" >
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card" id="card">
        <div class="card-header">DATA SIMPTL</div>
        <div class="card">
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
                    @foreach ($jt as $index => $v)
                  <tr>
                    <td><input type="text" class="form-control" value="{{ $jt->nama_rekomendasi }}" readonly></td>
                    <td><input type="text" class="form-control" value="{{ $jt->keterangan }}" readonly></td>
                    <td><input type="text" class="form-control" value="{{ $jt->pengembalian }}" readonly></td>
                    <td><button type="button" class="btn btn-primary" id="add_btn"><i class="fa-solid fa-plus"></i></button></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
        </div>



    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $(document).ready(function() {
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
