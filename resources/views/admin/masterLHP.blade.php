@extends('admin.template')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <h5>Berkas LHP
        <div class="d-flex justify-content-end"><a href="{{ url('lhp_baru') }}" class="btn btn-success">Tambah Berkas LHP</a>
        </div>
    </h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Berkas</th>
                <th>Berkas</th>
                <th>view</th>
                {{-- <th>Download</th> --}}
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <?php $no = 1; ?>
            <?php $first = ''; ?>
            <?php foreach ($lh as $key => $tiap_lh): ?>
            <tr>
                <td rowspan="<?php echo $tiap_lh['rowspan']; ?>"><?php echo $key + 1; ?></td>
                <td rowspan="<?php echo $tiap_lh['rowspan']; ?>"><?php echo $tiap_lh['nama']; ?></td>
                <?php foreach ($tiap_lh->lhp as $k => $tiap_lhp): ?>
                <td><?php echo $tiap_lhp['lhp']; ?></td>
                <td> <a href="{{ url('lhp_viewPDF/' . $tiap_lhp->id . '/view') }}" class="btn btn-info">VIEW</a> </td>
                {{-- <td> <a href="<?php echo url('download/berkas/' . $tiap_lhp['lhp']); ?>" class="btn btn-success">DOWNLOAD</a> </td> --}}
            </tr>
            <tr>
                <?php endforeach ?>
            </tr>
            <?php endforeach ?>

        </tbody>
    </table>



    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}")
        @endif
    </script>

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
