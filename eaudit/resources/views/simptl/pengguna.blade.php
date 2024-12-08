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

            <a href="{{ url('simptl/pengguna_create') }}" class="btn btn-info">Tambah Pengguna</a>

            <table id="mytable" class="mt-2" style="width: 100%">
                <thead>
                    <tr>
                        <tr>
                            <th>Username</th>
                            <th>Level</th>
                        </tr>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0" id="tbody" style="background-color: white">
                    @foreach ($data as $index => $v)
                    <tr>
                        <td>{{ $v->username }}</td>
                        <td>{{ $v->level }}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>

            <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
                integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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
            </div>

@endsection
