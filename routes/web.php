<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

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
return view('auth.login');
});

Auth::routes([
'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');

Route::get('/create-users', [App\Http\Controllers\HomeController::class, 'create'])
->middleware('role:admin')
->name('create-users');
Route::post('/create-users', [App\Http\Controllers\HomeController::class, 'store'])
->middleware('role:admin')
->name('store-users');

Route::get('/show-users', [App\Http\Controllers\HomeController::class, 'show'])
->middleware('role:admin')
->name('show-users');

Route::get('/users/{id}/edit', [App\Http\Controllers\HomeController::class, 'edit'])
->middleware('role:admin')
->name('edit-user');

Route::put('/users/{id}', [App\Http\Controllers\HomeController::class, 'update'])
->middleware('role:admin')
->name('update-user');

Route::delete('/users/{id}', [App\Http\Controllers\HomeController::class, 'destroy'])
->middleware('role:admin')
->name('delete-user');



Route::get('/records', [App\Http\Controllers\SessionController::class, 'index'])
->middleware('roleAccess')
->name('records');


Route::get('/create-record', [App\Http\Controllers\SessionController::class, 'createRecord'])
->middleware('roleAccess')
->name('create-record');

Route::post('/create-record', [App\Http\Controllers\SessionController::class, 'store'])
->middleware('roleAccess')
->name('store');

Route::get('/edit-record/{id}', [App\Http\Controllers\SessionController::class, 'edit'])
->middleware('roleAccess')
->name('edit-record');

Route::put('/edit-record/{id}', [App\Http\Controllers\SessionController::class, 'update'])
->middleware('roleAccess')
->name('update-record');

Route::delete('/delete-record', [App\Http\Controllers\SessionController::class, 'destroy'])
->middleware('roleAccess')
->name('delete-record');




Route::get('/history', [StudentController::class, 'showHistory'])->name('history')
->middleware('role:student')
->name('student-history');


Route::middleware('all')->group(function () {
    Route::get('/user/change-password', [UserController::class, 'showChangePasswordForm'])->name('user.change-password');
    Route::put('/user/update-password', [UserController::class, 'updatePassword'])->name('user.update-password');
});

