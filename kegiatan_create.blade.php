@extends('admin.template')
@section('content')
    <div class="alert alert-info" role="alert">
        Tambah Data Kegiatan
    </div>
    <div class="card mb-4">
        <div class="card-header"></div>
        <div class="card-body">
            <form action="{{ url('/kegiatan_baru') }}" method="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="row">
                    <div class="col-4 mb-3">
                        <label for="">Nomor Rekening </label>
                        <input type="text" name="nomor" class="form-control">
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">Nama Kegiatan </label>
                        <textarea name="kegiatan" id="" class="form-control"></textarea>
                    </div>
                    <div class="col-4 mb-3">
                        <label for="">PPTK </label>
                        <select class="form-control" name="id_pptk" id="pptk">
                            <option value="" disabled selected>Select your option</option>
                            @foreach ($p as $key => $ps)
                                <option value="{{ $ps->id }}">{{ $ps->nama_karyawan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary">Tambah Kegiatan</button>
            </form>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body justify-content-center" style="text-align: justify;">
                    @if (session('warning'))
                        <?php echo session('warning'); ?>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            $("#pptk").select2({
                theme: 'bootstrap4',
                placeholder: "-Pilih PPTK-"
            });
            $("#jabatan").select2({
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

    <script>
        @if (session('warning'))
            $(document).ready(function() {
                $("#myModal").modal('show');
            });
        @endif
    </script>
@endsection
