<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SubjectController;


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
    return view('welcome');
});
Route::group(['middleware' => 'auth'], function () {
    Route::resource('faculties', FacultyController::class);
    Route::resource('students', StudentController::class);
    Route::resource('subjects', SubjectController::class);


    Route::get('/students/{student}/points', [StudentController::class, 'addPoint'])->name('students.addpoint.index');
    Route::post('/students/{student}/points', [StudentController::class, 'savePoint'])->name('students.savePoint');
    Route::get('/search', [StudentController::class, 'search'])->name('students.search');

    Route::get('/send-mail', [StudentController::class, 'sendMail'])->name('send-mail');

    Route::get('profile/{student}', [StudentController::class, 'showProfile'])->name('profile');


});

Route::get('login/auth/{provider}', [\App\Http\Controllers\Auth\LoginController::class, 'loginSocial'])->name('loginSocial');
Route::get('login/callback/{provider}', [\App\Http\Controllers\Auth\LoginController::class, 'socialCallback']);

Route::get('custom-register', [\App\Http\Controllers\Auth\RegisterController::class, 'getData'])->name('custom-register');
Route::post('register-user', [\App\Http\Controllers\Auth\RegisterController::class, 'customRegister'])->name('register-user');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();
