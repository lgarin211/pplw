@extends('admin.template')
@section('content')
<div class="alert alert-info" role="alert">
    Edit Data Kegiatan
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
       <form action="{{ url('kegiatan_baru/'.$kegiatan->id) }}" method="post" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="row">
                <div class="col-4 mb-3">
                    <label for="">Nomor Kegiatan  </label>
                    <input type="text" name="nomor" class="form-control" value="{{ $kegiatan->nomor }}">
                </div>
                <div class="col-4 mb-3">
                    <label for="">Nama  Kegiatan  </label>
                    <textarea name="kegiatan" id="" class="form-control">{{ $kegiatan->kegiatan }}</textarea>
                </div>
                <div class="col-4 mb-3">
                        <label for="">PPTK Kegiatan  </label>
                        <select class="form-control"  name="id_pptk" id="pptk">
                            <option value="">Pilih</option>
                            @foreach ($p as $g)
                            <option value="{{ $g->id }}" {{ $g->id==$kegiatan->id_pptk?'selected':''}}>
                            {{ $g->nama_karyawan }}
                              @endforeach
                         </select>  
                </div>
            </div>
               
            <button class="btn btn-primary">Edit Kegiatan</button>
        </form>
    </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script>
            $(document).ready(function () {
                $("#pangkat").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#kendaraan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                $("#jabatan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
                 $("#status").select2({
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
@endsection
 
