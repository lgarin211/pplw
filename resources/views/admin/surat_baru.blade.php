@extends('admin.template')
@section('content')
<div class="alert alert-info" role="alert">
    Tambah Surat Tugas Baru
  </div>
<div class="card mb-4">
    <div class="card-header"></div>
    <div class="card-body">
        <form action="{{ url('surat_store/'.$suratBaru->id) }}" method="post" enctype="multipart/form-data">
            @method('post')
            @csrf
            <div class="row">
                <div class="col-12 mb-3">
                    <label for="name">{{ __('File') }}</label>
                 <input type="file" class="form-control" name="pdf[]" required multiple accept="image/*">
                </div>
            </div>

            <button class="btn btn-primary">Tambah Berkas</button>
        </form>
    </div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Pesan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body justify-content-center" style="text-align: justify;">
        @if (session('warning'))
        <?php  echo session('warning') ?>
        @endif
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
   $(document).ready(function () {
                  $("#tahun").select2({
                    theme: 'bootstrap4'
                });
            });
        </script>
<script>

    @if(session('warning'))
       $(document).ready(function(){
    $("#myModal").modal('show');
        });
    @endif

</script>
@endsection
