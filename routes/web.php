<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\KursusController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KabupatenContoller;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ProvinsiController;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\KabupatenDropdownController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\PenggunaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('layouts');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['auth']], function() {
    // user
    Route::resource('pengguna', PenggunaController::class);
    route::get("edit-pengguna", [PenggunaController::class, "edit"]);
    // roles
    Route::resource('roles', RoleController::class);
    route::get("edit-roles", [RoleController::class, "edit"]);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // perusahaan
    Route::resource('perusahaan', PerusahaanController::class);
    // provinsi
    Route::resource('provinsi', ProvinsiController::class);
    route::get("edit-provinsi", [ProvinsiController::class, "edit"]);
    // kabupaten
    Route::resource('kabupaten', KabupatenContoller::class);
    route::get("edit-kabupaten", [KabupatenContoller::class, "edit"]);
    Route::get('kabupaten-dropdown/{id}',[KabupatenDropdownController::class,'__invoke'])->name('kabupaten.dropdown');
    //karyawan
    Route::resource('karyawan', KaryawanController::class);
    route::get("edit-karyawan", [KaryawanController::class, "edit"]);
    Route::get('karyawan-pdf', [KaryawanController::class, 'createPDF'])->name('karyawan.pdf');
    // kelas
    Route::resource('kelas', KelasController::class);
    route::get("edit-kelas", [KelasController::class, "edit"]);
    // cabang
    Route::resource('cabang', CabangController::class);
    route::get("edit-cabang", [CabangController::class, "edit"]);
    // kelas
    Route::resource('siswa', SiswaController::class);
    route::get("edit-siswa", [SiswaController::class, "edit"]);
    route::get("siswa-parent", [SiswaController::class, "tableparent"])->name('siswa.parent');
    route::get("status/update", [StatusController::class, "update"])->name('status.update');
    Route::resource('parent', ParentController::class);
     // cabang
     Route::resource('kursus', KursusController::class);
     route::get("edit-kursus", [KursusController::class, "edit"]);
     route::post("update-kursus", [KursusController::class, "update"])->name('kursus.update');
     // area
     Route::resource('area', AreaController::class);
});

require __DIR__.'/auth.php';
