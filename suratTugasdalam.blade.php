@extends('admin.template')
@section('content')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <h5>Daftar Surat Tugas dan SPPD </h5>

        <div class="d-flex justify-content-end "><a href="{{ url('perjalananDalam_create') }}" class="btn btn-success">Tambah Penugasan</a>
        </div>

      <table class="table table-sm" style="width: 100%">
        <thead>
          <tr>
            <th width="2%">No</th>
            <th width="5%">No Surat</th>
            <th width="5%">Tanggal</th>
            <th width="5%">Petugas</th>
            <th width="5%">Jenis Pengawasan</th>
            <th width="5%">Obrik</th>
            <th width="5%">Unduh ST dan SPPD</th>
            <th width="40%">Aksi</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($penugasan as $index => $v)
          <tr>
              <td width="2%">{{ $index + $penugasan->firstItem() }}</td>
              <td width="5%">{{ "094/".$v->noSurat."/03"."/".date("Y") }}</td>
              <td width="5%"> {{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d F Y') }} s/d {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d F Y') }} </td>
              <td width="5%">
                <ol style="margin-left: -15px">
                  @foreach ($v->surat as $item)
                  <li>
                      {{ $item->pegawai->nama_karyawan }}
                  </li>
                   @endforeach
                </ol>
              </td>
              <td width="5%"><?php echo isset($v->jenis->nama)?$v->jenis->nama:' ' ?></td>
              <td width="5%"><?php echo isset($v->obrik->nama)?$v->obrik->nama:' ' ?></td>
              <td width="5%">
                <a href="{{ url('perjalananDalam/suratTugas/'.$v->id) }}"  target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                <a href="{{ url('perjalananDalam/suratDinas/'.$v->id) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                <a href="{{ url('perjalananDalam/sppd/'.$v->id) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
              </td>
              <td width="40%">
                <a href="{{ url('perjalananDalam/'.$v->id.'/edit') }}" class="btn btn-outline-primary btn-sm">Edit</a>
                <form action="{{ url('perjalananDalam/'.$v->id.'/hapus') }}" method="POST" class="d-inline mb-3">
                  @method('delete')
                  @csrf
                  <button class="btn btn-danger btn-sm ">Hapus</button>
                </form>
              </td>

                @endforeach
          </tr>

        </tbody>
      </table>
      <div class="d-flex mt-3 justify-content-end">{{ $penugasan->links() }}</div>


       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 <script>
            $(document).ready(function () {
                $("#obrik").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Obrik"
                });
                $("#jenis_pengawasan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Jenis Pengawasan"
                });
                $("#bulan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
                $("#tahun23").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
                   $("#tahun").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Anggaran Kegiatan"
                });
            });
        </script>
@endsection
