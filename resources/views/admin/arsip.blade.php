@extends('admin.template')
@section('content')
<style>
#mytable {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#mytable td, #mytable th {
  border: 1px solid #ddd;
  padding: 8px;
}

#mytable tr:nth-child(even){background-color: #f2f2f2;}

#mytable tr:hover {background-color: #ddd;}

#mytable th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
    <h5>Daftar Surat Tugas dan SPPD
        <form action="{{ url('arsip/cari') }}" method="post">
            @csrf
            @method('post')
            <div class="row">
                <div class="col-4 mt-3">
                    <label for="">Obrik</label>
                    <input type="text" class="form-control" name="obrik" value="{{ $filterid_obrik }}">
                </div>
                <div class="col-4 mt-3">
                    <label for="">Jenis Pengawasan</label>
                    <input type="text" name="jenisPengawasan" class="form-control" value="{{ $filterid_jenis_pengawasan }}">
                </div>
                {{-- <div class="col-4 mt-3">
                    <label for="">Irban</label>
                    <select id="id_irban" class="form-control mt-2 filter" name="id_irban">
                        <option value="">Pilih</option>
                        @foreach ($ir as $key => $p)
                            <option value="{{ $p->id }}" @if ($filterid_irban == $p->id) selected @endif>
                                {{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div> --}}
                <div class="col-4 mt-3">
                    <label for="">Bulan</label>
                    <select name="bulan" id="bulan" class="form-control mt-2 filter">
                        <option value="">Pilih Bulan</option>
                        <option value="01" @if ($filterbulan == '01') selected @endif>Januari</option>
                        <option value="02" @if ($filterbulan == '02') selected @endif>Februari</option>
                        <option value="03" @if ($filterbulan == '03') selected @endif>Maret</option>
                        <option value="04" @if ($filterbulan == '04') selected @endif>April</option>
                        <option value="05" @if ($filterbulan == '05') selected @endif>Mei</option>
                        <option value="06" @if ($filterbulan == '06') selected @endif>Juni</option>
                        <option value="07" @if ($filterbulan == '07') selected @endif>Juli</option>
                        <option value="08" @if ($filterbulan == '08') selected @endif>Agustus</option>
                        <option value="09" @if ($filterbulan == '09') selected @endif>September</option>
                        <option value="10" @if ($filterbulan == '10') selected @endif>Oktober</option>
                        <option value="11" @if ($filterbulan == '11') selected @endif>November</option>
                        <option value="12" @if ($filterbulan == '12') selected @endif>Desember</option>
                    </select>
                </div>
            </div>
            <button class="btn btn-info mt-3" type="submit">SUBMIT</button>
        </form>

    </h5>

        <table id="mytable"  style="width: 100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Surat</th>
                    <th>Tanggal</th>
                    <th>Pegawai</th>
                    <th>Jenis Pengawasan</th>
                    <th>Obrik</th>
                    <th>Unduh ST dan SPPD</th>
                    <th>Unduh Bukti Penerimaan</th>
                    <th>Unduh A2</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0" id="tbody">
                @foreach ($penugasan as $k => $v)
                    <tr>
                        <td >{{ $k + 1 }}</td>
                        <td style="padding-top: -50px" >{{ '700.1.1/' . $v->noSurat . '/03' . '/' . date('Y') }} <br><br> {{Carbon\Carbon::parse($v->tanggalterbitSurat)->translatedFormat('d F Y')}}

                        </td>
                        <td class="kolom">{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d M Y') }} s/d {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d M Y') }}</td>
                        <td width="300px"><ol style="margin-left: -15px">
                            @foreach ($v->surat()->get()->sortBy('id_peran') as $item)
                            <li>
                                <?php echo isset($item->pegawai->nama_karyawan)?$item->pegawai->nama_karyawan:' ' ?>
                            </li>
                             @endforeach
                          </ol></td>
                        <td>{{ $v->jenis->nama }}</td>
                        <td>{{ $v->obrik->nama }}</td>
                        <td>
                            <a href="{{ url('perjalananDalam/suratTugas/' . $v->id) }}" target="_blank"><i
                                    class="far fa-file-pdf fa-2x ms-2"></i></a>
                            <a href="{{ url('perjalananDalam/suratDinas/' . $v->id) }}" target="_blank"><i
                                    class="far fa-file-pdf fa-2x ms-2"></i></a>
                            <a href="{{ url('perjalananDalam/sppd/' . $v->id) }}" target="_blank"><i
                                    class="far fa-file-pdf fa-2x ms-2"></i></a>
                        </td>
                        <td><a href="{{ url('berkas/bukti/' . $v->id) }}" target="_blank"><i class="far fa-file-pdf fa-2x"
                                    style="margin-left: 20px"></i></a></td>
                                    <td>
                                        <a href="{{ url('berkas/A2/'.$v->id) }}" target="_blank"><i  class="far fa-file-pdf fa-2x" style="margin-left: 20px"></i></a>
                                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
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
            $("#id_irban").select2({
                theme: 'bootstrap4',
                placeholder: "Pilih Irban "
            });
        });
    </script>
@endsection
