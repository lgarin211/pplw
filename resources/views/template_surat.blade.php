<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title><?php echo 'ST' . ' ' . $st->obrik->nama; ?></title>
    <style type="text/css">
        body {
            margin: 0.5cm 1cm 1cm 2.5cm !important;
        }

        h6 {
            font-size: 14pt !important;
        }

        h5 {
            font-size: 24pt !important;
        }

        .table1 {
            background: #fff;
            padding: 5px;
            border-collapse: collapse;
        }

        .table1 tr,
        .table1 td,
        .table1 th {
            border: table-cell;
            border: 1px solid #444;
        }

        th {
            height: 30px;
            vertical-align: middle !important;
        }

        tr,
        td {
            vertical-align: top !important;
        }

        #right {
            border-right: none !important;
        }

        #left {
            border-left: none !important;
        }

        .disp {
            text-align: center;
            margin-bottom: .5rem;
        }

        .judul {
            font-size: 16pt;
            font-weight: bold;
        }

        .logodisp {
            width: 110px;
            height: 150px;

            position: absolute;
            left: 0px;
            top: 25px;
            z-index: -1;
        }

        #lead {
            width: auto;
            position: relative;
            margin: 25px 0px 0px 75%;
        }

        .lead {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: -10px;
        }

        .tgh {
            text-align: center;
        }

        .rata {
            text-align: justify;
        }

        .lt {
            text-align: left;
        }

        .rgt {
            text-align: right;
        }

        #nama {
            font-size: 2.1rem;
            margin-bottom: -1rem;
        }

        #alamat {
            font-size: 16pt;
        }

        .up {
            text-transform: uppercase;
            margin: 0px;
            line-height: 2.2rem;
            font-size: 1.5rem;
        }

        .status {
            margin: 0;
            font-size: 1.3rem;
            margin-bottom: .5rem;
        }

        .separator {
            border-bottom: 2px solid #616161;
            margin: -1.3rem 0 1.5rem;
        }

        @media print {
            body {
                margin: 0.5cm 1cm 1cm 2.0cm !important;
                background-color: yellow;
                font-family: Times New Roman;
                font-size: 14pt;
            }

            #colres {}

            h6 {
                font-size: 14pt !important;
            }

            h5 {
                font-size: 24pt !important;
            }

            nav {
                display: none;
            }

            .table1 {
                font-size: 12pt !important;
                color: #212121;
                width: 100%;
            }

            .table1 thead {
                text-align: center;
            }

            th {
                height: 30px !important;
                vertical-align: middle !important;
            }

            tr,
            td {
                vertical-align: top !important;
            }

            .table1 tr,
            .table1 td,
            .table1 th {
                height: 20px;
                border: table-cell;
                border: 1px solid #444;
                padding: 2px !important;

            }

            #prn {
                min-width: 100pt !important;
            }

            table {
                font-size: 14pt;
            }

            .ttd {
                text-align: center;
            }

            .tgh {
                text-align: center;
            }

            .rata {
                text-align: justify;
            }

            .disp {
                text-align: center;
                margin-left: 80px;

            }

            .logodisp {


                position: absolute;
                left: 2.0cm;
                top: 25px;
                z-index: -1;

                width: 80px;
                height: 120px;

            }

            #surat {
                width: auto;
                position: relative;

            }

            #lead {
                width: auto;
                position: relative;

            }

            .lead {
                font-weight: bold;
                text-decoration: underline;

            }

            #nama {
                font-weight: bold;
                text-transform: uppercase;

            }

            .up {
                text-transform: uppercase;
                font-weight: bold;
            }

            .status {
                font-size: 14pt !important;
                font-weight: normal;

            }

            #alamat {
                font-size: 11pt;
            }

            #lbr {
                font-size: 17px;
                font-weight: bold;
            }

            .judul {
                font-size: 16pt;
                font-weight: bold;
                margin-bottom: 0px;
            }

            .separator {
                border-bottom: 5px solid #616161;

            }

        }
    </style>
</head>

<body onload="window.print()">

    <div class="page">
        <div id="colres">
            <div class="disp"><img class="logodisp" src="{{ asset('logo/logo.jpg') }}" />
                <h6 class="up">{{ $skpd->instansi }} </h6>
                <h5 class="up" id="nama">{{ $skpd->skpd }}</h5><br />
                <h6 class="status">{{ $skpd->alamat }} Telp/Fax {{ $skpd->telp }}</h6><span
                    id="alamat">{{ $skpd->website }} E-mail: <u><a href="">{{ $skpd->email }}</a></u> Kode
                    Pos: {{ $skpd->kodepos }}</span>
            </div>
            <div class="line-separator" style="height:5px;
background:#717171;
border-bottom:1px solid #313030;"></div>
            <div class="line-separator" style="height:1.5px;
background:#717171;
border-bottom:5px solid #313030;">
            </div>
            <center>
                <p></p>
                <u>
                    <p class="judul">SURAT PERINTAH TUGAS</p>
                </u>
                <p class="judul">No. {{ '094/' . $st->noSurat . '/03' . '/' . date('Y') }}</p>
            </center>
            <p style="text-indent: 3cm";>Inspektur Kabupaten Sragen memberikan tugas kepada :
            <div>
                <table class="table1" id="tbl">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>NIP</th>
                            <th id="prn">PERAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($surat as $k => $v)
                            <tr>
                                <td style='text-align:center;'>{{ $k + 1 }}</td>
                            <td>{{$v->pegawai->gelar_depan }} {{Str::upper($v->pegawai->nama_karyawan.",")}} {{$v->pegawai->gelar }}</td>
                                <td>{{ $v->pegawai->nip }}</td>
                                <td> {{ $v->peran->nama }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div><br>
                <table border='0' valign='bottom'>
                    <tr>
                        <td style='text-indent: 2cm; width:250px'>Untuk melakukan</td>
                        <td> : </td>

                        <td class='rata'>
                        {{ $st->jenis->nama }} di {{ $st->obrik->nama }}
                         </td>
                    </tr>
                    <tr>
                        <td style='text-indent: 2cm; width:100px'>Tanggal </td>
                        <td> : </td>
                        <td>
                          @if (date('m',strtotime($st->Tanggalsurat)) == date('m',strtotime($st->TanggalAkhir)))
                          {{ Carbon\Carbon::parse($st->Tanggalsurat)->translatedFormat('d') }} s/d
                          {{ Carbon\Carbon::parse($st->TanggalAkhir)->translatedFormat('d F Y') }}
                          @else
                          {{ Carbon\Carbon::parse($st->Tanggalsurat)->translatedFormat('d F') }} s/d
                          {{ Carbon\Carbon::parse($st->TanggalAkhir)->translatedFormat('d F Y') }}
                          @endif
                        </td>

                    </tr>
                </table>
                <div>
                    <p style='text-indent: 2cm;'>Demikian untuk dilaksanakan dengan penuh tanggung jawab</p>
                    <div>
                        <table class="ttd" align="right">
                            <tr>
                                <td>Sragen,
                                    {{ Carbon\Carbon::parse($st->tanggalterbitSurat)->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>INSPEKTUR DAERAH<br />
                                    KABUPATEN SRAGEN<br />
                                    <br> <br> <br>
                                </td>
                            </tr>
                            <tr>
                                <td><u> BADRUS SAMSU DARUSI, S.STP, M.Si</u><br>
                                    Pembina Utama Muda<br>   NIP. {{$skpd->Pemimpin->nip}}<br></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div style="height: 200px;"></div>
                    <br><br><br>
                    <p> TEMBUSAN : </P>
                    <p> Yth. Bupati Sragen (Sebagai laporan)</p>
                </div>
                <div class="jarak2"></div>
            </div>



            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
            </script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->
            <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->
</body>

</html>
