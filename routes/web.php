<?php

use App\Http\Controllers\Admin\CvController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\PerusahaanController;

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

Route::get('/login',[LoginController::class,'index'])->name('login');
Route::get('/forget-password',[LoginController::class,'viewForgetPassword']);

Route::post('/proses-login',[LoginController::class,'prosesLogin']);
Route::get('/logout',[LoginController::class,'logout']);

Route::group(['middleware' => ['auth:user']],function(){
    Route::group(['middleware' => ['cek_login:1']], function () {
    Route::get('/admin',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::prefix('admin')->group(function () {
            Route::controller(CvController::class)->group(function (){
                Route::get('/cv','show')->name('admin.cv');
                Route::post('/cv','update')->name('admin.cv.update');
            });

            Route::controller(ProdukController::class)->group(function (){
                Route::get('/produk','show')->name('admin.produk');
                Route::get('/produk/create', 'create')->name('admin.produk.create');
                Route::post('/produk','store')->name('admin.produk.store');
                Route::get('/produk/{slug}/edit', 'edit')->name('admin.produk.edit');
                Route::post('/produk/{id}/update','update')->name('admin.produk.update');
                Route::get('/produk/{id}/delete', 'destroy')->name('admin.produk.delete');
            });

            Route::controller(PerusahaanController::class)->group(function (){
                Route::get('/perusahaan', 'show')->name('admin.perusahaan');
                Route::get('/perusahaan/create', 'create')->name('admin.perusahaan.create');
                Route::post('/perusahaan', 'store')->name('admin.perusahaan.store');
                Route::get('/perusahaan/{slug}/edit', 'edit')->name('admin.perusahaan.edit');
                Route::post('/perusahaan/{id}/update', 'update')->name('admin.perusahaan.update');
                Route::get('/perusahaan/{id}/delete', 'destroy')->name('admin.perusahaan.delete');

            });

            Route::controller(KaryawanController::class)->group(function (){
                Route::get('/karyawan', 'show')->name('admin.karyawan');
                Route::get('/karyawan/create', 'create')->name('admin.karyawan.create');
                Route::post('/karyawan', 'store')->name('admin.karyawan.store');
                Route::get('/karyawan/{slug}/edit', 'edit')->name('admin.karyawan.edit');
                Route::get('/karyawan/{id}/reset-password', 'resetPassword')->name('admin.karyawan.reset');
            });

            Route::controller(QuotationController::class)->group(function (){
                //Draft Quotation
                Route::get('/quotation', 'show')->name('admin.quotation');
                Route::get('/quotation-draft', 'showDraft')->name('admin.quotation.draft');
                Route::get('/quotation-draft/create', 'create')->name('admin.quotation.draft.create');
                Route::post('/quotation-draft', 'store')->name('admin.quotation.draft.store');
                Route::get('/quotation/{id}/view' ,'viewQto')->name('admin.quotation.view');
                Route::get('/quotation-draft/{id}/confirm', 'confirmQto')->name('admin.quotation.set.confirm');
                Route::get('/quotation-draft/{id}/selesai', 'doneQto')->name('admin.quotation.set.selesai');
                //Confirm Quotation
                Route::get('/quotation-confirmed', 'showConf')->name('admin.quotation.confirmed');
                //Print
                Route::get('/quotation/{id}/print', 'print')->name('admin.quotation.print');
                //Kirim Email
                Route::get('/quotation/{id}/email' ,'emailcustomer')->name('admin.quotation.email');
                //End Draft Quotation
            });
            Route::controller(InvoiceController::class)->group(function (){
                Route::get('/invoice','show')->name('admin.invoice');
                //Draf Invoice
                Route::get('/invoice-draft', 'showDraft')->name('admin.invoice.draft');
                Route::get('/invoice-draft/create', 'create')->name('admin.invoice.draft.create');
                Route::post('/invoice-draf', 'store')->name('admin.invoice.draft.store');
                Route::get('/invoice/{id}/view' ,'viewInv')->name('admin.invoice.view');
                Route::get('/invoice-draft/{id}/confirm', 'confirmInv')->name('admin.invoice.set.confirm');

                Route::get('/invoice/{id}/print', 'print')->name('admin.invoice.print');
                Route::get('/invoice-confirmed', 'showConf')->name('admin.invoice.confirmed');
                Route::get('/invoice-draft/{id}/selesai', 'doneInv')->name('admin.invoice.set.selesai');
            });

        });
    });
});


