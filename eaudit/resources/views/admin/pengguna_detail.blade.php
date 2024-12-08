@extends('admin.template')
@section('content')

<div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Data Pengguna</h5>
        </div>
        <div class="card-body">
          <form>
            <div class="row mt-3">
                <div class="col-md-6 mt-2">
                    <label class="form-label" for="basic-default-fullname">Nama</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="basic-default-fullname" placeholder="John Doe" value="{{ $pengguna->name }}" readonly/>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 mt-2">
                    <label class="form-label" for="basic-default-fullname">Username</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="basic-default-fullname" value="{{ $pengguna->username }}" readonly/>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-6 mt-2">
                    <label class="form-label" for="basic-default-fullname">Email </label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="basic-default-fullname" value="{{ $pengguna->email }}" readonly/>
                </div>
            </div>

          </form>
        </div>
      </div>
    </div>
</div>

   
        
      
@endsection