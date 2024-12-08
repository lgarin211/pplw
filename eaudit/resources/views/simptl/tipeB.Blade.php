@extends('simptl.template')
@section('content')




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
