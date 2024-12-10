<?php

use App\Models\LHP;
use App\Models\PDF;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SKController;
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
use App\Http\Controllers\KendaliController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PangkatController;
// use App\Http\Controllers\skpdController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\simptl\masterController;
use App\Http\Controllers\JenisPengawasanController;
use App\Http\Controllers\Absensi\PresensiController;
use App\Http\Controllers\simptl\PenggunaController2;
use App\Http\Controllers\Absensi\DashboardController;
use App\Http\Controllers\simptl\PengawasanController;
use App\Http\Controllers\simptl\ManajemenObrikController;
use App\Http\Controllers\simptl\ManajemenUseraController;

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
    return Hash::make("inspeksi2017");
});

Route::get('/tes', function () {
    return Hash::make("123");
});

Route::get('/absensi_thl', [DashboardController::class, 'index']);
Route::get('/', function () {
    return view('login');
});
Route::get('/absen', function () {
    return view('absensi.login');
});

// Route::get('presensi_create', function () {
//     return view('absensi.tombol.create');
// });

Route::get('/presensi_create', [PresensiController::class, 'create']);
Route::post('/presensi/store', [PresensiController::class, 'store']);

Route::post('/absen_thl', [DashboardController::class, 'LoginAbsen']);
// Route::get('/admin', [skpdController::class, 'admin']);
Route::get('/index', [SkpdController::class, 'tampil']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/logout_simptl', [PenggunaController2::class, 'logout']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/reload-captcha', [UserController::class, 'reloadCaptcha']);
Route::get('/skpd', [SkpdController::class, 'index']);
Route::put('/skpd_edit', [SkpdController::class, 'update']);
Route::put('/nomor_edit', [SkpdController::class, 'updatenomor']);

Route::get('/SK_Perbub', [SKController::class, 'index']);
Route::get('/SK_Perbub_baru', [SKController::class, 'create']);
Route::post('/SK_Perbub_baru', [SKController::class, 'store']);

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

Route::get('/kendali/{bulan?}', [KendaliController::class, 'index']);

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

Route::get('/report_PKPT', [RekapController::class, 'reportPKPT']);
Route::get('/rekap_PerjalananPDF', [RekapController::class, 'rekapPerjalananPDF']);
Route::get('/rekap_PerjalananPegawai', [RekapController::class, 'rekapPerjalananPegawai']);
Route::get('/rekap_PerjalananPegawaiPDF', [RekapController::class, 'rekapPerjalananPegawaiPDF']);

Route::get('/monevrkpd', [RekapController::class, 'rekapMonev']);
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
Route::post('/simptl/ubahtahun', [PenggunaController2::class, 'ubahtahun']);
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
Route::get('/laporanKinerja', [LaporanController::class, 'lapkinerja']);
Route::get('/laporanKegiatanPDF', [LaporanController::class, 'indexPDF']);
// Route::get('/kendaraan_create', [KendaraanController::class, 'kendaraanCreate']);
Route::post('/rekap_laporanKegiatan', [LaporanController::class, 'rekapLaporanKegiatan']);
Route::post('/rekap_laporanKegiatanPDF', [LaporanController::class, 'rekapLaporanKegiatanPDF']);
Route::post('/rekap_laporanKinerja', [LaporanController::class, 'rekapLaporanKinerja']);

Route::get('/rincianrkpd', [LaporanController::class, 'rkpd']);
// Route::get('/kendaraan_create', [KendaraanController::class, 'kendaraanCreate']);
Route::post('/rekap_rincianRKPD', [LaporanController::class, 'rekapLaporanMonev']);

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

Route::get('/tte_trial', [TTEController::class, 'tte_trial']);
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
    return view('simptl.login');
});

// Route::get('/simptl/user', function () {
//     return view('simptl.obrik.home');
// });

// Route::get('/simptl', function () {
//     return view('simptl.template');
// });
Route::get('/logout', [UserController::class, 'logout']);
Route::post('/login_user', [PenggunaController2::class, 'login']);
// Route::get('jenisTemuan', [masterController::class, 'jenisTemuan'])->middleware("Cekadmin");;
// Route::get('rekomendasi', [masterController::class, 'rekomendasi']);
// Route::get('rekom_baru', [masterController::class, 'rekomendasicreate']);
// Route::get('simptl/admin', [PengawasanController::class, 'index']);
// Route::post('/login_admin', [PengawasanController::class, 'loginAdmin']);
Route::get('simptl/user', [PengawasanController::class, 'tes']);
Route::get('simptl/pkpt', [PengawasanController::class, 'pkpt']);
Route::post('simptl/pkpt_baru', [PengawasanController::class, 'store']);
Route::get('simptl/pkpt_tambah/{id}', [PengawasanController::class, 'pkptcreate']);
Route::get('simptl/pkpt_edit/{id}/edit', [PengawasanController::class, 'pkptedit']);
Route::put('simptl/pkpt_edit/{id}/edit', [PengawasanController::class, 'pkptupdate']);
Route::delete('simptl/pkpt_hapus/{id}', [PengawasanController::class, 'pkptHapus']);
Route::post('simptl/pkpt_baru/{id}', [PengawasanController::class, 'pkptstore']);

// Route::post('/user_baru/{id}', [PengawasanController::class, 'userstore']);
Route::post('simptl/pkpt/cari', [PengawasanController::class, 'pkptCari']);
// Route::get('user', [PenggunaController2::class, 'pengguna']);
Route::get('simptl/tipeA', [PengawasanController::class, 'tipeA']);
Route::get('simptl/tipeB', [PengawasanController::class, 'tipeB']);
Route::get('simptl/tipeA_edit/{id}/edit', [PengawasanController::class, 'tipeAedit']);
Route::get('simptl/tipeB_edit/{id}/edit', [PengawasanController::class, 'tipeBedit']);

Route::post('simptl/jenisTemuan/{id}', [PengawasanController::class, 'tipeBstore']);
Route::post('simptl/jenisTemuanrekom/{id}', [PengawasanController::class, 'tipeAstore']);
Route::put('simptl/updatejenisTemuanrekom/{id}', [PengawasanController::class, 'tipeAupdate']);


Route::get('simptl/datadukung', [ManajemenObrikController::class, 'datadukung']);
Route::get('simptl/tipeA_detail/{id}', [PengawasanController::class, "tipeAshow"]);

Route::get('/tipeB_detail/{id}', [PengawasanController::class, "tipeBshow"]);
Route::post('simptl/caripenugasan', [PengawasanController::class, 'pkptCari']);

Route::get('cetakKendali/{bulan}', [KendaliController::class, 'cetakKendali']);


Route::get('simptl/datadukung', [PengawasanController::class, 'datadukung']);
Route::get('simptl/datadukung_detail/{id}', [PengawasanController::class, "datadukungShow"]);
Route::post('simptl/UploadDatadukung/{id}', [PengawasanController::class, 'UploadDatadukung']);

Route::get('user_baru', [PenggunaController2::class, 'penggunacreate']);
Route::get('simptl/pengguna', [PenggunaController2::class, 'pengguna']);
Route::get('simptl/pengguna_create', [PenggunaController2::class, 'penggunacreate']);
Route::post('simptl/pengguna_store', [PenggunaController2::class, 'penggunastore']);
Route::post('simptl/login_admin', [PengawasanController::class, 'loginAdmin']);
Route::post('simptl/penggunastore', [PenggunaController2::class, 'penggunastore']);

Route::get('surat_baru/{id}', [TTEController::class, 'suratBaru']);
Route::post('surat_store/{id}', [TTEController::class, 'suratStore']);
Route::get('hapus_surat/{id}', [TTEController::class, 'hapusSurat']);

Route::get('/searchJP', [PengawasanController::class, 'searchJP']);
Route::get('/searchObrik', [PengawasanController::class, 'searchObrik']);

Route::get('simptl/data_dukung/tipeA/{id}', [PengawasanController::class, "tipeAshow"]);

Route::get('simptl/data_dukungRekom', [PengawasanController::class, 'datadukungTipeA']);
Route::get('simptl/data_dukungTemuanRekom', [PengawasanController::class, 'datadukungTipeB']);

Route::get('simptl/datadukung_editRekom/{id}/edit', [PengawasanController::class, 'datadukungTipeAEdit']);

Route::post('simptl/datadukung_editRekom/{id}', [PengawasanController::class, 'datadukungtipeAstore']);

Route::get('simptl/datadukung_editTemuan/{id}/edit', [PengawasanController::class, 'datadukungTipeBEdit']);

Route::post('simptl/datadukung_editTemuan/{id}', [PengawasanController::class, 'datadukungtipeBstore']);

Route::get('/viewBerkas/{filename}', [PengawasanController::class, 'viewBerkas']);


Route::get('/sk_viewPDF/{id}/view', [SKController::class, 'view']);
