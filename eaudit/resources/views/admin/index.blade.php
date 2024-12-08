@extends('admin.template')
@section('content')
    <div class="container">
        <div class="row">
            {{-- <div class="col-xl-4 col-md-6 mb-4">
                <div class="card">
                    <h5 class="text-center mt-3">JUMLAH PEGAWAI</h5>
                    <h3 class="text-center">{{ $pegawai }}</h3>
                </div>
            </div> --}}
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card">
                    <h5 class="text-center mt-3">JUMLAH PENUGASAN</h5>
                    <h3 class="text-center">{{ $n }}</h3>
                </div>
            </div>


            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card">
                    <h5 class="text-center mt-3">TOTAL BIAYA Rp.</h5>
                    <h3 class="text-center">{{ number_format($total) }}</h3>
                </div>
            </div>

            {{-- <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card">
                 <h5 class="text-center mt-3">TOTAL BIAYA  Rp.</h5>
                 <h3 class="text-center">{{ number_format($tot) }}</h3>
            </div> --}}

        </div>

    </div>
    </div>
@endsection
