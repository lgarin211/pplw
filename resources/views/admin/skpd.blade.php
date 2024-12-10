@extends('admin.template')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="row">
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Data Instansi</h5>
        </div>
        <div class="card-body">
            <form action="{{ url("skpd_edit") }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("put")
            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Instansi</label>
                </div>
                <div class="col-md-8 mt-2">
                    <input type="text" class="form-control" name="instansi" id="basic-default-fullname"  value="{{ $c->instansi }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">SKPD</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="skpd" id="basic-default-fullname" value="{{ $c->skpd }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Alamat</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="alamat" id="basic-default-fullname" value="{{ $c->alamat }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Telp/Fax</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="telp" id="basic-default-fullname" value="{{ $c->telp }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Website</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="website" id="basic-default-fullname" value="{{ $c->website }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Email</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="email" id="basic-default-fullname" value="{{ $c->email }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Kode Pos</label>
                </div>
                <div class="col-md-8">
                    <input type="text" class="form-control" name="kodepos" id="basic-default-fullname" value="{{ $c->kodepos }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Logo</label>
                </div>
                <div class="col-md-8">
                    <input type="file" class="form-control" name="logo" id="basic-default-fullname" />
                    <img src="{{ asset('logo/'.$c->logo) }}" class="w-50 mt-3" alt="">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Pemimpin</label>
                </div>
                <div class="col-md-8">
                    <select class="form-control"  name="id_pegawai" id="pemimpin">
                        @foreach ($p as $g)
                        <option value="">Pilih Pegawai</option>
                        <option value="{{ $g->id }}" {{ $g->id==$c->id_pegawai?'selected':''}}>
                            {{ $g->gelar_depan }} {{ $g->nama_karyawan }}{{ ",".$g->gelar }}
                          @endforeach
                     </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 mt-2">
                    <label class="form-label" for="basic-default-fullname">Bendahara</label>
                </div>
                <div class="col-md-8">
                    <select class="form-control"  name="id_bendahara" id="bendahara">
                        <option value="">Pilih</option>
                        @foreach ($p as $g)
                        <option value="{{ $g->id }}" {{ $g->id==$c->id_bendahara?'selected':''}}>
                            {{ $g->gelar_depan }} {{ $g->nama_karyawan }}{{ ",".$g->gelar }}
                          @endforeach
                     </select>
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Ubah Data</button>
          </form>
        </div>
      </div>
    </div>
    <div class="col-xl">
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Nomor Surat</h5>
        </div>
        <div class="card-body">
          <form action="{{ url("nomor_edit") }}" method="post">
            @csrf
            @method("put")
            <div class="row mb-3">
                <div class="col-md-6 mt-3">
                    <label class="form-label" for="basic-default-fullname">Nomor Surat Dalam Daerah</label>
                </div>
                <div class="col-md-6 mt-3">
                    <input type="text" class="form-control" name="nomordalam"  id="basic-default-fullname" value="{{ $c->nomordalam }}" />
                </div>
            </div>

            {{-- <div class="row mb-3">
                <div class="col-md-6 mt-2">
                    <label class="form-label" for="basic-default-fullname">Nomor Surat Luar Daerah</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nomorluar" id="basic-default-fullname" value="{{ $c->nomorluar }}" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 mt-2">
                    <label class="form-label" for="basic-default-fullname">Nomor Surat Luar Negeri</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" name="nomornegeri" id="basic-default-fullname" value="{{ $c->nomornegeri }}" />
                </div>
            </div> --}}



            {{-- <select class="js-example-basic-single" name="state">
                <option value="AL">Alabama</option>
                <option value="WY">Wyoming</option>
              </select> --}}

            <button type="submit" class="btn btn-primary">Ubah Data</button>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script>
            $(document).ready(function () {
                $("#kota").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });

                $("#pemimpin").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });

                 $("#bendahara").select2({
                    theme: 'bootstrap4',
                    placeholder: "Please Select"
                });
            });

        </script>

       <script>

        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}")
        @endif

        @if (Session::has('info'))
            toastr.info("{{ Session::get('info') }}")
        @endif

        @if (Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}")
        @endif
  </script>

  <script>
            $(document).ready(function () {
                $("#obrik").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Obrik"
                });
                $("#jenis_pengawasan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Jenis Pengawasan"
                });
                $("#bulan").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
                $("#tahun23").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Bulan"
                });
                   $("#tahun").select2({
                    theme: 'bootstrap4',
                    placeholder: "Pilih Anggaran Kegiatan"
                });
            });
        </script>
@endsection

