@extends('admin.template')
@section('content')

   <h4>Rincian RKPD</h4>

    <div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('/rekap_rincianRKPD') }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                   <label for="">Kegiatan</label>
                    <select class="form-control mt-2 filter"  id="kegiatan" name="id_anggaran" required>
                      <option value="">Pilih</option>
                      @foreach ($kegiatan as $key => $p)
                        <option value="{{ $p->id }}">{{ $p->kegiatan}}</option>
                      @endforeach
                  </select>
                </div>
                 <div class="col-6 mb-3">
                    <label for="">Triwulan I</label>
                    <select name="triwulan" id="bulan" class="form-control" required>
                        <option value="">Pilih Bulan</option>
                    <option value="1">Triwulan I</option>
                    <option value="2">Triwulan II</option>
                    <option value="3">Triwulan III</option>
                    <option value="4">Triwulan IV</option>
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

