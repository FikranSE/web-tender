<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TenderController;
use App\Http\Controllers\PenawarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
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
  return view('index');
})->name('index');


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::controller(AuthController::class)->group(function () {
  Route::get('register', 'register')->name('register');
  Route::post('register', 'registerSave')->name('register.save');

  Route::get('login', 'login')->name('login');
  Route::post('login', 'loginAction')->name('login.action');

  Route::get('logout', 'logout')->middleware('auth')->name('logout');
});

//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {

  Route::get('/profile', [UserController::class, 'userprofile'])->name('profile');
  Route::get('/detailTender', [UserController::class, 'detailTender'])->name('detailTender');
  Route::get('/listTender', [UserController::class, 'listTender'])->name('listTender');
  Route::get('/informasiTender/{id}', [UserController::class, 'informasiTender'])->name('informasiTender');
  Route::get('/user/tender/{tender}/downloadDocPem', [TenderController::class, 'downloadDocPem'])
    ->name('user.tender.downloadDocPem');
  Route::post('/buatPenawaran', [userController::class, 'buatPenawaran'])->name('buatPenawaran');
});

//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
  Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin/home');
  Route::put('/admin/profile/update', [AdminController::class, 'updateProfile'])->name('admin/profile/update');

  Route::get('/admin/profile', [AdminController::class, 'profilepage'])->name('admin/profile');
  //  paket
  Route::get('/admin/products', [PaketController::class, 'index'])->name('admin/products');
  Route::get('/admin/products/create', [PaketController::class, 'create'])->name('admin/products/create');
  Route::post('/admin/products/store', [PaketController::class, 'store'])->name('admin/products/store');
  Route::get('/admin/products/show/{id}', [PaketController::class, 'show'])->name('admin/products/show');
  Route::get('/admin/products/edit/{id}', [PaketController::class, 'edit'])->name('admin/products/edit');
  Route::put('/admin/products/edit/{id}', [PaketController::class, 'update'])->name('admin/products/update');
  Route::delete('/admin/products/destroy/{id}', [PaketController::class, 'destroy'])->name('admin/products/destroy');

  // tender
  Route::get('/admin/tender', [TenderController::class, 'index'])->name('admin/tender');
  Route::get('/admin/tender/create', [TenderController::class, 'create'])->name('admin/tender/create');
  Route::post('/admin/tender/store', [TenderController::class, 'store'])->name('admin/tender/store');
  Route::get('/admin/tender/show/{id}', [TenderController::class, 'show'])->name('admin/tender/show');
  Route::get('/admin/tender/edit/{id}', [TenderController::class, 'edit'])->name('admin/tender/edit');
  Route::put('/admin/tender/update/{id}', [TenderController::class, 'update'])->name('admin.tender.update');
  Route::delete('/admin/tender/destroy/{id}', [TenderController::class, 'destroy'])->name('admin/tender/destroy');
  Route::get('/admin/tender/{tender}/downloadDocPem', [TenderController::class, 'downloadDocPem'])
    ->name('admin.tender.downloadDocPem');
    Route::get('/admin/tender/{tender}/downloadBerita', [TenderController::class, 'downloadBerita'])
    ->name('admin.tender.downloadBerita');

    //penawaran
    Route::resource('/penawaran', PenawarController::class);

    
  
});