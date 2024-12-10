@extends('simptl.template')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="alert alert-info" role="alert">
    User
  </div>
<div class="card mb-4">
    <div class="card-header">Data User</div>
    <div class="card-body">
        <form action="{{ url('simptl/pengguna_store') }}" method="post" enctype="multipart/form-data">
            @method('POST')
            @csrf
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="">username </label>
                    <input type="text" name="username"  class="form-control">
                </div>
                <div class="col-6 mb-3">
                    <label for="">Password </label>
                    <input type="text" name="password"  class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-info">Tambah User</button>
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

<script type="text/javascript">
    $(document).ready(function () {
        $('#add_btn').on('click',function () {
            var html='';
            html+='<tr>';
            html+='<td><input type="text" class="form-control" name="kode_rekomendasi[]"></td>';
            html+='<td><input type="text" class="form-control" name="rekomendasi[]"></td>';
            html+='<td><input type="text" class="form-control" name="keterangan[]"></td>';
            html+='<td><input type="text" class="form-control" name="pengembalian[]"></td>';
            html+='<td><button type="button" class="btn btn-primary" id="remove"><i class="fa-solid fa-minus"></i></button></td>';
            html+='</tr>';
            $('.body').append(html);
        })

        $(document).on('click','#remove',function () {
            $(this).closest('tr').remove();
        })
    });


</script>
@endsection
