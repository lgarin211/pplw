<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Tahun;
use App\Models\Pegawai;
use App\Models\Kegiatan;
use App\Models\Penugasan;
use App\Models\JadwalLain;
use App\Models\suratTugas;
use App\Models\JadwalLibur;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class KendaliController extends Controller
{
    //
      public function index(?string $bulan = null)
    {
        $bulan = $bulan ?$bulan:date('m');

        $month = '';
        $filterbulan = '';
           $filtertahun = '';
           $jadwalLibur = [];


          $surat = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
          $tanggal=array();
          $month = date('m');
          $year = date('Y');

          for($d=1; $d<=31; $d++)
          {
              $time=mktime(12, 0, 0, $month, $d, $year);
              if (date('m', $time)==$month)
                  $tanggal[]=date('Y-m-d', $time);
                  $t = date('Y-m-d', $time);
                   $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();

                   if ($libur > 0) {
                    # code...
                    $jadwalLibur[$t] = '';
                   }

          }






          foreach ($surat as $key1 => $s) {
            # code...
            foreach ($tanggal as $key2 => $t) {
              # code...
              $suratTugas = suratTugas::where('id_karyawan','=',$s->id)->whereDate('ta','<=', $t)->whereDate('tp','>=', $t)->count();
              $jadwal      = JadwalLain::where('id_pegawai','=',$s->id)->whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->get();

              // print_r($suratTugas1);
              if ($suratTugas > 0) {
                # code...
                $keterangan[$s->id][$t] = 'ada';
              }elseif (count($jadwal) > 0) {
                # code...
                $keterangan[$s->id][$t] = '';
                foreach ($jadwal as $key => $value) {
                  # code...
                  $keterangan[$s->id][$t] .= $value->keterangan    ;
                  if ( $key < (count($jadwal)-1))   {
                  $keterangan[$s->id][$t] .= ', '    ;
                    # code...

                  }

                }
              }else {
                # code...
                $keterangan[$s->id][$t] = '';
              }
            }
          }

        //   echo "<pre>";
        //   print_r($jadwalLibur);
        //   echo "</pre>";
        //   exit();







            return view('admin.kendali',compact('month','surat','tanggal','keterangan','filterbulan','filtertahun','jadwalLibur'));

    }

     public function Cari(Request $request)
    {

        $jadwalLibur = [];
        $month = '';


          $surat = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
          $tanggal=array();
          $month = $request->input('bulan');

          $year = session('tahun');

          for($d=1; $d<=31; $d++)
          {
            $time=mktime(12, 0, 0, $month, $d, $year);
            if (date('m', $time)==$month)
                $tanggal[]=date('Y-m-d', $time);
                $t = date('Y-m-d', $time);
                 $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();

                 if ($libur > 0) {
                  # code...
                  $jadwalLibur[$t] = '';
                 }
            }

            foreach ($surat as $key1 => $s) {
                # code...
                foreach ($tanggal as $key2 => $t) {
              # code...
              $suratTugas1 = suratTugas::where('id_karyawan','=',$s->id)->whereDate('ta','<=', $t)->whereDate('tp','>=', $t)->count();
              $jadwal      = JadwalLain::where('id_pegawai','=',$s->id)->whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();
              // print_r($suratTugas1);
            if ($jadwal > 0) {
              # code...
              $keterangan[$s->id][$t] = 'DL';
            }elseif ($suratTugas1 > 0) {
                # code...
                $keterangan[$s->id][$t] = 'ada';
            }elseif (($suratTugas1 > 0) AND (date('D',strtotime($t)) == 'Sat') AND (date('D',strtotime($t)) == 'Sun')) {
                $keterangan[$s->id][$t] = '';
            }
              else {
                # code...
                $keterangan[$s->id][$t] = '';
              }
            }
          }

          $arrayBulan =  array(
            '01'  =>  'Januari',
            '02'  =>  'Februari',
            '03'  =>  'Maret',
            '04'  =>  'April',
            '05'  =>  'Mei',
            '06'  =>  'Juni',
            '07'  =>  'Juli',
            '08'  =>  'Agustus',
            '09'  =>  'September',
            '10' =>   'Oktober',
            '11' =>   'November',
            '12' =>   'Desember'
    );


    $filterbulan = $arrayBulan[$request->input('bulan')];

    $filtertahun = $request->input('tahun');


      return view('admin.kendali',compact('month','surat','tanggal','keterangan','filterbulan','filtertahun','jadwalLibur'));

    }

    public function jadwalLain()
    {
        $jd = JadwalLain::all();
        $pegawai = Pegawai::all();
        return view('admin.jadwalLain',compact('jd','pegawai'));
    }

    public function jadwalLaincreate()
    {
       $pegawai = Pegawai::all();
       return view('admin.jadwalLain_create',compact('pegawai'));
    }
    public function store(Request $request)
    {
        // dd($request->all());

        $jadwal = jadwalLain::create([
            'id_pegawai'     => $request->input('id_pegawai'),
            'tanggalawal'     => $request->input('tanggalawal'),
            'tanggalakhir'   => $request->input('tanggalakhir'),
            'keterangan'   => $request->input('keterangan')
        ]);

        $tanggalawal  = $jadwal->tanggalawal;
        $tanggalakhir = $jadwal->tanggalakhir;
        $id_karyawan  = $jadwal->id_pegawai;

        $tglBaru = suratTugas::where('id_karyawan',$id_karyawan)->where(function ($query) use ($tanggalawal,$tanggalakhir) {
            $query->whereRaw("'$tanggalawal' BETWEEN ta AND tp")->orWhereRaw("'$tanggalakhir' BETWEEN ta AND tp");
        })->first();

        if ($tglBaru) {
            # code...
            $tanggalawalBaru = Carbon::parse($tanggalawal)->between($tglBaru->ta,$tglBaru->tp);
            $tanggalakhirBaru = Carbon::parse($tanggalakhir)->between($tglBaru->ta,$tglBaru->tp);
            if ($tanggalawalBaru AND $tanggalakhirBaru) {
                if (Carbon::parse($tglBaru->tp)->gt($tanggalakhir)) {
                    # code...

                    }else {
                        $tglBaru->update([
                            'tp' => Carbon::parse($tanggalakhir)->subDay()->format('Y-m-d')
                        ]);
                    }
            }elseif ($tanggalawalBaru) {
                # code...
                 $tglBaru->update([
                     'ta' => Carbon::parse($tanggalawal)->subDay()->format('Y-m-d')
                 ]);
        }else {

        }




    }






        return redirect('jadwal_lain')->with('success','Data berhasil di simpan');

    }
    public function hapus($id)
    {
        $kegiatan = JadwalLain::where('id',$id)->first();
        $kegiatan->delete();

        return redirect('jadwal_lain')->with('danger','Data berhasil di Hapus');

    }

    public function jadwalLibur()
    {
      $jl = JadwalLibur::all();
      return view('admin.jadwalLibur',compact('jl'));
    }

    public function jadwalLiburcreate()
    {
       $pegawai = Pegawai::all();
       return view('admin.jadwalLibur_create',compact('pegawai'));
    }
     public function storeLibur(Request $request)
    {
        // dd($request->all());
        $reg = new JadwalLibur();
        $reg->tanggalawal  = $request->input('tanggalawal');
        $reg->tanggalakhir = $request->input('tanggalakhir');
        $reg->keterangan = $request->input('keterangan');
        $reg->save();



        return redirect('jadwal_libur')->with('success','Data berhasil di simpan');

    }

    public function hapusLibur($id)
    {
        $Libur = JadwalLibur::where('id',$id)->first();
        $Libur->delete();

        return redirect('jadwal_libur')->with('warning','Data berhasil di Hapus');
    }

    // public function cetakKendali(Request $request)
    // {
    //     $month = '';
    //     $filterbulan = '';
    //        $filtertahun = '';
    //        $jadwalLibur = [];


    //       $th = Tahun::all();
    //       $surat = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
    //       $tanggal=array();
    //       $month = date('m','08');
    //       $year = date('Y');

    //       for($d=1; $d<=31; $d++)
    //       {
    //           $time=mktime(12, 0, 0, $month, $d, $year);
    //           if (date('m', $time)==$month)
    //               $tanggal[]=date('Y-m-d', $time);
    //               $t = date('Y-m-d', $time);
    //                $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();

    //                if ($libur > 0) {
    //                 # code...
    //                 $jadwalLibur[$t] = '';
    //                }

    //       }






    //       foreach ($surat as $key1 => $s) {
    //         # code...
    //         foreach ($tanggal as $key2 => $t) {
    //           # code...
    //           $suratTugas = suratTugas::where('id_karyawan','=',$s->id)->whereDate('ta','<=', $t)->whereDate('tp','>=', $t)->count();
    //           $jadwal      = JadwalLain::where('id_pegawai','=',$s->id)->whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->get();

    //           // print_r($suratTugas1);
    //           if ($suratTugas > 0) {
    //             # code...
    //             $keterangan[$s->id][$t] = 'ada';
    //           }elseif (count($jadwal) > 0) {
    //             # code...
    //             $keterangan[$s->id][$t] = '';
    //             foreach ($jadwal as $key => $value) {
    //               # code...
    //               $keterangan[$s->id][$t] .= $value->keterangan    ;
    //               if ( $key < (count($jadwal)-1))   {
    //               $keterangan[$s->id][$t] .= ', '    ;
    //                 # code...

    //               }

    //             }
    //           }
    //         }
    //       }

    //     //   echo "<pre>";
    //     //   print_r($jadwalLibur);
    //     //   echo "</pre>";
    //     //   exit();







    //         return view('admin.cetakKendali',compact('th','month','surat','tanggal','keterangan','filterbulan','filtertahun','jadwalLibur'));

    //     }

    public function cetakKendali(Request $request, $bulan)
    {
        // $bulan = date('m');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $baris = 1;

        $sheet->setCellValue('A'.intval($baris), "CETAK KENDALI");
        if($request->bulan=="01") {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN   Januari Tahun " .session('tahun')); // Set kolom A1 dengan tulisan "DATA SISWA"
              }elseif($request->bulan=="02") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Februari Tahun " .session('tahun'));
            }elseif($request->bulan=="03") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Maret    Tahun " .session('tahun'));
            }elseif($request->bulan=="04") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  April   Tahun " .session('tahun'));
            }elseif($request->bulan=="05") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Mei Tahun " .session('tahun'));
            }elseif($request->bulan=="06") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Juni Tahun " .session('tahun'));
            }elseif($request->bulan=="07") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Juli Tahun " .session('tahun'));
            }elseif($request->bulan=="08") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Agustus Tahun " .session('tahun'));
            }elseif($request->bulan=="09") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  September Tahun " .session('tahun'));
            }elseif($request->bulan=="10") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Oktober Tahun " .session('tahun'));
            }elseif($request->bulan=="11") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  November Tahun " .session('tahun'));
            }elseif($request->bulan=="12") {
            # code...
             $sheet->setCellValue('A'.intval($baris+1), "BULAN  Desember Tahun " .session('tahun'));
            }

            $sheet->setCellValue('A4', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('B4', "NAMA PEGAWAI"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('C4', "TANGGAL PEMERIKSAAN"); // Set kolom C3 dengan tulisan "NAMA"

            $sheet->setCellValue('A'.intval($baris+3), "NO");
            $sheet->setCellValue('B'.intval($baris+3), "NAMA PEGAWAI");
            $sheet->setCellValue('C'.intval($baris+3), "Tanggal Pemeriksaan");

            $sheet->mergeCells('A'.intval($baris).':F'.intval($baris));
            $sheet->mergeCells('A'.intval($baris+1).':F'.intval($baris+1));

            $sheet->mergeCells('A'.intval($baris+3).':A'.intval($baris+4));
            $sheet->mergeCells('B'.intval($baris+3).':B'.intval($baris+4));



            $sheet->getStyle('A'.intval($baris+1))->getFont()->setBold(true);
            $sheet->getStyle('A'.intval($baris))->getFont()->setBold(true);
            $sheet->getStyle('A'.intval($baris))->getFont()->setSize(15);
            // Set font size 15 untuk kolom A1
            $sheet->getStyle('A'.intval($baris+1))->getFont()->setSize(15);
            // Set bold kolom A1
            $sheet->getStyle('A'.intval($baris))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A'.intval($baris+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A'.intval($baris+3))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


            $sheet->getStyle('B'.intval($baris+3))->getAlignment()->setWrapText(true);

            $sheet->getColumnDimension('B')->setWidth(35);

            $sheet->getStyle('A4')->applyFromArray($style_col);
            $sheet->getStyle('A5')->applyFromArray($style_col);
            $sheet->getStyle('B4')->applyFromArray($style_col);
            $sheet->getStyle('B5')->applyFromArray($style_col);
            $sheet->getStyle('C4')->applyFromArray($style_col);
            // $sheet->getStyle('C4')->applyFromArray($style_col);
            // $sheet->getStyle('C5')->applyFromArray($style_col);
            // $sheet->getStyle('D6')->applyFromArray($style_col);
            // $sheet->getStyle('E6')->applyFromArray($style_col);
            // $sheet->getStyle('F6')->applyFromArray($style_col);


            $sheet->getRowDimension(intval($baris))->setRowHeight(20);
            $sheet->getRowDimension(intval($baris+1))->setRowHeight(20);
            $sheet->getRowDimension(intval($baris+2))->setRowHeight(20);

            $tanggal=array();
            $month = $bulan;
            $year = date('Y');

            for($d=1; $d<=31; $d++)
            {
                $time=mktime(12, 0, 0, $month, $d, $year);
                if (date('m', $time)==$month)
                    $tanggal[]=date('Y-m-d', $time);
                    $t = date('Y-m-d', $time);
                     $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();

            }

            $pegawai = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();

            $row = $baris+5;
            $no = 1;

            foreach ($pegawai as $pg) {
                # code...
                $sheet->setCellValue('A' . $row, $no);
                $sheet->setCellValue('B' . $row,$pg->nama_karyawan);
                $kolom = 'B';
                foreach ($tanggal as $t) {
                    $kolom++;
                    if (Carbon::parse($t)->format('D')=='Sat') {
                        $sheet->getStyle($kolom.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
                        continue;
                    } elseif (Carbon::parse($t)->format('D')=='Sun') {
                        $sheet->getStyle($kolom.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FF0000');
                        continue;
                    }
                    $libur = JadwalLibur::whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->count();
                    if ($libur > 0) {
                        $sheet->getStyle($kolom.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
                        continue;
                    }
                    $suratTugas = suratTugas::where('id_karyawan','=',$pg->id)->whereDate('ta','<=', $t)->whereDate('tp','>=', $t)->count();
                    $jadwal     = JadwalLain::where('id_pegawai','=',$pg->id)->whereDate('tanggalawal','<=', $t)->whereDate('tanggalakhir','>=', $t)->get();

                 // print_r($suratTugas1);
                    if ($suratTugas > 0) {
                        $sheet->setCellValue($kolom . $row,'ada');
                    }elseif (count($jadwal) > 0) {
                        $sheet->setCellValue($kolom . $row,'DL');
                    }

              }

                $no++;
                $row++;
              }

            $row1 = $baris+4;
            $alfa = 'C';
            foreach ($tanggal as $t) {
                $sheet->setCellValue($alfa. $row1,Carbon::parse($t)->format('d'));
                $alfa++;
                $sheet->getStyle($alfa.$row1)->applyFromArray($style_col);
            }

            $sheet->mergeCells('C4:'.$sheet->getHighestColumn($baris+4).'4');




                    //     foreach ($penugasan as $p) {


                    //         $sheet->setCellValue('C' . $row, $p->jenis->nama);

                    // }


                // Set Merge Cell pada kolom A1 sampai F1
                // $sheet->mergeCells('A'.($row).':E'.$row);
                // $sheet->getStyle('A'.($row).':E'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
                // $sheet->getStyle('A'.($row).':G'.$row)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000'));

                $baris += ($no+5);


        // Set orientasi kertas jadi LANDSCAPE
              $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
              // Set judul file excel nya
              $sheet->setTitle("Laporan Rekap Perjalanan Dinas");
              // Proses file excel
              header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
              header('Content-Disposition: attachment; filename="Laporan Cetak Kendali.xlsx"'); // Set nama file excel nya
              header('Cache-Control: max-age=0');
              $writer = new Xlsx($spreadsheet);
              $writer->save('php://output');
    }
    // public function cetakkendali()
    // {
    //     $spreadsheet = new Spreadsheet();
    //     $sheet       = $spreadsheet->getActiveSheet();

    //      // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    //         $style_col = [
    //             'font' => ['bold' => true], // Set font nya jadi bold
    //             'alignment' => [
    //                 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
    //                 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    //             ],
    //             'borders' => [
    //                 'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
    //                 'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
    //                 'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
    //                 'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    //             ]
    //         ];
    //         // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    //         $style_row = [
    //             'alignment' => [
    //                 'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    //             ],
    //             'borders' => [
    //                 'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
    //                 'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
    //                 'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
    //                 'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
    //             ]
    //         ];

    //         // $pegawai = Pegawai::where('id',$request->id_karyawan)->first();

    //         // $surat = Penugasan::join('kegiatans','kegiatans.id','=','penugasans.id_anggaran')->get();

    //         $ks = Kegiatan::where('id',$request->id_anggaran)->first();

    //         $sheet->setCellValue('A1', "POS ANGGARAN   ".$ks->kegiatan); // Set kolom A1 dengan tulisan "DATA SISWA"

    //           if($request->bulan=="01") {
    //         # code...
    //         $sheet->setCellValue('A2', "BULAN   Januari Tahun " .session('tahun')); // Set kolom A1 dengan tulisan "DATA SISWA"
    //           }elseif($request->bulan=="02") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Februari Tahun " .session('tahun'));
    //         }elseif($request->bulan=="03") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Maret    Tahun " .session('tahun'));
    //         }elseif($request->bulan=="04") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  April   Tahun " .session('tahun'));
    //         }elseif($request->bulan=="05") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Mei Tahun " .session('tahun'));
    //         }elseif($request->bulan=="06") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Juni Tahun " .session('tahun'));
    //         }elseif($request->bulan=="07") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Juli Tahun " .session('tahun'));
    //         }elseif($request->bulan=="08") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Agustus Tahun " .session('tahun'));
    //         }elseif($request->bulan=="09") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  September Tahun " .session('tahun'));
    //         }elseif($request->bulan=="10") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Oktober Tahun " .session('tahun'));
    //         }elseif($request->bulan=="11") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  November Tahun " .session('tahun'));
    //         }elseif($request->bulan=="12") {
    //         # code...
    //          $sheet->setCellValue('A2', "BULAN  Desember Tahun " .session('tahun'));
    //         }



    //         $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
    //         $sheet->mergeCells('A2:F2'); // Set Merge Cell pada kolom A1 sampai F1
    //         $sheet->mergeCells('A3:F3'); // Set Merge Cell pada kolom A1 sampai F1
    //         $sheet->mergeCells('A4:F4'); // Set Merge Cell pada kolom A1 sampai F1

    //         $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
    //         $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    //         $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1
    //         $sheet->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    //         $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    //         $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    //         // Buat header tabel nya pada baris ke 3
    //         $sheet->setCellValue('A5', "NO"); // Set kolom A3 dengan tulisan "NO"
    //         $sheet->setCellValue('B5', "No Rekening"); // Set kolom B3 dengan tulisan "NIS"
    //         $sheet->setCellValue('C5', "Nama Pegawai"); // Set kolom C3 dengan tulisan "NAMA"
    //         $sheet->setCellValue('D5', "Penugasan"); // Set kolom E3 dengan tulisan "TELEPON"
    //         $sheet->setCellValue('E5', "Nominal"); // Set kolom F3 dengan tulisan "ALAMAT"
    //         $sheet->setCellValue('F5', "Tanggal Penugasan"); // Set kolom F3 dengan tulisan "ALAMAT"
    //         // Apply style header yang telah kita buat tadi ke masing-masing kolom header

    //         $sheet->getStyle('A5')->applyFromArray($style_col);
    //         $sheet->getStyle('B5')->applyFromArray($style_col);
    //         $sheet->getStyle('C5')->applyFromArray($style_col);
    //         $sheet->getStyle('D5')->applyFromArray($style_col);
    //         $sheet->getStyle('E5')->applyFromArray($style_col);
    //         $sheet->getStyle('F5')->applyFromArray($style_col);
    //         // Set height baris ke 1, 2 dan 3
    //         $sheet->getRowDimension('1')->setRowHeight(20);
    //         $sheet->getRowDimension('2')->setRowHeight(20);
    //         $sheet->getRowDimension('3')->setRowHeight(20);

    //         for( $i ='B'; $i <= 'F'; $i++ ) {
    //             $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(25);
    //             $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
    //             $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    //             $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    //         }

    //     $surat = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->where('id_anggaran',$request->id_anggaran)->whereMonth('Tanggalsurat',$request->bulan)->whereYear('TanggalSurat',session('tahun'))->orderBy('nama_karyawan','ASC')->get();



    //     $no = 1; // Untuk penomoran tabel, di awal set dengan 1
    //         $row = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
    //         $total = 0;
    //                 foreach ($surat as $s) {
    //                     $sheet->setCellValue('A' .$row,$no);
    //                     $sheet->setCellValue('B' .$row,$s->pegawai->rekening);
    //                     $sheet->setCellValue('C' .$row,$s->pegawai->gelar_depan.' '.$s->pegawai->nama_karyawan.','.$s->pegawai->gelar);
    //                     $sheet->setCellValue('D' .$row,$s->surat->jenis->nama . " Pada " . $s->surat->obrik->nama);

    //                     $sekarang = strtotime($s->ta);
    //                     $akhir = strtotime($s->tp);
    //                     $idsurat = $s->id;
    //                     $idpegawai = $s->id_karyawan;
    //                     $pengurangan[$idsurat] = 0;
    //                         // Loop between timestamps, 24 hours at a time
    //                         for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
    //                           if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
    //                               $pengurangan[$idsurat] += 1;
    //                           }
    //                           //mengambil data jadwal lain
    //                           $tanggali = date("Y-m-d",$i);
    //                           $jadwal = Jadwallain::where('id_pegawai','=',$idpegawai)->where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
    //                           if ($jadwal > 0 ) {
    //                             # code...
    //                             $pengurangan[$idsurat] += 1;
    //                           }
    //                           $jadwalLibur = JadwalLibur::where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
    //                           if ($jadwalLibur > 0) {
    //                             # code...
    //                             $pengurangan[$idsurat] += 1;
    //                           }
    //                           //mengambil data jadwal libur
    //                         }


    //                         if (isset($pengurangan[$idsurat])) {
    //                             # code...
    //                             $totalpengurangan = $pengurangan[$idsurat];
    //                         } else {
    //                             # code...
    //                             $totalpengurangan = 0;
    //                         }

    //                         $sampai = $akhir; // or your date as well
    //                         $dari = $sekarang;
    //                         $datediff = $sampai - $dari;

    //                         if (empty($sampai)) {
    //                             $jumlahHari = 0;
    //                         } else {
    //                             $jumlahHari =  round($datediff / (60 * 60 * 24))+1 - $totalpengurangan;
    //                         }
    //                     $sheet->setCellValue('E' .$row,number_format($jumlahHari  *  $s->peran->tarif));
    //                     if(date('m',strtotime($s->Tanggalsurat)) == date('m',strtotime($s->TanggalAkhir)) ) {
    //                         # code...
    //                         $sheet->setCellValue('F' . $row, date("d", strtotime($s->Tanggalsurat)) .' s/d '. Carbon::parse($s->TanggalAkhir)->translatedFormat('d F Y')  );
    //                 }else{
    //                     # code...
    //                     $sheet->setCellValue('F' . $row, Carbon::parse($s->Tanggalsurat)->translatedFormat('d F')  .' s/d '. Carbon::parse($s->TanggalAkhir)->translatedFormat('d F Y')   );
    //                 }
    //                     $no++;
    //                     $row++;
    //                       $total += ($jumlahHari  *  $s->peran->tarif);
    //                     # code...
    //                 }

    //                 $sheet->setCellValue('A4', "Total : Rp. " .number_format($total));

    //                 // Set kolom A8 dengan tulisan "DATA SISWA"
    //         //         // Ambil semua data dari hasil eksekusi $sql
    //         // // // Set width kolom

    //             # code...
    //             // $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
    //             // $sheet->getColumnDimension('B')->setWidth(15); // Set width kolom B
    //             // $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
    //             // $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
    //             // $sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
    //             // $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom F

    //         // Set orientasi kertas jadi LANDSCAPE
    //         $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    //         // Set judul file excel nya
    //         $sheet->setTitle("Laporan Penugasan Per Kegiatan");
    //         // Proses file excel
    //         header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //         header('Content-Disposition: attachment; filename="Laporan Penugasan Per Kegiatan.xlsx"'); // Set nama file excel nya
    //         header('Cache-Control: max-age=0');
    //         $writer = new Xlsx($spreadsheet);
    //         $writer->save('php://output');


    // }

}


