<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Peran;
use App\Models\Pegawai;
use App\Models\Kegiatan;
use App\Models\Penugasan;
use App\Models\JadwalLain;
use App\Models\suratTugas;
use App\Models\JadwalLibur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;


class RekapController extends Controller
{
    //
    public function index()
    {
        return view('admin.rekap');
    }

    public function rekapPerjalanan()
    {

 $spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->setActiveSheetIndex(0);
$sheet->setTitle("Rekap Penugasan");

$kegiatan = Kegiatan::all();

foreach ($kegiatan as $kegiatanNama) {
    # code...
    if ($kegiatanNama->kegiatan=="Pengawasan Kinerja Pemerintah Daerah") {
        # code...
        $spreadsheet->createSheet()->setTitle("Pengawasan Kinerja PD");
        $sheet1 = $spreadsheet->setActiveSheetIndex(1);
        $spreadsheet->createSheet()->setTitle("Pengawasan Keuangan PD");
        $sheet2 = $spreadsheet->setActiveSheetIndex(2);
        $spreadsheet->createSheet()->setTitle("Reviu Laporan Kinerja");
        $spreadsheet->createSheet()->setTitle("Reviu Laporan Keuangan");
        $spreadsheet->createSheet()->setTitle("Pengawasan Desa");
        $spreadsheet->createSheet()->setTitle("Monev Tinjut");
        $spreadsheet->createSheet()->setTitle("PDTT");
        $spreadsheet->createSheet()->setTitle("Pendampingan Pemda");
        $spreadsheet->createSheet()->setTitle("Pendampingan RB");


    }
}

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
 for( $i ='B'; $i <= 'G'; $i++ ) {
        $spreadsheet->setActiveSheetIndex(0)->getColumnDimension($i)->setWidth(25);
        $spreadsheet->setActiveSheetIndex(0)->getStyle($i)->getAlignment()->setWrapText(true);
        $spreadsheet->setActiveSheetIndex(1)->getColumnDimension($i)->setWidth(25);
        $spreadsheet->setActiveSheetIndex(1)->getStyle($i)->getAlignment()->setWrapText(true);
        $spreadsheet->setActiveSheetIndex(2)->getColumnDimension($i)->setWidth(25);
        $spreadsheet->setActiveSheetIndex(2)->getStyle($i)->getAlignment()->setWrapText(true);
    }

    for ($bulan=1; $bulan <= 12; $bulan++) {

        // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->setCellValue('A'.intval($baris), "REKAPITULASI PENILAIAN PERJALANAN DINAS ". session('tahun'));
        $sheet1->setCellValue('A'.intval($baris), "REKAPITULASI PENILAIAN PERJALANAN DINAS ". session('tahun'));
        $sheet2->setCellValue('A'.intval($baris), "REKAPITULASI PENILAIAN PERJALANAN DINAS ". session('tahun'));
        // Set kolom A1 dengan tulisan "DATA SISWA"

         if($bulan==1) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN JANUARI" );
          }else if($bulan==2) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN FEBRUARI");
          }else if($bulan==3) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN MARET");
          }else if($bulan==4) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN APRIL");
          }else if($bulan==5) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN MEI");
          }else if($bulan==6) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN JUNI");
          }else if($bulan==7) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN JULI");
          }else if($bulan==8) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN AGUSTUS");
          }else if($bulan==9) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN SEEPTEMBER");
          }else if($bulan==10) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN OKTOBER");
          }else if($bulan==11) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN NOVEMBER");
          }else if($bulan==12) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN DESEMBER");
          }



        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris).':F'.intval($baris));
        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris+1).':F'.intval($baris+1));
        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris+2).':F'.intval($baris+2));

        // Set bold kolom A1
        $sheet->getStyle('A'.intval($baris+1))->getFont()->setBold(true);
        $sheet->getStyle('A'.intval($baris))->getFont()->setBold(true);
        $sheet->getStyle('A'.intval($baris))->getFont()->setSize(15);
        // Set font size 15 untuk kolom A1
        $sheet->getStyle('A'.intval($baris+1))->getFont()->setSize(15);
        // Set bold kolom A1
        $sheet->getStyle('A'.intval($baris+2))->getFont()->setBold(true);
        // Set font size 15 untuk kolom A1
        $sheet->getStyle('A'.intval($baris+2))->getFont()->setSize(15);
        $sheet->getStyle('A'.intval($baris))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A'.intval($baris+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A'.intval($baris+2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('A'.intval($baris+3), "NO");
        $sheet->setCellValue('B'.intval($baris+3), "NO SURAT");
        // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C'.intval($baris+3), "Jenis Pemeriksaan");
        // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D'.intval($baris+3), "Kegiatan");
        // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E'.intval($baris+3), "Obrik");
        // Set kolom E3 dengan tulisan "TELEPON"
        $sheet->setCellValue('F'.intval($baris+3), "Anggaran");
        // Set kolom F3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G'.intval($baris+3), "Tanggal");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header

        $sheet->getStyle('A'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('B'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('C'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('D'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('E'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('F'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('G'.intval($baris+3))->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        $sheet->getRowDimension(intval($baris))->setRowHeight(20);
        $sheet->getRowDimension(intval($baris+1))->setRowHeight(20);
        $sheet->getRowDimension(intval($baris+2))->setRowHeight(20);


        // $ps = Penugasan::whereMonth('Tanggalsurat',$bulan)->whereYear('TanggalSurat',session('tahun'))->get();

        // $surat = suratTugas::join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->whereMonth('Tanggalsurat',$bulan)->whereYear('TanggalSurat',session('tahun'))->where('id_anggaran','!=', 27  )->orWhere('id_anggaran','=', NULL)->get();

        $no = 1;

        $penugasan = Penugasan::where('bulan_perhitungan',$bulan)->whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();

        // $penugasan = Penugasan::where('bulan_perhitungan',$bulan)->where(function ($query) {
        //     $query->where('id_anggaran','!=', 27  )->orWhere('id_anggaran','=', NULL);
        // })->whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->get();



        // Untuk penomoran tabel, di awal set dengan 1
        // Set baris pertama untuk isi tabel adalah baris ke 4
        $row = $baris+4;

            $x = 0;

                foreach ($penugasan as $p) {
                    $sheet->setCellValue('A' . $row, $no);
                    $sheet->setCellValue('B' . $row, "094/".$p->noSurat."/03"."/".date("Y"));
                    $sheet->setCellValue('C' . $row, $p->jenis->nama);
                    $sheet->setCellValue('D' . $row, $p->anggaran ? $p->anggaran->kegiatan : 'Anggaran Belum di tentukan');
                    $sheet->setCellValue('E' . $row, $p->obrik->nama);

                    // $total = 0;


                            $sheet->setCellValue('F' . $row, "Rp". number_format($p->hitung) );



                            if(date('m',strtotime($p->Tanggalsurat)) == date('m',strtotime($p->TanggalAkhir)) ) {
                              # code...
                              $sheet->setCellValue('G' . $row, date("d", strtotime($p->Tanggalsurat)) .' s/d '. Carbon::parse($p->TanggalAkhir)->translatedFormat('d F Y')  );
                            }else{
                              # code...
                              $sheet->setCellValue('G' . $row, Carbon::parse($p->Tanggalsurat)->translatedFormat('d F')  .' s/d '. Carbon::parse($p->TanggalAkhir)->translatedFormat('d F Y')   );
                            }
                            $no++;
                            $row++;

                            $x += ($p->hitung);


            }






        if (isset($item)) {
            $sheet->setCellValue('A'.$row, " TOTAL ");
             $sheet->setCellValue('F'.$row, number_format($x) );
        }else {
            $sheet->setCellValue('A'.$row, "TOTAL");
            $sheet->setCellValue('F'.$row, number_format($x) );
        }


        // // Set Merge Cell pada kolom A1 sampai F1
        // $sheet->mergeCells('A'.($row).':E'.$row);
        // $sheet->getStyle('A'.($row).':E'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
        // $sheet->getStyle('A'.($row).':G'.$row)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000'));

        $baris += ($no+5);
    }

// Set orientasi kertas jadi LANDSCAPE
    //   $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    //   // Set judul file excel nya
    //   $sheet->setTitle("Laporan Rekap Perjalanan Dinas");

      // Proses file excel
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Laporan Rekap Perjalanan Dinas.xlsx"'); // Set nama file excel nya
      header('Cache-Control: max-age=0');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');

    }

     public function rekapPerjalananPegawai()
    {
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

            for( $i ='A'; $i <= 'F'; $i++ ) {
        $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(25);
        $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
        $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
    }

    $baris = 1;

    for ($bulan=1; $bulan <= 12; $bulan++) {
        // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->setCellValue('A'.intval($baris), "REKAPITULASI ANGGARAN");
        // Set kolom A1 dengan tulisan "DATA SISWA"
         if($bulan==1) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Januari Tahun " .session('tahun'));
          }else if($bulan==2) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Februari Tahun " .session('tahun'));
          }else if($bulan==3) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Maret Tahun " .session('tahun'));
          }else if($bulan==4) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN April Tahun " .session('tahun'));
          }else if($bulan==5) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Mei Tahun " .session('tahun'));
          }else if($bulan==6) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Juni Tahun " .session('tahun'));
          }else if($bulan==7) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Juli Tahun " .session('tahun'));
          }else if($bulan==8) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Agustus Tahun " .session('tahun'));
          }else if($bulan==9) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN September Tahun " .session('tahun'));
          }else if($bulan==10) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Oktober Tahun " .session('tahun'));
          }else if($bulan==11) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN November Tahun " .session('tahun'));
          }else if($bulan==12) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "PERJALANAN DINAS BULAN Desember Tahun " .session('tahun'));
          }


        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris).':F'.intval($baris));
        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.(intval($baris+1)).':F'.intval($baris+1));
        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.(intval($baris+2)).':F'.intval($baris+2));

        $sheet->mergeCells('A'.(intval($baris+3)).':F'.intval($baris+3));



        // Set bold kolom A1
        $sheet->getStyle('A'.intval($baris+1))->getFont()->setBold(true);
        // Set font size 15 untuk kolom A1
         $sheet->getStyle('A'.intval($baris))->getFont()->setBold(true);
        // Set font size 15 untuk kolom A1
        $sheet->getStyle('A'.intval($baris))->getFont()->setSize(15);
        $sheet->getStyle('A'.intval($baris+1))->getFont()->setSize(15);

        $sheet->getStyle('A'.intval($baris+3))->getFont()->setSize(15);

        // Set bold kolom A1
        $sheet->getStyle('A'.intval($baris+2))->getFont()->setBold(true);
        // Set font size 15 untuk kolom A1
        $sheet->getStyle('A'.intval($baris+2))->getFont()->setSize(15);
        $sheet->getStyle('A'.intval($baris))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A'.intval($baris+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A'.intval($baris+2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('A'.intval($baris+4), "NO");
        // Set kolom B4 dengan tulisan "NIS"
        $sheet->setCellValue('B'.intval($baris+4), "No rekening");
        // Set kolom C4 dengan tulisan "NAMA"
        $sheet->setCellValue('C'.intval($baris+4), "Nama Pegawai");
        // Set kolom D4 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('D'.intval($baris+4), "Pos Anggaran");
        // Set kolom E4 dengan tulisan "TELEPON"
        $sheet->setCellValue('E'.intval($baris+4), "Penugasan");
        // Set kolom F4 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F'.intval($baris+4), "Nominal");

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header

        $sheet->getStyle('A'.intval($baris+4))->applyFromArray($style_col);
        $sheet->getStyle('B'.intval($baris+4))->applyFromArray($style_col);
        $sheet->getStyle('C'.intval($baris+4))->applyFromArray($style_col);
        $sheet->getStyle('D'.intval($baris+4))->applyFromArray($style_col);
        $sheet->getStyle('E'.intval($baris+4))->applyFromArray($style_col);
        $sheet->getStyle('F'.intval($baris+4))->applyFromArray($style_col);

        // Set height baris ke 1, 2 dan 3
        $sheet->getRowDimension(intval($baris))->setRowHeight(20);
        $sheet->getRowDimension(intval($baris+1))->setRowHeight(20);
        $sheet->getRowDimension(intval($baris+2))->setRowHeight(20);
        $sheet->getRowDimension(intval($baris+3))->setRowHeight(20);


        $surat = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->whereMonth('Tanggalsurat',$bulan)->whereYear('TanggalSurat',session('tahun'))->select('surat_tugas.*')->get();

        $no = 1;

        $row = $baris+5;
         $total = 0;
        foreach ($surat->sortBy('nama_karyawan') as $p) {

            if ($p->perhitunganHari > 0) {
                $sheet->setCellValue('A' . $row, $no);
                $sheet->setCellValue('B' . $row, $p->pegawai->rekening);
                $sheet->setCellValue('C' . $row, $p->pegawai->nama_karyawan);
                $sheet->setCellValue('D' . $row, $p->surat->anggaran ? $p->surat->anggaran->kegiatan : 'Anggaran Belum di tentukan');
                $sheet->setCellValue('E' . $row, $p->surat->jenis->nama . " Pada " . $p->surat->obrik->nama);
                $sheet->setCellValue('F' . $row, number_format($p->perhitungan) );
                $no++;
                $row++;
                $total += ($p->perhitungan);
                # code...
            }


        }

        // TOTAL
        if (isset($p)) {
            $sheet->setCellValue('A'.intval($baris+3), "Total : " .number_format($total));
        }else {
               $sheet->setCellValue('A'.intval($baris+3), "Total : 0 ");
        }

        $baris += ($no+6);
    }

            // Set orientasi kertas jadi LANDSCAPE
            $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            // Set judul file excel nya
            $sheet->setTitle("Laporan Rekap Per Pegawai");
            // Proses file excel
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment; filename="Laporan Rekap Per Pegawai.xlsx"'); // Set nama file excel nya
            header('Cache-Control: max-age=0');
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
    }

    public function rekapan()
    {

        for ($bulan=1; $bulan <= 12; $bulan++) {

            $surat[$bulan] = suratTugas::join('pegawais','pegawais.id','=','surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->where('bulan_perhitungan',$bulan)->whereYear('TanggalSurat',session('tahun'))->select('surat_tugas.*','nama_karyawan')->get();
            ## menampilkan Penugasan berdasarkan bulannya
            $penugasan[$bulan] = Penugasan::where('bulan_perhitungan',$bulan)->whereYear('Tanggalsurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->get();
            $pegawai[$bulan] = Pegawai::where('status','Aktif')->orderBy('nama_karyawan','ASC')->get();
            $peran = Peran::all();

            ##menampilkan Peran sesuai bulanya
            foreach ($peran as $p => $pr) {
            # code...
            $surat1[$bulan][$pr->id] = suratTugas::whereHas('surat',function ($query) use($bulan) {
                $query->where('bulan_perhitungan',$bulan)->whereYear('Tanggalsurat',session('tahun'));
            })->where('id_peran',$pr->id)->get()->sortBy(function ($surat) {
                // return $surat->pegawai->nama_karyawan;
            });


            $surat2[$bulan] = suratTugas::whereHas('surat',function ($query) use($bulan) {
                $query->where('bulan_perhitungan',$bulan)->whereYear('Tanggalsurat',session('tahun'));
            })->get()->groupBy('pegawai.nama_karyawan','id_peran')->sortKeys();

            }
        }






        return view('admin.rekapan',compact('surat','penugasan','pegawai','peran','surat1','surat2'));

      }

      public function rekapPerjalananPDF()
      {

        $mPenugasan = new Penugasan;
         for ($bulan=1; $bulan <= 12; $bulan++) {
        //  $penugasan[$bulan] = Penugasan::where('bulan_perhitungan',$bulan)->where(function ($query) {
        //     $query->where('id_anggaran','!=', 27  )->orWhere('id_anggaran','=', NULL);
        // })->whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->get();

        $penugasan[$bulan] = DB::table('result_penugasan')->where('bulan_perhitungan',$bulan)->where(function ($query) {
            $query->where('id_anggaran','!=', 27  )->orWhere('id_anggaran','=', NULL);
        })->whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->get();

        // dd($mPenugasan->find($penugasan[$bulan][0]->id)->hitung);

        }

        return view('admin.rekap_Perjalanan',compact('mPenugasan','penugasan'));
      }

         public function rekapPerjalananPegawaiPDF()
      {

        $grandtotal = 0;
         for ($bulan=1; $bulan <= 12; $bulan+=1) {

             $surat[$bulan] = suratTugas::join('pegawais', 'pegawais.id', '=', 'surat_tugas.id_karyawan')->join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->join('perans', 'perans.id', '=', 'surat_tugas.id_peran')->where('bulan_perhitungan',$bulan)->whereYear('TanggalSurat',session('tahun'))->orderBy('perans.id','ASC')->select('surat_tugas.*')->get();


        //  if ($surat[$bulan]) {
        //     # code...
        //     $nomor = 0;
        //     foreach ($surat[$bulan] as $key => $value) {
        //         # code...

        //         $total[$key] = $grandtotal;
        //         $sekarang = strtotime($value->ta);
        //         $akhir = strtotime($value->tp);
        //         $idsurat = $value->id;
        //         $idpegawai = $value->id_karyawan;
        //         $jumlahHari[$key] = 0;
        //         $pengurangan[$key] = 0;

        //         if ($value->ta == NULL) {
        //             # code...
        //             $total[$key] = 0;
        //         } else {
        //             # code...
        //             for ( $i = $sekarang; $i <= $akhir; $i = $i + 86400 ) {
        //                 $jumlahHari[$key] += 1;
        //               if (date("D",$i)=='Sat' OR date("D",$i) == "Sun" ) {
        //                   $pengurangan[$key] += 1;
        //               }

        //               //mengambil data jadwal lain
        //               $tanggali = date("Y-m-d",$i);
        //               $jadwal = Jadwallain::where('id_pegawai','=',$idpegawai)->where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
        //               if ($jadwal > 0 ) {
        //                 # code...
        //                 $pengurangan[$key] += 1;
        //               }
        //               $jadwalLibur = JadwalLibur::where('tanggalawal','<=',$tanggali)->where('tanggalakhir','>=',$tanggali)->count();
        //               if ($jadwalLibur > 0) {
        //                 # code...
        //                 $pengurangan[$key] += 1;
        //               }
        //               //mengambil data jadwal libur
        //             }
        //             echo $pengurangan[$key];
        //             $total[$key] = ($jumlahHari[$key] - $pengurangan[$key]) * $value->peran->tarif ;
        //         }
        //         }
        //  }
    }

        return view('admin.rekap_PerjalananPegawai',compact('surat'));
      }

      public function templateMonev()
      {
        return view('admin.monevtemplate');
      }

    //   public function rekapmonevRKPD(Request $request)
    //   {
    //     $query = Penugasan::query();
    //     $date  = $request->date_filter;

    //     switch($date)
    //     {
    //         case 'tw1':
    //             $query->whereMonth('TanggalSurat', Carbon::now()->subMonth(3)->month);
    //     }


    //   }

    public function tesapp()
    {
        echo "tes";
    }



    public function reportPKPT()
    {

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
 for( $i ='B'; $i <= 'D'; $i++ ) {
        $spreadsheet->getActiveSheet()->getColumnDimension($i)->setWidth(25);
        $spreadsheet->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
    }

    for ($bulan=1; $bulan <= 12; $bulan++) {

        // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->setCellValue('A'.intval($baris), "REPORT PKPT". session('tahun'));
        // Set kolom A1 dengan tulisan "DATA SISWA"

         if($bulan==1) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN JANUARI" );
          }else if($bulan==2) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN FEBRUARI");
          }else if($bulan==3) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN MARET");
          }else if($bulan==4) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN APRIL");
          }else if($bulan==5) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN MEI");
          }else if($bulan==6) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN JUNI");
          }else if($bulan==7) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN JULI");
          }else if($bulan==8) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN AGUSTUS");
          }else if($bulan==9) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN SEEPTEMBER");
          }else if($bulan==10) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN OKTOBER");
          }else if($bulan==11) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN NOVEMBER");
          }else if($bulan==12) {
            # code...
            $sheet->setCellValue('A'.intval($baris+1), "BULAN DESEMBER");
          }



        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris).':F'.intval($baris));
        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris+1).':F'.intval($baris+1));
        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris+2).':F'.intval($baris+2));

        // Set bold kolom A1
        $sheet->getStyle('A'.intval($baris+1))->getFont()->setBold(true);
        $sheet->getStyle('A'.intval($baris))->getFont()->setBold(true);
        $sheet->getStyle('A'.intval($baris))->getFont()->setSize(15);
        // Set font size 15 untuk kolom A1
        $sheet->getStyle('A'.intval($baris+1))->getFont()->setSize(15);
        // Set bold kolom A1
        $sheet->getStyle('A'.intval($baris+2))->getFont()->setBold(true);
        // Set font size 15 untuk kolom A1
        $sheet->getStyle('A'.intval($baris+2))->getFont()->setSize(15);
        $sheet->getStyle('A'.intval($baris))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A'.intval($baris+1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A'.intval($baris+2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('A'.intval($baris+3), "NO");
        // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('B'.intval($baris+3), "Jenis Pemeriksaan");
        // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('C'.intval($baris+3), "Target Laporan");

        $sheet->setCellValue('D'.intval($baris+3), "Sub Kegiatan");
        // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header

        $sheet->getStyle('A'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('B'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('C'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('D'.intval($baris+3))->applyFromArray($style_col);

        // Set height baris ke 1, 2 dan 3
        $sheet->getRowDimension(intval($baris))->setRowHeight(20);
        $sheet->getRowDimension(intval($baris+1))->setRowHeight(20);
        $sheet->getRowDimension(intval($baris+2))->setRowHeight(20);


        // $ps = Penugasan::whereMonth('Tanggalsurat',$bulan)->whereYear('TanggalSurat',session('tahun'))->get();

        // $surat = suratTugas::join('penugasans', 'penugasans.id', '=', 'surat_tugas.id_penugasan')->whereMonth('Tanggalsurat',$bulan)->whereYear('TanggalSurat',session('tahun'))->where('id_anggaran','!=', 27  )->orWhere('id_anggaran','=', NULL)->get();

        $no = 1;

        $penugasan = Penugasan::where('bulan_perhitungan',$bulan)->whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();

        // $penugasan = Penugasan::where('bulan_perhitungan',$bulan)->where(function ($query) {
        //     $query->where('id_anggaran','!=', 27  )->orWhere('id_anggaran','=', NULL);
        // })->whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->get();



        // Untuk penomoran tabel, di awal set dengan 1
        // Set baris pertama untuk isi tabel adalah baris ke 4
        $row = $baris+4;

                foreach ($penugasan as $p) {
                    $sheet->setCellValue('A' . $row, $no);
                    $sheet->setCellValue('B' . $row, $p->jenis->nama.' ke '.$p->obrik->nama);
                    $sheet->setCellValue('C' . $row, $p->jumlah_laporan );
                    $sheet->setCellValue('D' . $row, $p->anggaran ? $p->anggaran->kegiatan : 'Anggaran Belum di tentukan');


                            $no++;
                            $row++;




            }



        // // Set Merge Cell pada kolom A1 sampai F1
        // $sheet->mergeCells('A'.($row).':E'.$row);
        // $sheet->getStyle('A'.($row).':E'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
        // $sheet->getStyle('A'.($row).':G'.$row)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000'));

        $baris += ($no+5);
    }

// Set orientasi kertas jadi LANDSCAPE
    //   $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
    //   // Set judul file excel nya
    //   $sheet->setTitle("Laporan Rekap Perjalanan Dinas");

      // Proses file excel
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Report PKPT.xlsx"'); // Set nama file excel nya
      header('Cache-Control: max-age=0');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');

    }

    public function rekapMonev(Request $request)
    {

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet = $spreadsheet->setActiveSheetIndex(0);
$sheet->setTitle("Rekap Penugasan");

$kegiatan = Kegiatan::all();

foreach ($kegiatan as $kegiatanNama) {
    # code...
    if ($kegiatanNama->kegiatan=="Pengawasan Kinerja Pemerintah Daerah") {
        # code...
        $spreadsheet->createSheet()->setTitle("Pengawasan Kinerja PD");
        $sheet1 = $spreadsheet->setActiveSheetIndex(1);
        $spreadsheet->createSheet()->setTitle("Pengawasan Keuangan PD");
        $sheet2 = $spreadsheet->setActiveSheetIndex(2);
        $spreadsheet->createSheet()->setTitle("Reviu Laporan Kinerja");
        $spreadsheet->createSheet()->setTitle("Reviu Laporan Keuangan");
        $spreadsheet->createSheet()->setTitle("Pengawasan Desa");
        $spreadsheet->createSheet()->setTitle("Monev Tinjut");
        $spreadsheet->createSheet()->setTitle("PDTT");
        $spreadsheet->createSheet()->setTitle("Pendampingan Pemda");
        $spreadsheet->createSheet()->setTitle("Pendampingan RB");


    }
}



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

$baris1 = 1;
 for( $i ='B'; $i <= 'H'; $i++ ) {
        $spreadsheet->setActiveSheetIndex(0)->getColumnDimension($i)->setWidth(25);
        $spreadsheet->setActiveSheetIndex(0)->getStyle($i)->getAlignment()->setWrapText(true);
        $spreadsheet->setActiveSheetIndex(1)->getColumnDimension($i)->setWidth(25);
        $spreadsheet->setActiveSheetIndex(1)->getStyle($i)->getAlignment()->setWrapText(true);
        $spreadsheet->setActiveSheetIndex(2)->getColumnDimension($i)->setWidth(25);
        $spreadsheet->setActiveSheetIndex(2)->getStyle($i)->getAlignment()->setWrapText(true);
    }



        // Set kolom A1 dengan tulisan "DATA SISWA"
        $sheet->setCellValue('A'.intval($baris), "Rekapitulasi Pemeriksaan Inspektorat Daerah Tahun ". session('tahun'));
        $sheet1->setCellValue('A'.intval($baris), "Rekapitulasi Pemeriksaan Inspektorat Daerah Tahun ". session('tahun'));
        $sheet2->setCellValue('A'.intval($baris), "Rekapitulasi Pemeriksaan Inspektorat Daerah Tahun ". session('tahun'));
        // Set kolom A1 dengan tulisan "DATA SISWA"



        // Set Merge Cell pada kolom A1 sampai F1
        $sheet->mergeCells('A'.intval($baris).':H'.intval($baris));
        $sheet1->mergeCells('A'.intval($baris).':H'.intval($baris));
        $sheet2->mergeCells('A'.intval($baris).':H'.intval($baris));

        // Set Merge Cell pada kolom A1 sampai F1

        // Set bold kolom A1

        $sheet->getStyle('A'.intval($baris))->getFont()->setBold(true);
        $sheet->getStyle('A'.intval($baris))->getFont()->setSize(15);
        $sheet1->getStyle('A'.intval($baris))->getFont()->setBold(true);
        $sheet1->getStyle('A'.intval($baris))->getFont()->setSize(15);
        $sheet2->getStyle('A'.intval($baris))->getFont()->setBold(true);
        $sheet2->getStyle('A'.intval($baris))->getFont()->setSize(15);

        // Set font size 15 untuk kolom A1
        $sheet->getStyle('A'.intval($baris))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet1->getStyle('A'.intval($baris))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet2->getStyle('A'.intval($baris))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('A'.intval($baris+3), "No");
        $sheet->setCellValue('B'.intval($baris+3), "Uraian");

        $sheet1->setCellValue('A'.intval($baris+3), "No");
        $sheet1->setCellValue('B'.intval($baris+3), "Uraian");

        $sheet2->setCellValue('A'.intval($baris+3), "No");
        $sheet2->setCellValue('B'.intval($baris+3), "Uraian");
        // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C'.intval($baris+3), "Obrik");

        $sheet1->setCellValue('C'.intval($baris+3), "Obrik");

        $sheet2->setCellValue('C'.intval($baris+3), "Obrik");
        // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D'.intval($baris+3), "Sub Kegiatan");

        $sheet1->setCellValue('D'.intval($baris+3), "Sub Kegiatan");

        $sheet2->setCellValue('D'.intval($baris+3), "Sub Kegiatan");
        // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E'.intval($baris+3), "Bulan");

        $sheet1->setCellValue('E'.intval($baris+3), "Bulan");

        $sheet2->setCellValue('E'.intval($baris+3), "Bulan");
        // Set kolom E3 dengan tulisan "TELEPON"
        $sheet->setCellValue('F'.intval($baris+3), "Jumlah Laporan");

        $sheet1->setCellValue('F'.intval($baris+3), "Jumlah Laporan");

        $sheet2->setCellValue('F'.intval($baris+3), "Jumlah Laporan");
        // Set kolom F3 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G'.intval($baris+3), "Anggaran");
        $sheet->setCellValue('H'.intval($baris+3), "Tanggal Pemeriksaan");

        $sheet1->setCellValue('G'.intval($baris+3), "Anggaran");
        $sheet1->setCellValue('H'.intval($baris+3), "Tanggal Pemeriksaan");

        $sheet2->setCellValue('G'.intval($baris+3), "Anggaran");
        $sheet2->setCellValue('H'.intval($baris+3), "Tanggal Pemeriksaan");
        // Apply style header yang telah kita buat tadi ke masing-masing kolom header

        $sheet->getStyle('A'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('B'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('C'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('D'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('E'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('F'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('G'.intval($baris+3))->applyFromArray($style_col);
        $sheet->getStyle('H'.intval($baris+3))->applyFromArray($style_col);

        $sheet1->getStyle('A'.intval($baris+3))->applyFromArray($style_col);
        $sheet1->getStyle('B'.intval($baris+3))->applyFromArray($style_col);
        $sheet1->getStyle('C'.intval($baris+3))->applyFromArray($style_col);
        $sheet1->getStyle('D'.intval($baris+3))->applyFromArray($style_col);
        $sheet1->getStyle('E'.intval($baris+3))->applyFromArray($style_col);
        $sheet1->getStyle('F'.intval($baris+3))->applyFromArray($style_col);
        $sheet1->getStyle('G'.intval($baris+3))->applyFromArray($style_col);
        $sheet1->getStyle('H'.intval($baris+3))->applyFromArray($style_col);

        $sheet2->getStyle('A'.intval($baris+3))->applyFromArray($style_col);
        $sheet2->getStyle('B'.intval($baris+3))->applyFromArray($style_col);
        $sheet2->getStyle('C'.intval($baris+3))->applyFromArray($style_col);
        $sheet2->getStyle('D'.intval($baris+3))->applyFromArray($style_col);
        $sheet2->getStyle('E'.intval($baris+3))->applyFromArray($style_col);
        $sheet2->getStyle('F'.intval($baris+3))->applyFromArray($style_col);
        $sheet2->getStyle('G'.intval($baris+3))->applyFromArray($style_col);
        $sheet2->getStyle('H'.intval($baris+3))->applyFromArray($style_col);
        // Set height baris ke 1, 2 dan 3
        $sheet->getRowDimension(intval($baris))->setRowHeight(20);

        $no = 1;

        $no1 = 1;

         $Penugasan = Penugasan::whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();

         $penugasan1 = Penugasan::where('id_anggaran','==', 21  )->whereYear('TanggalSurat',session('tahun'))->orderBy('Tanggalsurat','ASC')->orderBy('noSurat','ASC')->get();

        // Untuk penomoran tabel, di awal set dengan 1
        // Set baris pertama untuk isi tabel adalah baris ke 4

        $row = $baris+4;

        $x = 0;

        $laporan = 0;

        $row1 = $baris1+4;

        $x1 = 0;

        $laporan1 = 0;

        foreach ($Penugasan as $p) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $p->jenis->nama.' ke '.$p->obrik->nama);
            $sheet->setCellValue('C' . $row, $p->obrik->nama);
            $sheet->setCellValue('D' . $row, $p->anggaran ? $p->anggaran->kegiatan : 'Anggaran Belum di tentukan');
            $sheet->setCellValue('E' . $row, date("F", strtotime($p->Tanggalsurat)) );
            $sheet->setCellValue('F' . $row, $p->jumlah_laporan );

            $total = 0;
            $sheet->setCellValue('G' . $row, "Rp". number_format($p->hitung) );



                    if(date('m',strtotime($p->Tanggalsurat)) == date('m',strtotime($p->TanggalAkhir)) ) {
                      # code...
                      $sheet->setCellValue('H' . $row, date("d", strtotime($p->Tanggalsurat)) .' s/d '. Carbon::parse($p->TanggalAkhir)->translatedFormat('d F Y')  );
                    }else{
                      # code...
                      $sheet->setCellValue('H' . $row, Carbon::parse($p->Tanggalsurat)->translatedFormat('d F')  .' s/d '. Carbon::parse($p->TanggalAkhir)->translatedFormat('d F Y')   );
                     }
                    $no++;
                    $row++;

                    $x += ($p->hitung);

                    $laporan += ($p->jumlah_laporan);


    }

if (isset($item)) {
    $sheet->setCellValue('A'.$row, " JUMLAH TOTAL RKPD TRIWULAN I ");
    $sheet->setCellValue('F'.$row, number_format($laporan) );
    $sheet->setCellValue('G'.$row, number_format($x) );
}else {
    $sheet->setCellValue('A'.$row, "JUMLAH TOTAL RKPD TRIWULAN I");
    $sheet->setCellValue('F'.$row, number_format($laporan) );
    $sheet->setCellValue('G'.$row, number_format($x) );
}

$sheet->mergeCells('A'.intval($row).':E'.intval($row));
$sheet->getStyle('A'.intval($row))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

foreach ($penugasan1 as $ps) {
    $sheet1->setCellValue('A' . $row1, $no);
    $sheet1->setCellValue('B' . $row1, $ps->jenis->nama.' ke '.$ps->obrik->nama);
    $sheet1->setCellValue('C' . $row1, $ps->obrik->nama);
    $sheet1->setCellValue('D' . $row1, $ps->anggaran ? $ps->anggaran->kegiatan : 'Anggaran Belum di tentukan');
    $sheet1->setCellValue('E' . $row1, date("F", strtotime($ps->Tanggalsurat)) );
    $sheet1->setCellValue('F' . $row1, $ps->jumlah_laporan );

    $total1 = 0;
    $sheet1->setCellValue('G' . $row1, "Rp". number_format($ps->hitung) );



            if(date('m',strtotime($ps->Tanggalsurat)) == date('m',strtotime($ps->TanggalAkhir)) ) {
              # code...
              $sheet1->setCellValue('H' . $row1, date("d", strtotime($ps->Tanggalsurat)) .' s/d '. Carbon::parse($ps->TanggalAkhir)->translatedFormat('d F Y')  );
            }else{
              # code...
              $sheet1->setCellValue('H' . $row1, Carbon::parse($ps->Tanggalsurat)->translatedFormat('d F')  .' s/d '. Carbon::parse($ps->TanggalAkhir)->translatedFormat('d F Y')   );
             }
            $no1++;
            $row1++;

            $x1 += ($p->hitung);

            $laporan1 += ($p->jumlah_laporan);


}

if (isset($item)) {
$sheet1->setCellValue('A'.$row1, " JUMLAH TOTAL RKPD TRIWULAN I ");
$sheet1->setCellValue('F'.$row1, number_format($laporan) );
$sheet1->setCellValue('G'.$row1, number_format($x) );
}else {
$sheet1->setCellValue('A'.$row1, "JUMLAH TOTAL RKPD TRIWULAN I");
$sheet1->setCellValue('F'.$row1, number_format($laporan) );
$sheet1->setCellValue('G'.$row1, number_format($x) );
}

$sheet1->mergeCells('A'.intval($row1).':E'.intval($row1));
$sheet1->getStyle('A'.intval($row1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

// // Set Merge Cell pada kolom A1 sampai F1
// $sheet->mergeCells('A'.($row).':E'.$row);
// $sheet->getStyle('A'.($row).':E'.$row)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('FFFF00');
// $sheet->getStyle('A'.($row).':G'.$row)->getBorders()->getOutline()->setBorderStyle(Border::BORDER_THIN)->setColor(new Color('00000'));

$baris += ($no+5);
$baris1 += ($no1+5);







      // Proses file excel
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="Laporan Rekap Perjalanan Dinas.xlsx"'); // Set nama file excel nya
      header('Cache-Control: max-age=0');
      $writer = new Xlsx($spreadsheet);
      $writer->save('php://output');

    }

}
