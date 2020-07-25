<?php

use Illuminate\Support\Facades\Auth;
use UniSharp\LaravelFilemanager\Lfm;
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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes(['verify' => true]);
Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'role:guru'], function () {

    Route::resource('guru', 'GuruController');

    Route::resource('siswa', 'SiswaController');
    Route::post('siswa/aktif/{id}', 'SiswaController@aktif')->name('siswa.aktif');
    Route::post('siswa/suspend/{id}', 'SiswaController@suspend')->name('siswa.suspend');
    Route::resource('kelas', 'KelasController', [
        'except' => ['create']
    ]);
    Route::resource('semester', 'SemesterController');
    Route::post('semester/suspend/{id}', 'SemesterController@suspend')->name('semester.suspend');
    Route::post('semester/aktif/{id}', 'SemesterController@aktif')->name('semester.aktif');

    Route::get('absensi', 'AbsenController@index')->name('absensi.index');
    Route::get('laporan-harian-siswa', 'AbsenController@laporanHarian')->name('absensi.harian');
    Route::get('laporan-harian-kelas', 'AbsenController@laporanHarianKelas')->name('absensi.kelas.harian');
    Route::get('laporan-harian-siswa-tidak-hadir', 'AbsenController@laporanHarianTidakHadir')->name('absensi.tidakhadir.harian');

    Route::get('modul-pelajaran/create', 'ModulController@create')->name('modul.create');
    Route::post('modul-pelajaran/store', 'ModulController@store')->name('modul.store');
    Route::delete('modul-pelajaran/{id}', 'ModulController@destroy')->name('modul.destroy');
    Route::get('modul-pelajaran/{id}/edit', 'ModulController@edit')->name('modul.edit');
    Route::patch('modul-pelajaran/{id}/update', 'ModulController@update')->name('modul.update');

    Route::get('registrasi-siswa', 'SiswaController@registrasi')->name('registrasi.siswa');
    Route::post('registrasi-siswa/{id}/setujui', 'SiswaController@setujui')->name('siswa.setujui');

    Route::resource('mapel', 'MapelController');

    // Route::resource('quiz', 'QuizController');
    // Route::get('tipe-soal/{id}/{judul}', 'QuizController@tipeSoal')->name('quiz.tipeSoal');
    // Route::get('create-soal-pilihan-ganda/{id}/{judul}', 'QuizPilgandaController@index')->name('soal.pilGanda');
    // Route::post('pilihan-ganda-store/{id}/{judul}', 'QuizPilgandaController@store')->name('soal.pilGanda.store');
    // Route::post('soal-publish/{id}/{judul}', 'QuizPilgandaController@publish')->name('soal.pilGanda.publish');
    // Route::post('soal-unpublish/{id}/{judul}', 'QuizPilgandaController@unPublish')->name('soal.unpublish');
    // Route::get('pilihan-ganda/{id}/{judul}/edit', 'QuizPilgandaController@edit')->name('soal.pilGanda.edit');
    // Route::patch('pilihan-ganda/{id}/{judul}', 'QuizPilgandaController@update')->name('soal.pilGanda.update');
    // Route::delete('pilihan-ganda/{id}/delete', 'QuizPilgandaController@destroy')->name('soal.pilGanda.delete');
    // Route::get('create-soal-Essay/{id}/{judul}', 'QuizEssayController@index')->name('soal.Essay');
    // Route::post('soal-essay-store/{id}/{judul}', 'QuizEssayController@store')->name('soal.Essay.store');
    // Route::get('list-soal-pilihan-ganda/{id}/{judul}', 'QuizPilgandaController@show')->name('soal.show');

    // Route::get('list-soal-essay/{id}/{judul}', 'QuizEssayController@show')->name('soal.Essay.show');
    // Route::get('soal-essay/{id}/{judul}/edit', 'QuizEssayController@edit')->name('soal.Essay.edit');
    // Route::patch('soal-essay/{id}/{judul}', 'QuizEssayController@update')->name('soal.Essay.update');
    // Route::delete('soal-essay/{id}/delete', 'QuizEssayController@destroy')->name('soal.Essay.delete');
    Route::get('tugas-masuk', 'TugasController@tugasMasuk')->name('tugas.masuk.index');
    Route::delete('tugas-masuk/{id}', 'TugasController@destroy')->name('delete.tugas.siswa');
});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});

Route::group(['middleware' => ['web', 'auth']], function () {
    Route::get('profile/{username}', 'SiswaController@show')->name('siswa.show');
    Route::get('siswa/{username}', 'SiswaController@update')->name('siswa.update');
    Route::post('siswa/email/change/{id}', 'SiswaController@changeEmail')->name('siswa.changeEmail');
    Route::post('siswa/password/change/{id}', 'SiswaController@changePassword')->name('siswa.changePassword');
    Route::get('modul-pelajaran', 'ModulController@index')->name('modul.index');
    Route::get('modul-pelajaran/{id}', 'ModulController@show')->name('modul.show');
    Route::get('modul-pelajaran/{user_id}/{id}/{file}/download', 'ModulController@fileDownload')->name('modul.fileDownload');

    Route::get('absen-siswa', 'AbsenPendingController@index')->name('absen.absen');
    Route::post('absen/submit/{ket}', 'AbsenPendingController@hadir')->name('absen.submit');
    Route::post('absenPending/{id}/submit', 'AbsenPendingController@konfirmasi')->name('absenPending.konfirmasi');

    Route::get('send-file', 'TugasController@index')->name('send.tugas');
    Route::post('file/send', 'TugasController@store')->name('tugas.store');

    Route::get('tugas-masuk/{id}', 'TugasController@show')->name('tugas.masuk.show');
    Route::get('tugas-masuk/{id}/{file}/download', 'TugasController@fileDownload')->name('download.tugas.siswa');

    // Route::get('daftar-quiz', 'QuizController@indexSiswa')->name('quiz.siswa.index');
    // Route::get('information-quiz/{id}/{judul}', 'QuizController@information')->name('quiz.information');
    // Route::get('quiz-start/{id}/{judul}', 'QuizController@start')->name('quiz.start');
});
Route::post('email/cek', 'SiswaController@cekEmail')->name('siswa.email.cek');
Route::post('username/cek', 'SiswaController@cekUsername')->name('siswa.username.cek');
Route::post('nis/cek', 'SiswaController@cekNis')->name('siswa.nis.cek');
Route::post('nip/cek', 'GuruController@cekNip')->name('guru.nip.cek');
