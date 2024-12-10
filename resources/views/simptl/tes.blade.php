@extends('simptl.template')
@section('content')
<style>
    #mytable {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    #mytable td, #mytable th {
      border: 2px solid #000;
      padding: 8px;
    }



    #mytable th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: left;
      background-color: #04AA6D;
      color: white;
    }
    </style>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Penugasan
  </button>

  <table id="mytable" class="table-light mt-2" style="width: 100%">
    <thead>
        <tr>
            <tr>
                <th>Penugasan</th>
                <th>Tipe Rekomendasi</th>
                <th>Obrik </th>
                <th>Aksi</th>
            </tr>
        </tr>
    </thead>
    <tbody class="table-border-bottom-0" id="tbody" style="background-color: white">
        @foreach ($pengawasan as $v)
            <tr>
                <td>{{ $v->surat->jenis->nama }}pada{{ $v->surat->obrik->nama }} </td>
                <td>{{ $v->tipe }}</td>
                <td>{{ $v->surat->obrik->nama }}</td>
                <td><form action="{{ url('simptl/pkpt_hapus/'.$v->id.'/hapus') }}" method="POST" class="d-inline mb-3">
                      @method('delete')
                      @csrf
                      <button class="btn btn-danger btn-sm ">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>



  <script type="text/javascript">

  let keyword = document.querySelector('#search');
//   var key = document.querySelector('#search1');

  keyword.addEventListener('keyup',function () {
    $value=$(keyword).val();
    $.ajax({
    type : 'get',
    url : '{{URL::to('searchJP')}}',
    data:{'search':$value},
    success:function(data){
    $('tbody').html(data);
    }
    });
  });




//   key.addEventListener('keyup',function () {
//     $value=$(key).val();
//     $.ajax({
//     type : 'get',
//     url : '{{URL::to('searchObrik')}}',
//     data:{'search':$value},
//     success:function(data){
//     $('tbody').html(data);
//     }
//     });
  });

//   if ((keyword.keyup) AND (key.keyup)) {
//     alert('cek');
//   }

// $('#search',).on('keyup',function(){
// $value=$(this).val();
// $.ajax({
// type : 'get',
// url : '{{URL::to('searchPKPT')}}',
// data:{'search':$value},
// success:function(data){
// $('tbody').html(data);
// }
// });


  </script>
@endsection
