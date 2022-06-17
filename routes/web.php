<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

Auth::routes();


Route::get('/404', [App\Http\Controllers\HomeController::class, 'tolak'])->name('tolak');
Route::get('/daftar', [App\Http\Controllers\HomeController::class, 'daftar'])->name('daftar');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_admin');
Route::get('/peristiwa', [App\Http\Controllers\PeristiwaController::class, 'index'])->name('home')->middleware('is_admin');
Route::get('admin/home', [HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::get('aduan/json', [App\Http\Controllers\AduanController::class, 'titik'])->middleware('is_admin');
//peristiwa
Route::get('peristiwa/json', [App\Http\Controllers\PeristiwaController::class, 'titik'])->middleware('is_admin');
Route::get('/peristiwa', [App\Http\Controllers\PeristiwaController::class, 'index'])->name('kantor')->middleware('is_admin');
Route::get('/peristiwa/cari', [App\Http\Controllers\PeristiwaController::class, 'cari'])->name('cari')->middleware('is_admin');
Route::get('/peristiwa/create', [App\Http\Controllers\PeristiwaController::class, 'create'])->name('create')->middleware('is_admin');
Route::post('/peristiwa/store', [App\Http\Controllers\PeristiwaController::class, 'store'])->name('store')->middleware('is_admin');
Route::get('/peristiwa/{peristiwa:id}/read', [App\Http\Controllers\PeristiwaController::class, 'read'])->name('read')->middleware('is_admin');
Route::get('/peristiwa/{peristiwa:id}/edit', [App\Http\Controllers\PeristiwaController::class, 'edit'])->name('edit')->middleware('is_admin');
Route::put('/peristiwa/{peristiwa:id}/update', [App\Http\Controllers\PeristiwaController::class, 'update'])->name('update')->middleware('is_admin');
Route::delete('/peristiwa/{peristiwa:id}/delete', [App\Http\Controllers\PeristiwaController::class, 'destroy'])->name('delete')->middleware('is_admin');
//kantor
Route::get('kantor/json', [App\Http\Controllers\KantorController::class, 'titik'])->middleware('is_admin');
Route::get('/kantor', [App\Http\Controllers\KantorController::class, 'index'])->name('kantor')->middleware('is_admin');
Route::get('/kantor/cari', [App\Http\Controllers\KantorController::class, 'cari'])->name('cari')->middleware('is_admin');
Route::get('/kantor/create', [App\Http\Controllers\KantorController::class, 'create'])->name('create')->middleware('is_admin');
Route::post('/kantor/store', [App\Http\Controllers\KantorController::class, 'store'])->name('store')->middleware('is_admin');
Route::get('/kantor/{kantor:id}/read', [App\Http\Controllers\KantorController::class, 'read'])->name('read')->middleware('is_admin');
Route::get('/kantor/{kantor:id}/edit', [App\Http\Controllers\KantorController::class, 'edit'])->name('edit')->middleware('is_admin');
Route::put('/kantor/{kantor:id}/update', [App\Http\Controllers\KantorController::class, 'update'])->name('update')->middleware('is_admin');
Route::delete('/kantor/{kantor:id}/delete', [App\Http\Controllers\KantorController::class, 'destroy'])->name('delete')->middleware('is_admin');
Auth::routes();
//akun
Route::get('/akun', [App\Http\Controllers\AkunController::class, 'index'])->name('akun')->middleware('is_admin');
Route::get('/akun/cari', [App\Http\Controllers\AkunController::class, 'cari'])->name('cari')->middleware('is_admin');
Route::get('/akun/create', [App\Http\Controllers\AkunController::class, 'create'])->name('create')->middleware('is_admin');
Route::post('/akun/store', [App\Http\Controllers\AkunController::class, 'store'])->name('store')->middleware('is_admin');
Route::get('/akun/{akun:id}/read', [App\Http\Controllers\AkunController::class, 'read'])->name('read')->middleware('is_admin');
Route::get('/akun/{akun:id}/edit', [App\Http\Controllers\AkunController::class, 'edit'])->name('edit')->middleware('is_admin');
Route::put('/akun/{akun:id}/update', [App\Http\Controllers\AkunController::class, 'update'])->name('update')->middleware('is_admin');
Route::delete('/akun/{akun:id}/delete', [App\Http\Controllers\AkunController::class, 'destroy'])->name('delete')->middleware('is_admin');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
