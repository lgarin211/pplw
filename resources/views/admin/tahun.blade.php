@extends('admin.template')
@section('content')

<div class="card">
    <h5 class="card-header">Daftar Tahun
        <div class="d-flex justify-content-end"><a href="{{ url('tahun_new') }}"  class="btn btn-success">Tambah Tahun</a></div>
    </h5>
   
    <div class="table-responsive text-nowrap">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Tahun</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($t as $k => $v)      
            <tr>
                <td>{{ $k+1 }}</td>
                <td>{{ $v->tahun }}</td>
                <td>
                    <form action="{{ url('tahun/'.$v->id.'/hapus') }}" method="POST" class="d-inline mb-3">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>

    </div>
  </div>  
  
        
      
@endsection