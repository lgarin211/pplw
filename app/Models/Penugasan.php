<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penugasan extends Model
{
    use HasFactory;

    protected $dates = ["tanggalterbitSurat"];
    public function jenis()
    {
        return $this->hasOne(JenisPengawasan::class, 'id', 'id_jenis_pengawasan');
    }
    public function obrik()
    {
        return $this->hasOne(Obrik::class, 'id', 'id_obrik');
    }
    public function anggaran()
    {
        return $this->hasOne(Kegiatan::class, 'id', 'id_anggaran');
    }

    public function surat()
    {
        return $this->hasMany(suratTugas::class,'id_penugasan','id');
    }
    //   public function surat1()
    // {
    //     return $this->hasOne(suratTugas::class,'id_penugasan','id');
    // }

    public function getHitungAttribute(){
        $total1 = 0;
        foreach ($this->surat as $surat) {
            # code...
            $total1 += $surat->perhitungan;
        }
        return $total1;
    }

    public function getTotalTerbilangAttribute(){



        $terbilang =  ucwords($this->terbilang($this->hitung))." Rupiah";


            return $terbilang;

    }

    public function penyebut($nilai) {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " ". $huruf[$nilai];
        } else if ($nilai <20) {
            $temp = $this->penyebut($nilai - 10). " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
        }
        return $temp;
    }

    public function terbilang($nilai) {
        if($nilai<0) {
            $hasil = "minus ". trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    public function getJenisPengawasanPanjangAttribute()
    {
        $hasil = '';
        if (($posisi = strlen($this->jenis->nama) < 200)) {
            # code...
            $hasil = substr($this->jenis->nama,0,95);
        }
        return $hasil;
    }

    protected static function booted(): void
    {
        static::creating(function (Penugasan $penugasan) {
            // ...
            $bulanPerhitungan = null;
            $bulanTanggalAwal = Carbon::parse($penugasan->Tanggalsurat)->format('m');
            $bulanTanggalAkhir = Carbon::parse($penugasan->TanggalAkhir	)->format('m');
            if ($bulanTanggalAwal == $bulanTanggalAkhir) {
                # code...
                $bulanPerhitungan = $bulanTanggalAwal;
            }else {
                # code...
                $jumlahBulanAwal = 0;
                $jumlahBulanAkhir = 0;
                $tanggal = CarbonPeriod::create($penugasan->Tanggalsurat,$penugasan->TanggalAkhir);
                foreach ($tanggal as $t) {
                    # code...
                    $t = $t->format('m');
                    if ($t == $bulanTanggalAwal) {
                        # code...
                        $jumlahBulanAwal++;
                    }else {
                        $jumlahBulanAkhir++;
                    }
                }
                if ($jumlahBulanAwal > $jumlahBulanAkhir) {
                    # code...
                    $bulanPerhitungan = $bulanTanggalAwal;
                }else {
                    $bulanPerhitungan = $bulanTanggalAkhir;
                }
            }
            $penugasan->bulan_perhitungan = $bulanPerhitungan;


        });
    }

    function tgl_indo($tanggal){
        $bulan = array (
            01 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tahun
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tanggal

        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }


}
