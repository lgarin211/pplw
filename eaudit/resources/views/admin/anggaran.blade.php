@extends('admin.template')
@section('content')

<p>Halo Selamat Datang <b>{{ session('name') }}</b>  dengan posisi <b>{{ session('level') }}</b> </p>
  
        
      
@endsection