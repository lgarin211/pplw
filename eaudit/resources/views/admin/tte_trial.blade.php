@extends('admin.template')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <h5>Berkas TTE</h5>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Bulan Penugasan</th>
                <th>Nama File</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            <?php $no = 1; ?>
            <?php $first = ''; ?>
            @foreach ($Ts as $key => $tiap_ts)
            <tr>
                <td rowspan="<?php echo $tiap_ts['rowspan']; ?>"><?php echo $key + 1; ?></td>
                <td rowspan="<?php echo $tiap_ts['rowspan']; ?>">{{ Carbon\Carbon::parse($tiap_ts->Tanggalsurat)->translatedFormat('F') }}</td>
                <td>ST {{ $tiap_ts->jenis->nama }} ke {{ $tiap_ts->obrik->nama }} </td>
                <td>{{ $tiap_ts->status }}</td>
                <td> <a href="{{ url('tte_viewPDF/' . $tiap_ts->id . '/view') }}" class="btn btn-info">VIEW</a> </td>
                <td> <a href="<?php echo url('download/file/' . $tiap_ts['pdf']); ?>" class="btn btn-success">DOWNLOAD</a> </td>
            </tr>
            @endforeach
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

@endsection
