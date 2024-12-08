@extends('absensi.index')
@section('content')
    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                <img src="{{ asset('absensi/assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w64 rounded">
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ session('name') }}</h2>
                <span id="user-role">{{ session('level') }}</span>
            </div>
        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="camera"></ion-icon>
                                    {{-- @if ($presensiHariini != null)
                                    @php
                                        $path = Storage::url('uploads/absensi/'.$presensiHariini->foto_in)
                                    @endphp
                                    <img src="{{ url($path) }}" class="imaged w48">
                                    @else
                                    <ion-icon name="camera"></ion-icon>
                                    @endif --}}
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $presensiHariini != null ? $presensiHariini->jam_in : "Belum Absen" }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    <ion-icon name="camera"></ion-icon>
                                    {{-- @if ($presensiHariini != null && $presensiHariini->jam_out != null)
                                    @php
                                    $path2 = Storage::url('public/uploads/absensi/'.$presensiHariini->foto_out)
                                    @endphp
                                    <img src="{{ url($path2) }}" class="imaged w48">
                                    @else
                                    <ion-icon name="camera"></ion-icon>
                                    @endif --}}
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $presensiHariini != null && $presensiHariini->jam_out != null ? $presensiHariini->jam_out : "Belum Absen" }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="rekappresence">
            <div id="chartdiv"></div>
            <!-- <div class="row">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence primary">
                                    <ion-icon name="log-in"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Hadir</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence green">
                                    <ion-icon name="document-text"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Izin</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence warning">
                                    <ion-icon name="sad"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Sakit</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence danger">
                                    <ion-icon name="alarm"></ion-icon>
                                </div>
                                <div class="presencedetail">
                                    <h4 class="rekappresencetitle">Terlambat</h4>
                                    <span class="rekappresencedetail">0 Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        </div>

        <div id="rekapPresensi">
            <h3>Rekap Presensi Bulan {{ $namaBulan[$bulanini] }} Tahun {{ $tahunini }}</h3>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important; ">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">{{ $rekapPresensi->jmlhadir }}</span>
                            <ion-icon style="font-size: 1.7rem" name="accessibility-outline" class="text-primary mb-1"></ion-icon>
                        <br>
                        <span style="font-size:0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important; ">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">10</span>
                            <ion-icon style="font-size: 1.7rem;" name="newspaper-outline" class="text-success mb-1"></ion-icon>
                        <br>
                        <span style="font-size:0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important; ">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">10</span>
                            <ion-icon style="font-size: 1.7rem" name="medkit-outline" class="text-warning mb-1"></ion-icon>
                        <br>
                        <span style="font-size:0.8rem; font-weight:500">Sakit</span>
                    </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding:16px 12px !important ">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:10px;font-size:0.6rem; z-index:999">{{ $rekapPresensi->jmlterlambat }}</span>
                            <ion-icon style="font-size: 1.7rem" name="alarm-outline" class="text-danger mb-1"></ion-icon>
                        <br>
                        <span style="font-size:0.8rem; font-weight:500">Telat</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div>
            <div class="tab-content mt-2" style="margin-bottom:100px;">
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="image-outline" role="img" class="md hydrated"
                                        aria-label="image outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Photos</div>
                                    <span class="badge badge-danger">10</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-secondary">
                                    <ion-icon name="videocam-outline" role="img" class="md hydrated"
                                        aria-label="videocam outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Videos</div>
                                    <span class="text-muted">None</span>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="item">
                                <div class="icon-box bg-danger">
                                    <ion-icon name="musical-notes-outline" role="img" class="md hydrated"
                                        aria-label="musical notes outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>Music</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($leaderboard as $d)
                        <li>
                            <div class="item">
                                <img src="{{ asset("absensi/assets/img/sample/avatar/avatar1.jpg") }}" alt="image" class="image">
                                <div class="in">
                                    <div>{{ $d->nama_karyawan }}</div>
                                    <span class="badge {{ $d->jam_in < "07:30" ? "bg-success" : "bg-danger" }}">{{ $d->jam_in }}</span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    </div>

<!-- * App Capsule -->

@endsection
