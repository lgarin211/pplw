@extends('admin.template')
@section('content')

   <h4>Laporan Kinerja</h4>

    <div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/rekap_laporanKinerja') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                   <label for="">Tim</label>
                    <select class="form-control mt-2 filter"  id="kegiatan" name="id_anggaran" required>
                        <option value="">Pilih</option>
                        @foreach ($pegawai as $key => $p)
                          <option value="{{ $p->id }}">{{ $p->nama_karyawan}}</option>
                        @endforeach
                  </select>
                </div>
                 <div class="col-6 mb-3">
                    <label for="">Triwulan</label>
                    <select name="date_filter" id="bulan" class="form-control" required>
                        <option value="">Pilih Bulan</option>
                    <option value="tw1">Triwaulan I</option>
                    <option value="tw2">Triwaulan II</option>
                    <option value="tw3">Triwaulan III</option>
                    <option value="tw4">Triwaulan IV</option>
                    </select>
                </div>
                </div>

                    <button  type="submit" class="btn btn-primary">EXPORT EXCEL</button>

        </form>
    </div>
</div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script>
            $(document).ready(function () {
                $("#kegiatan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Anggaran Kegiatan"
                });
                 $("#bulan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
            });

        </script>
@endsection

