
        <style type="text/css">
			#canvas1{
			   border: 0px solid;
			  }
            table {
                background: #fff;
				width:900;
                padding: 5px;
				border-collapse:collapse;
            }
            tr, td {
                border: table-cell;
                border: 1px  solid #444;
            }
            tr,td {
                vertical-align: top;
            }
			';
			/* echo '#bottom {
				border-bottom: 2px double #444;
			}
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
			#all {
				border-right: none !important;
				border-left: none !important;
				border-top: none !important;
				border-bottom: none !important;
			}#bottom {
				border-bottom: 2px double #444;
			}
            #right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
			#all {
				border-right: none !important;
				border-left: none !important;
				border-top: none !important;
				border-bottom: none !important;
			}'; */
            .isi {
                height: 300px!important;
            }
            .disp {
                text-align: center;
                padding: 1.5rem 0;
                margin-bottom: .5rem;
            }
            .logodisp {
                float: left;
                position: relative;
                width: 110px;
                height: 110px;
                margin: 0 0 0 1rem;
            }
            #lead {
                width: auto;
                position: relative;
                margin: 25px 0 0 75%;
            }
            .lead {
                font-weight: bold;
                text-decoration: underline;
                margin-bottom: -10px;
            }
            .tgh {
                text-align: center;
            }
            /*aturan border*/
            #all {
                border-right: none !important;
                border-left: none !important;
                border-top: none !important;
                border-bottom: none !important;
            }
			#right {
                border-right: none !important;
            }
            #left {
                border-left: none !important;
            }
            #tb{
				border-bottom: none;
				border-top: none;
			}
            /**/

            #nama {
                font-size: 2.1rem;
                margin-bottom: -1rem;
            }
            #alamat {
                font-size: 16px;
            }
            .up {
                text-transform: uppercase;
                margin: 0;
                line-height: 2.2rem;
                font-size: 1.5rem;
            }
            .status {
                margin: 0;
                font-size: 1.3rem;
                margin-bottom: .5rem;
            }
            #lbr {
                font-size: 20px;
				font-family: Times New Roman;
				text-decoration: underline;
                font-weight: bold;
            }
            .separator {
                border-bottom: 2px double #616161;
                margin: -1.3rem 0 1.5rem;
            }
            @media print{
                body {
                    font-size: 12pt;
					font-family: Times New Roman;
                    color: #212121;
                    margin-left: 40px;
                    margin-right: 30px;
                }
                nav {
                    display: none;
                }
                table {
                    width: 100%;
                    font-size: 12px;
                    color: #212121;
                }
                tr, td {
                    border: table-cell;
                    border: 1px  solid #444;

                }
                tr,td {
                    vertical-align: top;
                }
                #lbr {
                    font-size: 20px;
                }
				#bottom {
					border-bottom: 2px double #444;
				}
                .isi {
                    height: 200px!important;
                }
                .tgh {
                    text-align: center;
                }
                .disp {
                    text-align: center;
                    margin: -.5rem 0;
                }
                .logodisp {
                    float: left;
                    position: relative;
                    width: 80px;
                    height: 80px;
                    margin: .5rem 0 0 .5rem;
                }
                #lead {
                    width: auto;
                    position: relative;
                    margin: 15px 0 0 75%;
                }
                .lead {
                    font-weight: bold;
                    text-decoration: underline;
                    margin-bottom: -10px;
                }
                #nama {
                    font-size: 20px!important;
                    font-weight: bold;
                    text-transform: uppercase;
                    margin: -10px 0 -20px 0;
                }
                .up {
                    font-size: 17px!important;
                    font-weight: normal;
                }
                .status {
                    font-size: 17px!important;
                    font-weight: normal;
                    margin-bottom: -.1rem;
                }
                #alamat {
                    margin-top: -15px;
                    font-size: 13px;
                }
                #lbr {
                    font-size: 12px;
					font-family: Times New Roman;
					text-decoration: underline;
                    font-weight: bold;
                }
                .separator {
                    border-bottom: 2px double #616161;
                    margin: -1rem 0 1rem;
                }

            }
        </style>
        <body onload="window.print()">

        <!-- Container START -->
            <div id="colres" class="template">
                
                                      <table class="bordered" id="tbl">
                                          <tbody>
                                              <tr style="border-bottom: none;">
                                                  <td class="tgh" id="lbr" colspan="14" style="border-bottom: none;" height="20px">PEMERINTAHAN KABUPATEN SRAGEN</td>
                                              </tr>
                                <tr id="tb"><td colspan="14" id="tb"></td></tr>
                                <tr style="border-bottom: none;border-top: none;">
                                                  <td id="right" style="border-bottom: none;border-top: none;" colspan="3" width="200">TAHUN ANGGARAN</td>
                                  <td id="all" width="20">:</td>
                                  <td id="left" colspan="10" style="border-bottom: none;border-top: none;">{{ date('Y') }}
                                                  </td>
                                              </tr>
                                <tr id="bottom" style="border-bottom: double; border-top: none;">
                                                  <td id="right"style="border-top: none;"  colspan="3" width="100px">MATA ANGGARAN</td>
                                  <td id="all" style="border-right: none;">:</td>
                                  <td id="all" style="border-right: none;"  colspan="7">{{ $penugasan->anggaran->nomor }}</td>
                                  <td id="left" style="border-top: none;" colspan="3"> &emsp; Lembar ke:</td>
                                              </tr>
                                              <tr style="border-bottom: none;">
                                                  <td class="tgh" colspan="14" style="border-bottom: none;">TANDA BUKTI PENGELUARAN</td>
                                  </tr>
                                  <tr id="tb">
                                                  <td class="tgh" id="tb" colspan="14">NOMOR : &emsp;/&emsp;&emsp;/Inspektorat/BP/&emsp;/2023</td>
                                  </tr>
                                  <tr id="tb">
                                                  <td id="right" style="border-bottom: none;border-top: none;"  colspan="3">Sudah menerima uang dari</td>
                                  <td id="all">:</td>
                                  <td id="left" style="border-bottom: none;border-top: none;" colspan="10">Pemerintah Kabupaten Sragen</td>
                                  </tr>
                                  <tr id="tb" >
                                                  <td id="right" style="border-bottom: none;border-top: none;vertical-align:middle;"  colspan="3">Uang sejumlah &emsp; Rp.</td>
                                  <td id="all" colspan="5"><canvas id="canvas1" width="250" height="40"></canvas></td>
                                  <td id="left" style="border-bottom: none;border-top: none;vertical-align:middle;" colspan="6"><i>&emsp; satu juta delapan ratus  ribu  Rupiah</i></td>
                                  </tr>
                                  <tr style="border-bottom: none;border-top: none;">
                                                  <td id="right" style="border-bottom: none;border-top: none;"  colspan="3">Yaitu untuk pembayaran</td>
                                  <td id="all">:</td>
                                  <td id="left" colspan="10" style="min-width: 450px;border-bottom: none;border-top: none;height:50px;">Penerimaan {{ $penugasan->jenis->nama }} di {{ $penugasan->obrik->nama }}</td>
                                                </tr>
                                  <tr style="border-bottom: none;border-top: none;">
                                                  <td id="right" style="border-bottom: none;border-top: none;"  colspan="3">Untuk pekerjaan kegiatan</td>
                                  <td id="all">:</td>
                                  <td id="all" width="70">Bagian Pos</td>
                                  <td id="left" colspan="9" rowspan="2">{{ $penugasan->anggaran->kegiatan }}</td>
                                   </tr>
                                   <tr id="tb"><td id="all" height="20px" colspan="5"></td></tr></table>
                                <table>
                                   <tr style="border-bottom: none;border-top: none;">
                                     <td id="right" style="border-bottom: none;border-top: none;" colspan="8"></td>
                                  	 <td id="left" style="border-bottom: none;border-top: none;" colspan="4" >Sragen, </td>
                                  </tr>
                                   <tr style="border-bottom: none;border-top: none;">
                                                  <td id="right" style="border-bottom: none;border-top: none;" colspan="8"></td>
                                  <td class="tgh" id="left" style="border-bottom: none;border-top: none;" colspan="4" >Yang menerima uang</td>
                                  </tr>
                                   <tr style="border-bottom: none;border-top: none;">
                                                  <td id="right" style="border-bottom: none;border-top: none;" colspan="8"></td>
                                  <td id="all" >Nama</td>
                                  <td id="all" >:</td>
                                  <td id="left" style="border-top: none;" colspan="2">Terlampir</td>
                                  </tr>
                                   <tr style="border-bottom: none;border-top: none;">
                                                  <td id="right" style="border-bottom: none;border-top: none;" colspan="8"></td>
                                  <td id="all">Alamat</td>
                                  <td id="all" >:</td>
                                  <td id="left" style="border-top: none;" colspan="2">Terlampir</td>
                                  </tr>
                                  <tr height="20px" id="tb"><td colspan="12" id="tb"></td></tr>
                                   <tr style="border-bottom: none;border-top: none;">
                                   <td colspan="12" style="border-bottom: none;border-top: none;"></td>
                                              </tr>
                                                  <tr>
                                                      <td class="tgh" colspan="4" width="300"> Pengguna Anggaran<br><br><br><br><br><u><strong>{{ $skpd->pegawai->nama_karyawan }}</strong></u><br>{{ $skpd->pegawai->pangkat->nama }}<br> NIP. {{ $skpd->pegawai->nip }}</td>
                                                        <td  class="tgh" colspan="4" width="300">Pejabat Pelaksana<br>Teknis Kegiatan (PPTK)<br><br><br><br><u><strong>{{ $penugasan->anggaran->pptk->nama_karyawan }}</strong></u><br> NIP. {{ $penugasan->anggaran->pptk->nip }}</td>
                                    <td  class="tgh" colspan="4" width="300">Bendahara Pengeluaran<br><br><br><br><br><u><strong>{{ $skpd->bendahara->nama_karyawan }}</strong></u><br> NIP. {{ $skpd->bendahara->nip }}</td>
                                                  </tr></table><br><br><br>
                
            
            
        
    <!-- Container END -->

    </body><script>
  var canvas = document.getElementById('canvas1');
  var ctx    = canvas.getContext('2d');
  canvas.width  = canvas.scrollWidth;
  canvas.height  = canvas.scrollHeight;

  //jajargenjang
  ctx.beginPath();
  ctx.moveTo(0,40);
  ctx.lineTo(200,40);
  ctx.lineTo(250,0);
  ctx.lineTo(100,0);
  ctx.lineTo(80,10);
  ctx.lineTo(0,40);
  ctx.stroke();
  ctx.font = "12px Times New Roman";
  ctx.fillText("1.800.000", 130, 25);

  var canvas = document.getElementById('canvas2');
  var ctx    = canvas.getContext('2d');
  canvas.width  = canvas.scrollWidth;
  canvas.height  = canvas.scrollHeight;

  //jajargenjang
  ctx.beginPath();
  ctx.moveTo(0,40);
  ctx.lineTo(200,40);
  ctx.lineTo(250,0);
  ctx.lineTo(100,0);
  ctx.lineTo(80,10);
  ctx.lineTo(0,40);
  ctx.stroke();
  ctx.font = "12px Times New Roman";
  ctx.fillText("1.800.000", 130, 25);
  
 </script>