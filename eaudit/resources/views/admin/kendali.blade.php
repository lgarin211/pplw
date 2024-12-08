@extends('admin.template')
@section('content')
<h5>Tabel Kendali</h5>
<form action="{{ url('carikendali') }}" method="post">
    @method('post')
    @csrf

<div class="row">
    <div class="col-6">
        <label for="" class="mt-2">Bulan</label>
        <select name="bulan" id="bulan" class="form-control mt-3">
            <option value="">Pilih Bulan</option>
            <option value="01" @if ($month == "01") selected  @endif>Januari</option>
            <option value="02" @if ($month == "02") selected  @endif>Februari</option>
            <option value="03" @if ($month == "03") selected  @endif>Maret</option>
            <option value="04" @if ($month == "04") selected  @endif>April</option>
            <option value="05" @if ($month == "05") selected  @endif>Mei</option>
            <option value="06" @if ($month == "06") selected  @endif>Juni</option>
            <option value="07" @if ($month == "07") selected  @endif>Juli</option>
            <option value="08" @if ($month == "08") selected  @endif>Agustus</option>
            <option value="09" @if ($month == "09") selected  @endif>September</option>
            <option value="10" @if ($month == "10") selected  @endif>Oktober</option>
            <option value="11" @if ($month == "11") selected  @endif>November</option>
            <option value="12" @if ($month == "12") selected  @endif>Desember</option>
        </select>
    </div>
    <div class="col-6">
        <br>
        <input type="submit" value="Tampilkan" id="tampil" class="btn btn-info mt-4">
    </div>
            </form>
</div>


<div class="d-flex justify-content-end mt-3">
    <a href="{{ url('jadwal_lain') }}" class="btn btn-info me-4">Jadwal Lain</a>
<a href="{{ url('jadwal_libur') }}" class="btn btn-success ">Menampilkan Hari Libur</a>
</div>

 @if ($filterbulan == '' AND $filtertahun == '')
    <h3 class="text-center mt-3">Rekap Penjagaan Bulan  {{  Carbon\Carbon::parse("F")->translatedFormat('F') }}  Tahun {{ session('tahun') }} </h3>
@else
            <h3 class="text-center mt-3">Rekap Penjagaan Bulan  {{ $filterbulan }} Tahun {{ session('tahun') }} </h3>
@endif

    <div class="table-responsive text-nowrap mt-3">
      <table class="table table-bordered">
        <thead>
          <tr>
            <th rowspan="2" class="text-center mb-3">No</th>
            <th rowspan="2" class="text-center mb-3">Nama Pegawai</th>
            <th colspan="31" class="text-center">Tanggal Pemeriksaan</th>
          </tr>
           <tr>
            @foreach ($tanggal as $item)
            <td @if (date('D', strtotime($item)) == 'Sat' ) class="bg-warning" style="background-color: yellow" @elseif (date('D', strtotime($item)) == 'Sun' OR (isset($jadwalLibur[date('Y-m-d', strtotime($item))])))   class="bg-danger" style="background-color: red"  @endif  > {{date('d', strtotime($item)) }}</td>
            @endforeach
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
            @foreach ($surat as $index => $v)
          <tr>
              <td>{{ $index+1 }}</td>
              <td>{{ $v->gelar_depan }} {{ $v->nama_karyawan }}{{ ",".$v->gelar }}</td>
              @foreach ($tanggal as $item)
              <td @if (date('D', strtotime($item)) == 'Sat' ) class="bg-warning" @elseif(date('D', strtotime($item)) == 'Sun' OR (isset($jadwalLibur[date('Y-m-d', strtotime($item))]))) class="bg-danger" @endif > @if (isset($keterangan[$v->id][$item]) AND date('D',strtotime($item)) != 'Sat' AND date('D',strtotime($item)) != 'Sun')
                  {{ $keterangan[$v->id][$item] }}


                @endif  </td>

             @endforeach
            </tr>
            @endforeach

        </tbody>
    </table>
    <a href="{{ url('cetakKendali') }}" class="btn btn-info mt-2" name="cetakkendali">Cetak Kendali</a>
     </div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            $('a[name="cetakkendali"]').click(function (e) {
                e.preventDefault();
                let url = "{{ url('cetakKendali/:bulan') }}";
                url = url.replace(':bulan',$('select[name="bulan"] option').filter(':selected').val());
                window.open(url);
            })
        </script>
@endsection
