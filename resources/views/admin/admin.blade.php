@extends('admin.template')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-2">
            <div class="card">
                 <h5 class="text-center mt-3">JUMLAH PEGAWAI</h5>
                 <h3 class="text-center">{{ $p }}</h3>
            </div>
        </div>
        <div class="col-4 col-sm-2">  
            <div class="card">
                 <h5 class="text-center mt-3">JUMLAH PENUGASAN</h5>
                 <h3 class="text-center">{{ $n }}</h3>         
            </div>
        </div>
        <div class="col-4 col-sm-2">  
            <div class="card">
                 <h5 class="text-center mt-3">TOTAL BIAYA Rp. </h5>         
            </div>
        </div>                          
    </div>
</div>
      
@endsection