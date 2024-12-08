<?php

use App\Models\LHP;
use App\Models\PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\simptl\masterController;
use App\Http\Controllers\simptl\PengawasanController;
use App\Http\Controllers\simptl\ManajemenUseraController;
use App\Http\Controllers\simptl\ManajemenObrikController;
use App\Http\Controllers\LHPController;
use App\Http\Controllers\TTEController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IrbanController;
use App\Http\Controllers\NugasController;
use App\Http\Controllers\ObrikController;
use App\Http\Controllers\PeranController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\EselonController;
use App\Http\Controllers\JabatanController;
// use App\Http\Controllers\skpdController;
use App\Http\Controllers\KendaliController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PangkatController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\JenisPengawasanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/ps', function () {
    return Hash::make("admin");
});

Route::get('/', function () {
    return view('login');
});

// Route::get('/admin', [skpdController::class, 'admin']);
Route::get('/index', [SkpdController::class, 'tampil']);
Route::get('/logout', [UserController::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/skpd', [SkpdController::class, 'index']);
Route::put('/skpd_edit', [SkpdController::class, 'update']);
Route::put('/nomor_edit', [SkpdController::class, 'updatenomor']);

Route::get('/pengguna', [PenggunaController::class, 'index']);
Route::get('/pengguna_baru', [PenggunaController::class, 'create']);
Route::post('/register', [PenggunaController::class, 'register']);
Route::get('pengguna_baru/{id}/edit', [PenggunaController::class, 'edit']);
Route::put('pengguna_baru/{id}', [PenggunaController::class, 'update']);
Route::delete('pengguna_baru/{id}/hapus', [PenggunaController::class, 'hapus']);
Route::get('pengguna_baru/{id}/detail', [PenggunaController::class, 'show']);

Route::get('/pegawai', [PegawaiController::class, 'index']);
Route::get('/pegawai_baru', [PegawaiController::class, 'create']);
Route::post('/pegawai_baru', [PegawaiController::class, 'store']);
Route::get('pegawai_baru/{id}/edit', [PegawaiController::class, 'edit']);
Route::put('pegawai_baru/{id}', [PegawaiController::class, 'update']);
Route::delete('pegawai_baru/{id}/hapus', [PegawaiController::class, 'hapus']);
Route::get('pegawai_baru/{id}/detail', [PegawaiController::class, 'show']);

Route::get('/kegiatan', [KegiatanController::class, 'index']);
Route::get('/kegiatan_baru', [KegiatanController::class, 'create']);
Route::post('/kegiatan_baru', [KegiatanController::class, 'store']);
Route::get('kegiatan_baru/{id}/edit', [KegiatanController::class, 'edit']);
Route::put('kegiatan_baru/{id}', [KegiatanController::class, 'update']);
Route::delete('kegiatan_baru/{id}/hapus', [KegiatanController::class, 'hapus']);


Route::get('/obrik', [ObrikController::class, 'index']);
Route::get('/obrik_baru', [ObrikController::class, 'create']);
Route::post('/obrik_baru', [ObrikController::class, 'store']);
Route::get('obrik_baru/{id}/edit', [ObrikController::class, 'edit']);
Route::put('obrik_baru/{id}', [ObrikController::class, 'update']);
Route::delete('obrik_baru/{id}/hapus', [ObrikController::class, 'hapus']);

Route::get('/jenisPengawasan', [JenisPengawasanController::class, 'index']);
Route::get('/jenisPengawasan_cari', [JenisPengawasanController::class, 'cari']);
Route::get('/jenisPengawasan_baru', [JenisPengawasanController::class, 'create']);
Route::post('/jenisPengawasan_baru', [JenisPengawasanController::class, 'store']);
Route::get('jenisPengawasan_baru/{id}/edit', [JenisPengawasanController::class, 'edit']);
Route::put('jenisPengawasan_baru/{id}', [JenisPengawasanController::class, 'update']);
Route::delete('jenisPengawasan_baru/{id}/hapus', [JenisPengawasanController::class, 'hapus']);

Route::get('/Peran', [PeranController::class, 'index']);
Route::get('/Peran_baru', [PeranController::class, 'create']);
Route::post('/Peran_baru', [PeranController::class, 'store']);
Route::get('Peran_baru/{id}/edit', [PeranController::class, 'edit']);
Route::put('Peran_baru/{id}', [PeranController::class, 'update']);
Route::delete('Peran_baru/{id}/hapus', [PeranController::class, 'hapus']);

Route::get('/Anggaran', [AnggaranController::class, 'index']);
Route::get('/perjalananDalam', [SuratController::class, 'indexDalam']);
Route::post('/perjalananDalam', [SuratController::class, 'store']);
Route::get('/perjalananDalam_create', [SuratController::class, 'CreateperjalananDalam']);
Route::get('perjalananDalam/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
Route::put('perjalananDalam/{id}', [SuratController::class, 'update'])->name('perjalanan/edit');
Route::delete('perjalananDalam/{id}/hapus', [SuratController::class, 'hapus']);

Route::post('/suratTugasBaru', [SuratController::class, 'suratBaru']);
Route::put('/suratTugasEdit/{id}', [SuratController::class, 'suratEdit']);

Route::get('perjalananDalam/suratTugas/{id}', [SuratController::class, 'suratTugas']);
Route::get('perjalananDalam/suratDinas/{id}', [SuratController::class, 'suratperintah']);
Route::get('perjalananDalam/sppd/{id}', [SuratController::class, 'sppd']);

Route::get('/berkas', [BerkasController::class, 'index']);
Route::get('/berkas/bukti/{id}', [BerkasController::class, 'bukti']);
Route::get('/berkas/A2/{id}', [BerkasController::class, 'A2']);
Route::get('/penugasan', [NugasController::class, 'index']);

Route::get('/pangkat', [PangkatController::class, 'index']);
Route::get('/pangkat_baru', [PangkatController::class, 'create']);
Route::post('/pangkat_baru', [PangkatController::class, 'store']);
Route::get('pangkat_baru/{id}/edit', [PangkatController::class, 'edit']);
Route::put('pangkat_baru/{id}', [PangkatController::class, 'update']);
Route::delete('pangkat_baru/{id}/hapus', [PangkatController::class, 'hapus']);

Route::get('/eselon', [EselonController::class, 'index']);
Route::get('/eselon_baru', [EselonController::class, 'create']);
Route::post('/eselon_baru', [EselonController::class, 'store']);
Route::get('eselon_baru/{id}/edit', [EselonController::class, 'edit']);
Route::put('eselon_baru/{id}', [EselonController::class, 'update']);
Route::delete('eselon_baru/{id}/hapus', [EselonController::class, 'hapus']);

Route::get('/arsip', [SuratController::class, 'indexbaru'])->name('arsip');
Route::post('/arsip/cari', [SuratController::class, 'arsipCari']);

Route::get('/tahun', [TahunController::class, 'index']);
Route::get('/tahun_new', [TahunController::class, 'create']);
Route::post('/tahun', [TahunController::class, 'store']);
Route::delete('tahun/{id}/hapus', [TahunController::class, 'hapus']);

Route::get('/kendali', [KendaliController::class, 'index']);

Route::get('/eselon_baru', [EselonController::class, 'create']);
Route::post('/eselon_baru', [EselonController::class, 'store']);
Route::get('eselon_baru/{id}/edit', [EselonController::class, 'edit']);
Route::put('eselon_baru/{id}', [EselonController::class, 'update']);
Route::delete('eselon_baru/{id}/hapus', [EselonController::class, 'hapus']);

Route::get('/rekap', [RekapController::class, 'index']);

Route::get('/eselon_baru', [EselonController::class, 'create']);
Route::post('/eselon_baru', [EselonController::class, 'store']);
Route::get('eselon_baru/{id}/edit', [EselonController::class, 'edit']);
Route::put('eselon_baru/{id}', [EselonController::class, 'update']);
Route::delete('eselon_baru/{id}/hapus', [EselonController::class, 'hapus']);

Route::get('/rekap_Perjalanan', [RekapController::class, 'rekapPerjalanan']);
Route::get('/rekap_PerjalananPDF', [RekapController::class, 'rekapPerjalananPDF']);
Route::get('/rekap_PerjalananPegawai', [RekapController::class, 'rekapPerjalananPegawai']);
Route::get('/rekap_PerjalananPegawaiPDF', [RekapController::class, 'rekapPerjalananPegawaiPDF']);
Route::get('/rekapan', [RekapController::class, 'rekapan']);

Route::get('/jabatan', [JabatanController::class, 'index']);
Route::get('/jabatan_baru', [JabatanController::class, 'create']);
Route::post('/jabatan_baru', [JabatanController::class, 'store']);
Route::get('jabatan_baru/{id}/edit', [JabatanController::class, 'edit']);
Route::put('jabatan_baru/{id}', [JabatanController::class, 'update']);
Route::delete('jabatan_baru/{id}/hapus', [JabatanController::class, 'hapus']);

// Route::get('/tahun_baru', [SuratController::class, 'indexDalam']);

Route::get('export', [SuratController::class, 'cek']);

Route::post('/ubahtahun', [UserController::class, 'ubahtahun']);

// Route::post('/kendalitampil', [KendaliController::class, 'Cari']);
Route::post('/carikendali', [KendaliController::class, 'Cari']);
Route::get('/jadwal_lain', [KendaliController::class, 'jadwalLain']);
Route::get('/jadwal_lain_create', [KendaliController::class, 'jadwalLaincreate']);
Route::post('/jadwal_lain', [KendaliController::class, 'store']);
Route::delete('jabatan_baru/{id}/hapus', [KendaliController::class, 'hapus']);

Route::get('/jadwal_libur', [KendaliController::class, 'jadwalLibur']);
Route::get('/jadwal_libur_create', [KendaliController::class, 'jadwalLiburcreate']);
Route::post('/jadwal_libur', [KendaliController::class, 'storeLibur']);
Route::delete('jadwal_libur/{id}/hapus', [KendaliController::class, 'hapusLibur']);

Route::get('/kendaraan', [KendaraanController::class, 'index']);
Route::get('/kendaraan_create', [KendaraanController::class, 'kendaraanCreate']);
Route::post('/kendaraan', [KendaraanController::class, 'storekendaraan']);
Route::get('kendaraan/{id}/edit', [KendaraanController::class, 'edit']);
Route::put('kendaraan/{id}', [KendaraanController::class, 'update']);
Route::delete('kendaraan/{id}/hapus', [KendaraanController::class, 'hapus']);

Route::get('/laporanKegiatan', [LaporanController::class, 'index']);
Route::get('/laporanKegiatanPDF', [LaporanController::class, 'indexPDF']);
// Route::get('/kendaraan_create', [KendaraanController::class, 'kendaraanCreate']);
Route::post('/rekap_laporanKegiatan', [LaporanController::class, 'rekapLaporanKegiatan']);
Route::post('/rekap_laporanKegiatanPDF', [LaporanController::class, 'rekapLaporanKegiatanPDF']);

Route::get('/laporanPegawai', [LaporanController::class, 'indexLaporan']);
Route::get('/laporanPegawaiPDF', [LaporanController::class, 'indexLaporanPDF']);
Route::post('/rekap_suratpegawai', [LaporanController::class, 'rekapSuratpegawai']);
Route::post('/rekap_suratpegawaiPDF', [LaporanController::class, 'rekapSuratpegawaiPDF']);

// Route::get('/kendaraan_create', [KendaraanController::class, 'kendaraanCreate']);
Route::post('/laporanPegawai', [LaporanController::class, 'store']);

Route::get('/ExportlaporanKegiatan', [LaporanController::class, 'export']);

Route::get('/irban', [IrbanController::class, 'index']);
Route::get('/irban_baru', [IrbanController::class, 'create']);
Route::post('/irban_baru', [IrbanController::class, 'store']);
Route::get('obrik_baru/{id}/edit', [obrikController::class, 'edit']);
Route::put('obrik_baru/{id}', [obrikController::class, 'update']);
Route::delete('irban_baru/{id}/hapus', [IrbanController::class, 'hapus']);

Route::get('/tte', [TTEController::class, 'index']);
Route::get('/tte_baru', [TTEController::class, 'create']);
Route::post('/tte_baru', [TTEController::class, 'store']);
Route::get('/tte_viewPDF/{id}/view', [TTEController::class, 'view']);
Route::get('tte_downloadPDF/{id}', [TTEController::class, 'download']);
// Route::get('tte_downloadPDF/{id}', [TTEController::class, 'download']);

// Route::get('tte_viewPDF/{id}/view', function($id) {
//     $file = PDF::find($id);
//     return response()->file(public_path('files/'.$file->pdf));
// })->name('tte_viewPDF');

Route::get('berkasLHP', [LHPController::class, 'index']);
Route::get('/lhp_baru', [LHPController::class, 'create']);
Route::post('/lhp_baru', [LHPController::class, 'store']);
Route::get('/lhp_viewPDF/{id}/view', [LHPController::class, 'view']);
Route::get('lhp_downloadPDF/{pdf}', [LHPController::class, 'download']);

Route::get('lhp_viewPDF/{id}/view', function($id) {
    $file = LHP::find($id);
    return response()->file(public_path('LHP/'.$file->lhp));
})->name('lhp_viewPDF');

// Route::get('obrik_baru/{id}/edit', [obrikController::class, 'edit']);
// Route::put('obrik_baru/{id}', [obrikController::class, 'update']);
// Route::delete('obrik_baru/{id}/hapus', [obrikController::class, 'hapus']);

Route::get('/rekap_LaporanBPK', [RekapController::class, 'rekapLaporanBPK']);

Route::get('/view/{iD}',[PageController::class,'view']);

Route::get('/simptl', function () {
    return view('simptl.template');
});
Route::get('jenisTemuan', [masterController::class, 'jenisTemuan']);
Route::get('rekomendasi', [masterController::class, 'rekomendasi']);
Route::get('rekom_baru', [masterController::class, 'rekomendasicreate']);
Route::get('pkpt', [PengawasanController::class, 'pkpt']);
Route::post('/pkpt_baru', [PengawasanController::class, 'store']);
Route::get('pkpt_tambah/{id}', [PengawasanController::class, 'pkptcreate']);
Route::get('pkpt_edit/{id}/edit', [PengawasanController::class, 'pkptedit']);
Route::put('pkpt_edit/{id}/edit', [PengawasanController::class, 'pkptupdate']);
Route::delete('pkpt_hapus/{id}', [PengawasanController::class, 'pkptHapus']);
Route::post('/pkpt_baru/{id}', [PengawasanController::class, 'pkptstore']);
Route::get('user', [ManajemenUseraController::class, 'pengguna']);
Route::get('tipeA', [PengawasanController::class, 'tipeA']);
Route::get('tipeB', [PengawasanController::class, 'tipeB']);
Route::get('tipeA_edit/{id}/edit', [PengawasanController::class, 'tipeAedit']);
Route::get('tipeB_edit/{id}/edit', [PengawasanController::class, 'tipeBedit']);

Route::post('/jenisTemuan/{id}', [PengawasanController::class, 'tipeBstore']);
Route::post('/jenisTemuanrekom/{id}', [PengawasanController::class, 'tipeAstore']);


Route::get('datadukung', [ManajemenObrikController::class, 'datadukung']);
Route::get('/tipeA_detail/{id}', [PengawasanController::class, "tipeAshow"]);

Route::get('/tipeB_detail/{id}', [PengawasanController::class, "tipeBshow"]);
Route::post('/caripenugasan', [PengawasanController::class, 'pkptCari']);

Route::get('cetakKendali', [KendaliController::class, 'cetakKendali']);
