<?php

namespace App\Http\Controllers;
use App\Exports\Laporan;
use App\Models\jenisPengawasan;
use App\Models\Kegiatan;
use App\Models\Obrik;
use App\Models\Pegawai;
use App\Models\Penugasan;
use App\Models\Peran;
use App\Models\JadwalLain;
use App\Models\JadwalLibur;
use App\Models\suratTugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use Carbon\Carbon;
class LaporanController extends Controller
{
    //
    public function index()
    {
        $surat = suratTugas::all();
        // $penugasan = Penugasan::all();
        // $obrik = Obrik::all();
        // $jp    = jenisPengawasan::all();
        $kegiatan = Kegiatan::all();
        $filterbulan = '';
        return view('admin.laporanKegiatan',compact('surat','kegiatan','filterbulan'));
    }

    public function rekapLaporanKegiatan(Request $request)
    {

       $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

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

            // $pegawai = Pegawai::where('id',$request->id_karyawan)->first();

            // $surat = Penugasan::join('kegiatans','kegiatans.id','=','penugasans.id_anggaran')->get();

            $ks = Kegiatan::where('id',$request->id_anggaran)->first();

            $sheet->setCellValue('A1', "POS ANGGARAN  : ".$ks->kegiatan); // Set kolom A1 dengan tulisan "DATA SISWA"

              if($request->bulan=="01") {
            # code...
            $sheet->setCellValue('A2', "BULAN   Januari Tahun " .session('tahun')); // Set kolom A1 dengan tulisan "DATA SISWA"
              }elseif($request->bulan=="02") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Februari Tahun " .session('tahun'));
            }elseif($request->bulan=="03") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Maret    Tahun " .session('tahun'));
            }elseif($request->bulan=="04") {
            # code...
             $sheet->setCellValue('A2', "BULAN  April   Tahun " .session('tahun'));
            }elseif($request->bulan=="05") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Mei Tahun " .session('tahun'));
            }elseif($request->bulan=="06") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Juni Tahun " .session('tahun'));
            }elseif($request->bulan=="07") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Juli Tahun " .session('tahun'));
            }elseif($request->bulan=="08") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Agustus Tahun " .session('tahun'));
            }elseif($request->bulan=="09") {
            # code...
             $sheet->setCellValue('A2', "BULAN  September Tahun " .session('tahun'));
            }elseif($request->bulan=="10") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Oktober Tahun " .session('tahun'));
            }elseif($request->bulan=="11") {
            # code...
             $sheet->setCellValue('A2', "BULAN  November Tahun " .session('tahun'));
            }elseif($request->bulan=="12") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Desember Tahun " .session('tahun'));
            }



            $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->mergeCells('A2:E2'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->mergeCells('A3:E3'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->mergeCells('A4:E4'); // Set Merge Cell pada kolom A1 sampai F1

            $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
            $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1
            $sheet->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A5', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('B5', "No Rekening"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('C5', "Nama Pegawai"); // Set kolom C3 dengan tulisan "NAMA"
            $sheet->setCellValue('D5', "Penugasan"); // Set kolom E3 dengan tulisan "TELEPON"
            $sheet->setCellValue('E5', "Nominal"); // Set kolom F3 dengan tulisan "ALAMAT"
            // $sheet->setCellValue('F5', "Tanggal Penugasan"); // Set kolom F3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header

            $sheet->getStyle('A5')->applyFromArray($style_col);
            $sheet->getStyle('B5')->applyFromArray($style_col);
            $sheet->getStyle('C5')->applyFromArray($style_col);
            $sheet->getStyle('D5')->applyFromArray($style_col);
            $sheet->getStyle('E5')->applyFromArray($style_col);
            // $sheet->getStyle('F5')->applyFromArray($style_col);
            // Set height baris ke 1, 2 dan 3
            $sheet->getRowDimension('1')->setRowHeight(20);
            $sheet->getRowDimension('2')->setRowHeight(20);
            $sheet->getRowDimension('3')->setRowHeight(20);

            for( $i ='B'; $i <= 'E'; $i++ ) {
                $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(25);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }

            $surat = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->join('perans', 'perans.id', '=', 'surat_tugas.id_peran')->where('id_anggaran',$request->id_anggaran)->whereMonth('Tanggalsurat',$request->bulan)->whereYear('TanggalSurat',session('tahun'))->orderBy('pegawais.nama_karyawan','ASC')->select('surat_tugas.*')->get();

        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $row = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
            $total = 0;
                    foreach ($surat as $s) {
                        if ($s->perhitungan > 0) {
                            $sheet->setCellValue('A' .$row,$no);
                            $sheet->setCellValue('B' .$row,$s->pegawai->rekening);
                            $sheet->setCellValue('C' .$row,$s->pegawai->gelar_depan.' '.$s->pegawai->nama_karyawan.','.$s->pegawai->gelar);
                            $sheet->setCellValue('D' .$row,$s->surat->jenis->nama . " Pada " . $s->surat->obrik->nama);

                            $sheet->setCellValue('E' .$row,number_format($s->perhitungan));
                            $no++;
                            $row++;
                              $total += ($s->perhitungan);
                        }


                    }

                    $sheet->setCellValue('A4', "Total : Rp. " .number_format($total));

            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Penugasan Per Kegiatan");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Laporan Penugasan Per Kegiatan.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');


    }

    public function indexLaporan()
    {
        $surat = suratTugas::all();
        $penugasan = Penugasan::all();
        $pegawai = Pegawai::all();
        $peran = Peran::all();
        $filterbulan = '';
        $filtertahun = '';
        return view('admin.LaporanPegawai',compact('surat','penugasan','pegawai','filterbulan','filtertahun','peran'));
    }

     public function arsipCari(Request $request)
    {

        if($request->id_karyawan AND $request->bulan AND $request->tahun) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::where('id_karyawan','like','%'.$request->id_karyawan.'%')->whereMonth('ta','=',$request->bulan)->whereYear('ta','=',$request->tahun)->get();
        }elseif ($request->id_karyawan AND $request->bulan) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::where('id_karyawan','like','%'.$request->id_karyawan.'%')->whereMonth('ta','=',$request->bulan)->get();
        }elseif ($request->id_karyawan AND $request->tahun) {
            $surat = suratTugas::all();
            $obrik = Obrik::all();
            $jp    = jenisPengawasan::all();
            $penugasan = Penugasan::where('id_karyawan','like','%'.$request->id_karyawan.'%')->whereYear('ta','=',$request->tahun)->get();
        }

        $filterid_karyawan = $request->id_karyawan;
        $filterbulan = $request->bulan;
        $filtertahun = $request->tahun;


        return view('admin.arsip',compact('surat','penugasan','obrik','jp', 'filterid_karyawan','filterbulan','filtertahun'));
    }

    public function rekapSuratpegawai(Request $request)
    {

       $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

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

            $pegawai = Pegawai::where('id',$request->id_karyawan)->first();
                        $peran = Peran::where('id',$request->id_peran)->first();

            $sheet->setCellValue('A1', "NAMA PEGAWAI    : ".$pegawai->nama_karyawan); // Set kolom A1 dengan tulisan "DATA SISWA"

            $sheet->setCellValue('A3', "PERAN PEGAWAI    : ".$peran->nama); // Set kolom A1 dengan tulisan "DATA SISWA"

              if($request->bulan=="01") {
            # code...
            $sheet->setCellValue('A2', "BULAN   Januari Tahun " .session('tahun')); // Set kolom A1 dengan tulisan "DATA SISWA"
              }elseif($request->bulan=="02") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Februari Tahun " .session('tahun'));
            }elseif($request->bulan=="03") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Maret    Tahun " .session('tahun'));
            }elseif($request->bulan=="04") {
            # code...
             $sheet->setCellValue('A2', "BULAN  April   Tahun " .session('tahun'));
            }elseif($request->bulan=="05") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Mei Tahun " .session('tahun'));
            }elseif($request->bulan=="06") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Juni Tahun " .session('tahun'));
            }elseif($request->bulan=="07") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Juli Tahun " .session('tahun'));
            }elseif($request->bulan=="08") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Agustus Tahun " .session('tahun'));
            }elseif($request->bulan=="09") {
            # code...
             $sheet->setCellValue('A2', "BULAN  September Tahun " .session('tahun'));
            }elseif($request->bulan=="10") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Oktober Tahun " .session('tahun'));
            }elseif($request->bulan=="11") {
            # code...
             $sheet->setCellValue('A2', "BULAN  November Tahun " .session('tahun'));
            }elseif($request->bulan=="12") {
            # code...
             $sheet->setCellValue('A2', "BULAN  Desember Tahun " .session('tahun'));
            }


            $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai F1
            $sheet->mergeCells('A2:F2'); // Set Merge Cell pada kolom A1 sampai F1
            $sheet->mergeCells('A3:F3'); // Set Merge Cell pada kolom A1 sampai F1
            $sheet->mergeCells('A4:F4'); // Set Merge Cell pada kolom A1 sampai F1
              $sheet->mergeCells('A5:F5'); // Set Merge Cell pada kolom A1 sampai F1

            $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
            $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
               $sheet->getStyle('A3')->getFont()->setBold(true); // Set bold kolom A3
            $sheet->getStyle('A3')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1
            $sheet->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
              $sheet->getStyle('A3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A6', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('B6', "NO REKENING"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('C6', "NAMA PEGAWAI"); // Set kolom C3 dengan tulisan "NAMA"
            $sheet->setCellValue('D6', "Penugasan"); // Set kolom E3 dengan tulisan "TELEPON"
            $sheet->setCellValue('E6', "Nominal"); // Set kolom F3 dengan tulisan "ALAMAT"
            $sheet->setCellValue('F6', "Tanggal Penugasan"); // Set kolom F3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header

            $sheet->getStyle('A6')->applyFromArray($style_col);
            $sheet->getStyle('B6')->applyFromArray($style_col);
            $sheet->getStyle('C6')->applyFromArray($style_col);
            $sheet->getStyle('D6')->applyFromArray($style_col);
            $sheet->getStyle('E6')->applyFromArray($style_col);
            $sheet->getStyle('F6')->applyFromArray($style_col);
            // Set height baris ke 1, 2 dan 3
            $sheet->getRowDimension('1')->setRowHeight(20);
            $sheet->getRowDimension('2')->setRowHeight(20);
            $sheet->getRowDimension('3')->setRowHeight(20);

            for( $i ='B'; $i <= 'F'; $i++ ) {
                $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(25);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }

            $surat = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->where('id_karyawan',$request->id_karyawan)->whereMonth('Tanggalsurat',$request->bulan)->where('id_peran',$request->id_peran)->whereYear('TanggalSurat',session('tahun'))->select('surat_tugas.*')->get();

            $no = 1; // Untuk penomoran tabel, di awal set dengan 1
            $row = 7; // Set baris pertama untuk isi tabel adalah baris ke 4
            $total = 0;
            foreach ($surat as $s) {
                $sheet->setCellValue('A' .$row,$no);
                        $sheet->setCellValue('B' .$row,$s->pegawai->rekening);
                        $sheet->setCellValue('C' .$row,$s->pegawai->gelar_depan.' '.$s->pegawai->nama_karyawan.','.$s->pegawai->gelar);
                        $sheet->setCellValue('D' .$row,$s->surat->jenis->nama . " Pada " . $s->surat->obrik->nama);
                        $sheet->setCellValue('E' .$row,number_format($s->perhitungan));

                      if(date('m',strtotime($s->Tanggalsurat)) == date('m',strtotime($s->TanggalAkhir)) ) {
                            # code...
                            $sheet->setCellValue('F' . $row, date("d", strtotime($s->Tanggalsurat)) .' s/d '. Carbon::parse($s->TanggalAkhir)->translatedFormat('d F Y')  );
                    }else{
                        # code...
                        $sheet->setCellValue('F' . $row, Carbon::parse($s->Tanggalsurat)->translatedFormat('d F')  .' s/d '. Carbon::parse($s->TanggalAkhir)->translatedFormat('d F Y')   );
                    }
                        $no++;
                        $row++;
                        # code...
                          $total += ($s->perhitungan);
                        }
                        $sheet->setCellValue('A4', "Total : Rp. "  .number_format($total)  ); // Set kolom A8 dengan tulisan "DATA SISWA"


            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Penugasan Per Pegawai");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Laporan Penugasan Per Pegawai.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');


    }

    public function indexPDF()
    {
         $surat = suratTugas::all();
         $kegiatan = Kegiatan::all();
         $filterbulan = '';
        return view('admin.LaporanKegiatanPDF',compact('surat','kegiatan','filterbulan'));
    }

    public function rekapLaporanKegiatanPDF(Request $request)
    {
          $ks    = Kegiatan::where('id',$request->id_anggaran)->first();
          $bulan =  $request->bulan;
          $surat = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->join('perans', 'perans.id', '=', 'surat_tugas.id_peran')->where('id_anggaran',$request->id_anggaran)->whereMonth('Tanggalsurat',$request->bulan)->whereYear('TanggalSurat',session('tahun'))->orderBy('surat_tugas.id_penugasan','ASC')->orderBy('perans.id','ASC')->select('surat_tugas.*')->get();

          return view('admin.Laporan_KegiatanPDF',compact('ks','surat','bulan'));

    }

     public function indexLaporanPDF()
    {
        $surat = suratTugas::all();
        $penugasan = Penugasan::all();
        $pegawai = Pegawai::all();
        $peran = Peran::all();
        $filterbulan = '';
        // $penugasan = Penugasan::all();
        return view('admin.LaporanPegawaiPDF',compact('surat','penugasan','pegawai','filterbulan','peran'));
    }

    public function rekapSuratpegawaiPDF(Request $request)
    {
        $pegawai = Pegawai::where('id',$request->id_karyawan)->first();
        $peran = Peran::where('id',$request->id_peran)->first();
        $bulan =  $request->bulan;
          $surat = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->where('id_karyawan',$request->id_karyawan)->whereMonth('Tanggalsurat',$request->bulan)->where('id_peran',$request->id_peran)->whereYear('TanggalSurat',session('tahun'))->select('surat_tugas.*')->get();

          return view('admin.Laporan_PegawaiPDF',compact('pegawai','peran','surat','bulan'));
    }

     public function rekapLaporanMonev(Request $request)
    {

       $spreadsheet = new Spreadsheet();
        $sheet       = $spreadsheet->getActiveSheet();

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

            // $pegawai = Pegawai::where('id',$request->id_karyawan)->first();

            // $surat = Penugasan::join('kegiatans','kegiatans.id','=','penugasans.id_anggaran')->get();

            $ks = Kegiatan::where('id',$request->id_anggaran)->first();

            $sheet->setCellValue('A1', "Rekapitulasi Pemeriksaan Inspektorat Daerah Tahun ". session('tahun'));
            $sheet->setCellValue('A2', "POS ANGGARAN  : ".$ks->kegiatan); // Set kolom A1 dengan tulisan "DATA SISWA"

            $sheet->mergeCells('A1:H1'); // Set Merge Cell pada kolom A1 sampai E1
            $sheet->mergeCells('A2:H2'); // Set Merge Cell pada kolom A1 sampai E1

            $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
            $sheet->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $sheet->getStyle('A2')->getFont()->setBold(true); // Set bold kolom A1
            $sheet->getStyle('A2')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
            $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            // Buat header tabel nya pada baris ke 3
            $sheet->setCellValue('A5', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('B5', "No Rekening"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('C5', "Nama Pegawai"); // Set kolom C3 dengan tulisan "NAMA"
            $sheet->setCellValue('D5', "Penugasan"); // Set kolom E3 dengan tulisan "TELEPON"
            $sheet->setCellValue('E5', "Nominal"); // Set kolom F3 dengan tulisan "ALAMAT"
            $sheet->setCellValue('F5', "NO"); // Set kolom A3 dengan tulisan "NO"
            $sheet->setCellValue('G5', "No Rekening"); // Set kolom B3 dengan tulisan "NIS"
            $sheet->setCellValue('H5', "Nama Pegawai"); // Set kolom C3 dengan tulisan "NAMA"
            // $sheet->setCellValue('F5', "Tanggal Penugasan"); // Set kolom F3 dengan tulisan "ALAMAT"
            // Apply style header yang telah kita buat tadi ke masing-masing kolom header

            $sheet->getStyle('A5')->applyFromArray($style_col);
            $sheet->getStyle('B5')->applyFromArray($style_col);
            $sheet->getStyle('C5')->applyFromArray($style_col);
            $sheet->getStyle('D5')->applyFromArray($style_col);
            $sheet->getStyle('E5')->applyFromArray($style_col);
            // $sheet->getStyle('F5')->applyFromArray($style_col);
            // Set height baris ke 1, 2 dan 3
            $sheet->getRowDimension('1')->setRowHeight(20);
            $sheet->getRowDimension('2')->setRowHeight(20);
            $sheet->getRowDimension('3')->setRowHeight(20);

            for( $i ='B'; $i <= 'E'; $i++ ) {
                $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(25);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
                $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
            }

        //     $surat = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->join('perans', 'perans.id', '=', 'surat_tugas.id_peran')->where('id_anggaran',$request->id_anggaran)->whereMonth('Tanggalsurat',$request->bulan)->whereYear('TanggalSurat',session('tahun'))->orderBy('pegawais.nama_karyawan','ASC')->select('surat_tugas.*')->get();

        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        //     $row = 6; // Set baris pertama untuk isi tabel adalah baris ke 4
        //     $total = 0;
        //             foreach ($surat as $s) {
        //                 if ($s->perhitungan > 0) {
        //                     $sheet->setCellValue('A' .$row,$no);
        //                     $sheet->setCellValue('B' .$row,$s->pegawai->rekening);
        //                     $sheet->setCellValue('C' .$row,$s->pegawai->gelar_depan.' '.$s->pegawai->nama_karyawan.','.$s->pegawai->gelar);
        //                     $sheet->setCellValue('D' .$row,$s->surat->jenis->nama . " Pada " . $s->surat->obrik->nama);

        //                     $sheet->setCellValue('E' .$row,number_format($s->perhitungan));
        //                     $no++;
        //                     $row++;
        //                       $total += ($s->perhitungan);
        //                 }


        //             }

        //             $sheet->setCellValue('A4', "Total : Rp. " .number_format($total));

            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Penugasan Per Kegiatan");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Laporan Penugasan Per Kegiatan.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');


    }

    public function rkpd()
    {
        $surat = suratTugas::all();
        // $penugasan = Penugasan::all();
        // $obrik = Obrik::all();
        // $jp    = jenisPengawasan::all();
        $kegiatan = Kegiatan::all();
        $filterbulan = '';
        return view('admin.rincianrkpd',compact('surat','kegiatan','filterbulan'));
    }

}
