<style type="text/css">
    .page {
        width: 215.9mm;
        min-height: 355.6mm;
        padding: 10mm;
        margin: 10mm auto;
        border: 1px #D3D3D3 solid;
        background: white;
        page-break-after: always;
    }

    table,
    td,
    th {
        vertical-align: top !important;
        text-align: justify;
    }

    h1 {
        text-align: center;
    }

    @page {
        size: legal;
        margin: 20mm auto;

    }
</style>

<body onload="window.print()">
    @for ($bulan = 1; $bulan <= 12; $bulan++)
        <div class="page">
            @if ($bulan == 1)
                <h1> REKAPITULASI SURAT TUGAS BULAN JANUARI</h1>
            @endif
            @if ($bulan == 2)
                <h1> REKAPITULASI SURAT TUGAS BULAN FEBRUARI</h1>
            @endif
            @if ($bulan == 3)
                <h1> REKAPITULASI SURAT TUGAS BULAN Maret</h1>
            @endif
            @if ($bulan == 4)
                <h1> REKAPITULASI SURAT TUGAS BULAN April</h1>
            @endif
            @if ($bulan == 5)
                <h1> REKAPITULASI SURAT TUGAS BULAN Mei</h1>
            @endif
            @if ($bulan == 6)
                <h1> REKAPITULASI SURAT TUGAS BULAN Juni</h1>
            @endif
            @if ($bulan == 7)
                <h1> REKAPITULASI SURAT TUGAS BULAN Juli</h1>
            @endif
            @if ($bulan == 8)
                <h1> REKAPITULASI SURAT TUGAS BULAN Agustus</h1>
            @endif
            @if ($bulan == 9)
                <h1> REKAPITULASI SURAT TUGAS BULAN September</h1>
            @endif
            @if ($bulan == 10)
                <h1> REKAPITULASI SURAT TUGAS BULAN Oktober</h1>
            @endif
            @if ($bulan == 11)
                <h1> REKAPITULASI SURAT TUGAS BULAN November</h1>
            @endif
            @if ($bulan == 12)
                <h1> REKAPITULASI SURAT TUGAS BULAN Desember</h1>
            @endif
            <br><br>
            <table>
                @foreach ($penugasan[$bulan] as $k => $v)
                @if (date('m', strtotime($v->Tanggalsurat)) == date('m', strtotime($v->TanggalAkhir)) )
                <tr>
                    <td>{{ $k + 1 }}</td>
                    <td>
                        {{ $v->jenis->nama }} {{ $v->obrik->nama }}
                        @if (date('m', strtotime($v->Tanggalsurat)) == date('m', strtotime($v->TanggalAkhir)))
                            (<?php echo date('d', strtotime($v->Tanggalsurat)); ?> s/d
                            {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d F Y') }} )
                        @else
                            ( {{ Carbon\Carbon::parse($v->Tanggalsurat)->translatedFormat('d F') }} s/d
                            {{ Carbon\Carbon::parse($v->TanggalAkhir)->translatedFormat('d F') }})
                        @endif
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>TIM</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <table>
                            <tr>
                                <td>
                                    @foreach ($v->surat as $item)
                                        {{ $item->peran->nama }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($v->surat as $item)
                                        {{ $item->pegawai->nama_karyawan }} <br>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($v->surat as $item)

                                      {{ $item->PerhitunganHari }} Hari <br>
                                    @endforeach
                                </td>

                            </tr>
                        </table>
                    </td>
            @endforeach
            </tr>
        </table>

                @endif
        </div>
        <div class="page">
            @if ($bulan == 1)
                <h1> REKAPITULASI PERAN BULAN Januari</h1>
            @endif
            @if ($bulan == 2)
                <h1> REKAPITULASI PERAN BULAN Februari</h1>
            @endif
            @if ($bulan == 3)
                <h1> REKAPITULASI PERAN BULAN Maret</h1>
            @endif
            @if ($bulan == 4)
                <h1> REKAPITULASI PERAN BULAN April</h1>
            @endif
            @if ($bulan == 5)
                <h1> REKAPITULASI PERAN BULAN Mei</h1>
            @endif
            @if ($bulan == 6)
                <h1> REKAPITULASI PERAN BULAN Juni</h1>
            @endif
            @if ($bulan == 7)
                <h1> REKAPITULASI PERAN BULAN Juli</h1>
            @endif
            @if ($bulan == 8)
                <h1> REKAPITULASI PERAN BULAN Agustus</h1>
            @endif
            @if ($bulan == 9)
                <h1> REKAPITULASI PERAN BULAN September</h1>
            @endif
            @if ($bulan == 10)
                <h1> REKAPITULASI PERAN BULAN Oktober</h1>
            @endif
            @if ($bulan == 11)
                <h1> REKAPITULASI PERAN BULAN November</h1>
            @endif
            @if ($bulan == 12)
                <h1> REKAPITULASI PERAN BULAN Desember</h1>
            @endif

          <?php $no = 1; ?><?php $no1 = 1; ?> <?php $no2 = 1; ?><?php $no3 = 1; ?>
            <?php $number = 1; ?> <?php $number1 = 1; ?>
            @foreach ($peran as $pr)
                {{ $pr->nama }} <br> <br>
                @foreach ($surat1[$bulan][$pr->id]->groupBy('pegawai.nama_karyawan')) as $item)

                    <td>{{ $item->first()->pegawai->nama_karyawan }} : {{  $item->sum('perhitungan_hari') }} Hari <br><br> </td>
                @endforeach
            @endforeach
        </div>

        <div class="page">
            @if ($bulan == 1)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Januari</h1>
            @endif
            @if ($bulan == 2)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Februari</h1>
            @endif
            @if ($bulan == 3)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Maret</h1>
            @endif
            @if ($bulan == 4)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN April</h1>
            @endif
            @if ($bulan == 5)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Mei</h1>
            @endif
            @if ($bulan == 6)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Juni</h1>
            @endif
            @if ($bulan == 7)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Juli</h1>
            @endif
            @if ($bulan == 8)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Agustus</h1>
            @endif
            @if ($bulan == 9)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN September</h1>
            @endif
            @if ($bulan == 10)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Oktober</h1>
            @endif
            @if ($bulan == 11)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN November</h1>
            @endif
            @if ($bulan == 12)
                <h1> REKAPITULASI PERAN PERPEGAWAI BULAN Desember</h1>
            @endif

            <table border="1px" style="width: 100%;" class="me-5">
                <tr>
                    <th>No</th>
                    <th>Nama Pegawai</th>
                    @foreach ($peran as $p)
                        <th>{{ $p->nama }}</th>
                    @endforeach
                    <th>Jadwal Lain</th>
                    <th>Jumlah Hari</th>
                </tr>

                </thead>
                <tbody>
                    {{-- //menghitung perannya berapa hari bukan berapa kali --}}

                    @foreach ($surat2[$bulan] as $pg)
                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $pg->first()->pegawai->nama_karyawan }}</td>
                            @php
                                $totalperan = 0;
                            @endphp
                            @foreach ($peran as $p)
                                <td>{{ $jumlahperan = $pg->where('id_peran',$p->id)->sum('perhitungan_hari_tunggal') }}</td>
                            @php
                                $totalperan += $jumlahperan;
                            @endphp
                            @endforeach
                            <td>{{ $peran2 = App\Models\JadwalLain::where('id_pegawai',$pg->first()->id_karyawan)->whereMonth('tanggalawal',$bulan)->whereYear('tanggalawal',session('tahun'))->get()->sum('perhitungan_dinas_luar') }}</td>
                            @php
                                $totalperan -= $peran2;
                            @endphp
                            <td> {{ $totalperan }} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="page">
            @if ($bulan == 1)
                <h1> REKAPITULASI PENERIMAAN BULAN Januari</h1>
            @endif
            @if ($bulan == 2)
                <h1> REKAPITULASI PENERIMAAN BULAN Februari</h1>
            @endif
            @if ($bulan == 3)
                <h1> REKAPITULASI PENERIMAAN BULAN Maret</h1>
            @endif
            @if ($bulan == 4)
                <h1> REKAPITULASI PENERIMAAN BULAN April</h1>
            @endif
            @if ($bulan == 5)
                <h1> REKAPITULASI PENERIMAAN BULAN Mei</h1>
            @endif
            @if ($bulan == 6)
                <h1> REKAPITULASI PENERIMAAN BULAN Juni</h1>
            @endif
            @if ($bulan == 7)
                <h1> REKAPITULASI PENERIMAAN BULAN Juli</h1>
            @endif
            @if ($bulan == 8)
                <h1> REKAPITULASI PENERIMAAN BULAN Agustus</h1>
            @endif
            @if ($bulan == 9)
                <h1> REKAPITULASI PENERIMAAN BULAN September</h1>
            @endif
            @if ($bulan == 10)
                <h1> REKAPITULASI PENERIMAAN BULAN Oktober</h1>
            @endif
            @if ($bulan == 11)
                <h1> REKAPITULASI PENERIMAAN BULAN November</h1>
            @endif
            @if ($bulan == 12)
                <h1> REKAPITULASI PENERIMAAN BULAN Desember</h1>
            @endif
            <table>
                @php
                $total99 = 0;
            @endphp
                @foreach ($surat[$bulan]->groupBy('nama_karyawan') as $p)

                    <tr>
                        <td>{{ $p->first()->pegawai->nama_karyawan }}</td>
                        <td>{{number_format($total77 = $p->sum('perhitungan')) }}</td>
                    </tr>

                    @php
                        $total99 += $total77
                    @endphp
                    @endforeach


                <tr>
                    <td>Total Rp.</td>
                    <td> {{ number_format($total99)  }}</td>

                </tr>
            </table>
        </div>
    @endfor
</body>
