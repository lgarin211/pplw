@extends('admin.template')
@section('content')

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <h5>Daftar Surat Tugas dan SPPD </h5>

        <div class="d-flex justify-content-end "><a href="{{ url('perjalananDalam_create') }}" class="btn btn-success">Tambah Penugasan</a>
        </div>

        <style type="text/css">
            .pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}
            .pagination>li{display:inline}
            .pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:green;text-decoration:none;background-color:#fff;border:1px solid #ddd}
            .pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}
         .pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}
         .pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{z-index:2;color:#23527c;background-color:#eee;border-color:#ddd}
         .pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,.pagination>.active>span,.pagination>.active>span:focus,.pagination>.active>span:hover{z-index:3;color:#fff;cursor:default;background-color:#33b35a;border-color:#33b35a}
         .pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,.pagination>.disabled>span:focus,.pagination>.disabled>span:hover{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}
        </style>

        <div class="table-resposive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Surat</th>
                        <th>Tanggal</th>
                        <th width="250px!important">Petugas</th>
                        <th>Jenis Pengawasan</th>
                        <th>JUmlah Karakter</th>
                        <th>Obrik</th>
                        <th>Aksi</th>
                        <th>Unduh ST dan SPPD</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($penugasan as $index => $v)
                    <tr>
                        <td>{{ $index + $penugasan->firstItem() }}</td>
                        <td>{{ "094/".$v->noSurat."/03"."/".date("Y") }}</td>
                        <td>{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d M Y') }} s/d {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d M Y') }}</td>
                        <td><ol style="margin-left: -15px">
                            @foreach ($v->surat()->get()->sortBy('id_peran') as $item)
                            <li>
                                <?php echo isset($item->pegawai->nama_karyawan)?$item->pegawai->nama_karyawan:' ' ?>
                            </li>
                             @endforeach
                          </ol></td>

                        <td>
                            @if (strlen($v->jenis->nama) < 200)
                               {{ $v->JenisPengawasanPanjang}}
                            @else
                            <?php echo isset($v->jenis->nama)?$v->jenis->nama:' ' ?>
                            @endif
                        </td>
                        <td>
                            <?php
                            $jumlah_karakter    =strlen($v->jenis->nama);
                            echo "Jumlah karakter = $jumlah_karakter karakter";
                        ?>
                        </td>
                        <td><?php echo isset($v->obrik->nama)?$v->obrik->nama:' ' ?></td>
                                        <td scope="row">
                            <div class="toolbox">
                                <a href="{{ url('perjalananDalam/'.$v->id.'/edit') }}" class='edit'><i class='fa fa-pencil-square-o'></i></a>
                                <form action="{{ url('perjalananDalam/'.$v->id.'/hapus') }}" method="POST" class="d-inline mb-3">
                                    @method('delete')
                                    @csrf
                                    <a href='' id='1437' class='remove'><i class='fa fa-close'></i></a>
                                </form>
                            </div>
                        </td>
                        <td scope="row">
                            <a href="{{ url('perjalananDalam/suratTugas/'.$v->id) }}"  target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                            <a href="{{ url('perjalananDalam/suratDinas/'.$v->id) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                            <a href="{{ url('perjalananDalam/sppd/'.$v->id) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
        </div>
        <div class="d-flex mt-3 justify-content-end">{{ $penugasan->links() }}</div>

        {{-- <div class="table-responsive">
            <table class="table" style="max-width: 100%;">
                <thead>
                  <tr>
                    <th width="5%">No</th>
                    <th width="10%" style="margin-left: 10%">No Surat</th>
                    <th width="10%">Tanggal</th>
                    <th width="10%">Petugas</th>
                    <th width="20%">Jenis Pengawasan</th>
                    <th width="20%">Obrik</th>
                    <th width="10%">Unduh ST dan SPPD</th>
                    <th width="10%">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($penugasan as $index => $v)
                  <tr>
                    <th>{{ $index + $penugasan->firstItem() }}</th>
                    <td>{{ "094/".$v->noSurat."/03"."/".date("Y") }}</td>
                    <td>{{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d M Y') }} s/d {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d M Y') }}</td>
                    <td> <ol style="margin-left: -15px">
                        @foreach ($v->surat()->get()->sortBy('id_peran') as $item)
                        <li>
                            <?php echo isset($item->pegawai->nama_karyawan)?$item->pegawai->nama_karyawan:' ' ?>
                        </li>
                         @endforeach
                      </ol>
                    </td>

                    <th><?php echo isset($v->jenis->nama)?$v->jenis->nama:' ' ?></th>
                    <td><?php echo isset($v->obrik->nama)?$v->obrik->nama:' ' ?></td>
                    <td>
                        <a href="{{ url('perjalananDalam/suratTugas/'.$v->id) }}"  target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                        <a href="{{ url('perjalananDalam/suratDinas/'.$v->id) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                        <a href="{{ url('perjalananDalam/sppd/'.$v->id) }}" target="_blank"><i class="far fa-file-pdf fa-2x ms-2"></i></a>
                    </td>
                    <td>
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
        </div>
      <div class="d-flex mt-3 justify-content-end">{{ $penugasan->links() }}</div> --}}


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
