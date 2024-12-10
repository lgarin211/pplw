@extends('admin.template')
@section('content')
    <h5>Daftar Rekapitulasi</h5>
    {{-- <div class="row">
        <div class="col-5 mt-3">
            <a  href="{{ url('rekap_PerjalananPDF') }}" style="color: #FFF" class="btn btn-primary mb-3">
                Rekap Penilaian Perjalanan Dinas PDF
            </a>
        </div>
        <div class="col-3 mt-3">
            <a  href="{{ url('rekapan') }}" style="color: #FFF" class="btn btn-warning ms-2 mb-3">
                Rekapan Surat Tugas
            </a>
        </div>
        <div class="col-4  mt-3">
            <a  href="{{ url('rekap_PerjalananPegawaiPDF') }}" style="color: #FFF" class="btn btn-info  mb-3">
                Rekap Per Pegawai PDF
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mt-3">
            <a  href="{{ url('rekap_Perjalanan') }}" style="color: #FFF" class="btn btn-primary ms-2 mb-3">
                Rekap Penilaian Perjalanan Dinas Excel
            </a>
        </div>
        {{-- <div class="col-6 mt-3">
            <a  href="{{ url('rekap_PerjalananPegawai') }}" style="color: #FFF" class="btn btn-info ms-2 mb-3">
                            Rekap Per Pegawai Excel
            </a>
        </div> --}}
    {{-- </div>  --}}

    <div class="row">
        <div class="col-3 mb-3">
            <a href="{{ url('rekap_PerjalananPDF') }}" style="color: #FFF" class="btn btn-primary mb-3">
                Rekap Penilaian Perjalanan Dinas PDF
            </a>
        </div>
        <div class="col-3 mb-3">
            <a href="{{ url('rekapan') }}" style="color: #FFF" class="btn btn-warning ms-3 mb-3">
                Rekapan Surat Tugas
            </a>
        </div>
        <div class="col-3 mb-3">
            <a href="{{ url('rekap_PerjalananPegawaiPDF') }}" style="color: #FFF" class="btn btn-info  mb-3">
                Rekap Per Pegawai PDF
            </a>
        </div>
        <div class="col-3 mb-3">
            <a href="{{ url('report_PKPT') }}" style="color: #FFF" class="btn btn-info  mb-3">
                Report PKPT
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-3">
            <a href="{{ url('rekap_Perjalanan') }}" style="color: #FFF" class="btn btn-primary  mb-3">
                Rekap Penilaian Perjalanan Dinas Excel
            </a>
        </div>
        <div class="col-6 mb-3">
            <a href="{{ url('rekap_PerjalananPegawai') }}" style="color: #FFF" class="btn btn-info ms-2  mb-3">
                Rekap Per Pegawai Excel
            </a>
        </div>
        {{-- <div class="col-4 mb-3">
                  <a  href="{{ url('rekap_LaporanBPK') }}" style="color: #FFF" class="btn btn-info  mb-3">
                    Rekap Laporan BPK
                  </a>
                </div> --}}


    </div>

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
        });
    </script>
@endsection
