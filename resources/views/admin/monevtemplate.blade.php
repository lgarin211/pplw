@extends('admin.template')
@section('content')

   <h4>Laporan Kinerja</h4>

    <div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/rekapMonev') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
                 <div class="col-12 mb-3">
                    <label for="">Triwulan</label>
                    <select name="date_filter" id="bulan" class="form-control" required>
                        <option value="">Pilih Bulan</option>
                    <option value="tw1">Triwulan I</option>
                    <option value="tw2">Triwulan II</option>
                    <option value="tw3">Triwulan III</option>
                    <option value="tw4">Triwulan IV</option>
                    </select>
                </div>
                <button  type="submit" class="btn btn-primary">EXPORT EXCEL</button>
                </div>


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

