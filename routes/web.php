<?php

use App\Http\Controllers\Admin\CvController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\PerusahaanController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Karyawan\KaryawanProfileController;
use App\Http\Controllers\Karyawan\KaryawanProjectController;
use App\Http\Controllers\Karyawan\KaryawanQuotationController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/forget-password', [LoginController::class, 'viewForgetPassword']);

Route::post('/proses-login', [LoginController::class, 'prosesLogin']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth:user']], function () {
    Route::group(['middleware' => ['cek_login:1']], function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::prefix('admin')->group(function () {
            Route::controller(CvController::class)->group(function () {
                Route::get('/cv', 'show')->name('admin.cv');
                Route::post('/cv', 'update')->name('admin.cv.update');
            });

            Route::controller(ProdukController::class)->group(function () {
                Route::get('/produk', 'show')->name('admin.produk');
                Route::get('/produk/create', 'create')->name('admin.produk.create');
                Route::post('/produk', 'store')->name('admin.produk.store');
                Route::get('/produk/{slug}/edit', 'edit')->name('admin.produk.edit');
                Route::post('/produk/{id}/update', 'update')->name('admin.produk.update');
                Route::get('/produk/{id}/delete', 'destroy')->name('admin.produk.delete');
            });

            Route::controller(PerusahaanController::class)->group(function () {
                Route::get('/perusahaan', 'show')->name('admin.perusahaan');
                Route::get('/perusahaan/create', 'create')->name('admin.perusahaan.create');
                Route::post('/perusahaan', 'store')->name('admin.perusahaan.store');
                Route::get('/perusahaan/{slug}/edit', 'edit')->name('admin.perusahaan.edit');
                Route::post('/perusahaan/{id}/update', 'update')->name('admin.perusahaan.update');
                Route::get('/perusahaan/{id}/delete', 'destroy')->name('admin.perusahaan.delete');
            });

            Route::controller(KaryawanController::class)->group(function () {
                Route::get('/karyawan', 'show')->name('admin.karyawan');
                Route::get('/karyawan/create', 'create')->name('admin.karyawan.create');
                Route::post('/karyawan', 'store')->name('admin.karyawan.store');
                Route::get('/karyawan/{slug}/edit', 'edit')->name('admin.karyawan.edit');
                Route::get('/karyawan/{id}/reset-password', 'resetPassword')->name('admin.karyawan.reset');
            });

            Route::controller(QuotationController::class)->group(function () {
                //Draft Quotation
                Route::get('/quotation', 'show')->name('admin.quotation');
                Route::get('/quotation-draft', 'showDraft')->name('admin.quotation.draft');
                Route::get('/quotation-draft/create', 'create')->name('admin.quotation.draft.create');
                Route::post('/quotation-draft', 'store')->name('admin.quotation.draft.store');
                Route::get('/quotation/{id}/view', 'viewQto')->name('admin.quotation.view');
                Route::get('/quotation-draft/{id}/confirm', 'confirmQto')->name('admin.quotation.set.confirm');
                Route::get('/quotation-draft/{id}/selesai', 'doneQto')->name('admin.quotation.set.selesai');
                //Confirm Quotation
                Route::get('/quotation-confirmed', 'showConf')->name('admin.quotation.confirmed');
                //Print
                Route::get('/quotation/{id}/print', 'print')->name('admin.quotation.print');
                //Kirim Email
                Route::get('/quotation/{id}/email', 'emailcustomer')->name('admin.quotation.email');
                //End Draft Quotation
            });
            Route::controller(InvoiceController::class)->group(function () {
                Route::get('/invoice', 'show')->name('admin.invoice');
                //Draf Invoice
                Route::get('/invoice-draft', 'showDraft')->name('admin.invoice.draft');
                Route::get('/invoice-draft/create', 'create')->name('admin.invoice.draft.create');
                Route::post('/invoice-draf', 'store')->name('admin.invoice.draft.store');
                Route::get('/invoice/{id}/view', 'viewInv')->name('admin.invoice.view');
                Route::get('/invoice-draft/{id}/confirm', 'confirmInv')->name('admin.invoice.set.confirm');

                Route::get('/invoice/{id}/print', 'print')->name('admin.invoice.print');
                Route::get('/invoice-confirmed', 'showConf')->name('admin.invoice.confirmed');
                Route::get('/invoice-draft/{id}/selesai', 'doneInv')->name('admin.invoice.set.selesai');
            });

            Route::controller(ProjectController::class)->group(function () {
                Route::get('/project', 'index')->name('admin.project');
                Route::get('/project-ongoing', 'showOngoing')->name('admin.project.ongoing');
                Route::get('/project-ongoing/{id}/edit', 'edit')->name('admin.project.ongoing.edit');
                Route::post('/project-ongoing/{id}/update', 'update')->name('admin.project.ongoing.update');
                Route::get('/project-done', 'showDone')->name('admin.project.done');
                Route::get('/project-done/{id}/view', 'editDone')->name('admin.project.done.edit');
                //Draf Invoice
            });

            Route::controller(DeliveryController::class)->group(function () {
                Route::get('/delivery', 'index')->name('admin.delivery');
                Route::get('/delivery-draft', 'showDraft')->name('admin.delivery.draft');
                Route::get('/delivery-confirmed', 'showConf')->name('admin.delivery.confirmed');
                Route::get('/delivery-draft/create', 'create')->name('admin.delivery.draft.create');
                Route::post('/delivery-draft', 'store')->name('admin.delivery.draft.store');
                Route::get('/delivery-draft/{id}/edit', 'edit')->name('admin.delivery.draft.edit');
                Route::post('/delivery-draft/{id}/edit', 'update')->name('admin.delivery.draft.update');
                Route::get('/deliver-draft/{id}/delete', 'destroy')->name('admin.delivery.draft.delete');
            });
        });
    });
});

Route::group(['middleware' => ['auth:user']], function () {
    Route::group(['middleware' => ['cek_login:2']], function () {
        Route::get('/karyawan', [DashboardController::class, 'index'])->name('karyawan.dashboard');

        Route::prefix('karyawan')->group(function () {
            Route::controller(KaryawanQuotationController::class)->group(function () {
                Route::get('/quotation', 'index')->name('karyawan.quotation');
            });

            Route::controller(KaryawanProjectController::class)->group(function (){
                Route::get('/project/ongoing','viewOngoing')->name('karyawan.project.ongoing');
                Route::get('/project/done','viewDone')->name('karyawan.project.done');

                Route::get('/project/{id}', 'viewDetail')->name('karyawan.project.ongoing.edit');
                Route::post('/project/{id}', 'update')->name('karyawan.project.ongoing.update');

                Route::post('/project/{id}/logbook', 'storeLogbook')->name('karyawan.project.ongoing.store.lobgook');
                Route::get('/project/{id}/logbook/delete', 'deleteLogbook')->name('karyawan.project.ongoing.delete.lobgook');
            });

            Route::controller(KaryawanProfileController::class)->group(function (){
                Route::get('/profile','index')->name('karyawan.profile');
                Route::post('/profile','updateProfile')->name('karyawan.update.profile');
                Route::post('/profile/password','updatePassword')->name('karyawan.update.password');
            });
        });
    });
});
