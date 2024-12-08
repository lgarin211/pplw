@extends('admin.template')
@section('content')

<div class="card mb-4">
    <div class="card-header"> Detail Pegawai</div>
    <div class="card-body">
        <table class="table">
            <tr>
                <td>Nama Karyawan</td>
                <td><?php echo $pegawai->nama_karyawan ?></td>
            </tr>
            <tr>
                <td>Nip</td>
                <td><?php echo $pegawai->nip ?></td>
            </tr>
            <tr>
                <td>Pangkat</td>
                <td><?php echo $pegawai->pangkat->nama ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><?php echo $pegawai->jabatan->nama ?></td>
            </tr>
            <tr>
                <td>Eselon</td>
                <td><?php echo isset($pegawai->eselon)?$pegawai->eselon->nama:'' ?></td>
            </tr>
            <tr>
                <td>Kendaraan</td>
                <td><?php echo isset($pegawai->transportasi)?$pegawai->transportasi->kode:'' ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo $pegawai->status ?></td>
            </tr>
            <tr>
                <td>Rekening</td>
                <td><?php echo $pegawai->rekening ?></td>
            </tr>


        </table>
    </div>
</div>







@endsection
