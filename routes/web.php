<?php

use App\Http\Controllers\Admin\ArchiveController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProdukController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\QuotationController;
use App\Http\Controllers\Admin\PerusahaanController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\CvController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Karyawan\KaryawanProfileController;
use App\Http\Controllers\Karyawan\KaryawanProjectController;
use App\Http\Controllers\Karyawan\KaryawanQuotationController;
use App\Http\Controllers\Manager\ManagerDeliveryController;
use App\Http\Controllers\Manager\ManagerInvoiceController;
use App\Http\Controllers\Manager\ManagerKaryawanController;
use App\Http\Controllers\Manager\ManagerPerusahaanController;
use App\Http\Controllers\Manager\ManagerProdukController;
use App\Http\Controllers\Manager\ManagerProjectController;
use App\Http\Controllers\Manager\ManagerQuotationController;
use App\Http\Controllers\ManagerProfileController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/forget-password', [LoginController::class, 'viewForgetPassword']);

Route::post('/proses-login', [LoginController::class, 'prosesLogin']);
Route::get('/logout', [LoginController::class, 'logout']);

Route::group(['middleware' => ['auth:user']], function () {
    Route::group(['middleware' => ['cek_login:1']], function () {
        Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/profile',[ProfileController::class,'index'])->name('admin.profile');
        Route::post('/admin/profile',[ProfileController::class,'update'])->name('admin.profile.update');
        Route::post('/admin/profile/password',[ProfileController::class,'password_update'])->name('admin.profile.password');
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
                Route::post('/karyawan/{slug}/update', 'update')->name('admin.karyawan.update');
                Route::get('/karyawan/{id}/reset-password', 'resetPassword')->name('admin.karyawan.reset');
                Route::get('/karyawan/{id}/delete', 'destroy')->name('admin.karyawan.delete');
            });

            Route::controller(QuotationController::class)->group(function () {
                //Draft Quotation
                Route::get('/quotation', 'show')->name('admin.quotation');
                Route::get('/quotation-draft', 'showDraft')->name('admin.quotation.draft');
                Route::get('/quotation-draft/create', 'create')->name('admin.quotation.draft.create');
                Route::post('/quotation-draft', 'store')->name('admin.quotation.draft.store');
                Route::get('/quotation/{id}/view', 'viewQto')->name('admin.quotation.view');
                Route::get('/quotation-draft/{id}/draft', 'draftQto')->name('admin.quotation.set.draft');
                Route::get('/quotation-draft/{id}/penging', 'pendingQto')->name('admin.quotation.set.pending');
                Route::post('/quotation-draft/{id}/confirm', 'confirmQto')->name('admin.quotation.set.confirm');
                Route::get('/quotation-draft/{id}/selesai', 'doneQto')->name('admin.quotation.set.selesai');
                Route::get('/quotation-draft/{id}/archive', 'archiveQto')->name('admin.quotation.set.archive');
                Route::get('/quotation-draft/{id}/reject', 'rejectQto')->name('admin.quotation.set.reject');

                //Confirm Quotation
                Route::get('/quotation-confirmed', 'showConf')->name('admin.quotation.confirmed');
                //Print
                Route::get('/quotation/{id}/print', 'print')->name('admin.quotation.print');
                // Route::get('/quotation/{id}/email', 'emailcustomer')->name('admin.quotation.email');

                Route::get('/quotation/{id}/edit', 'edit')->name('admin.quotation.edit');
                Route::post('/quotation/{id}/update', 'update')->name('admin.quotation.draft.update');
                Route::get('/quotation/{id}/delete' ,'destroy')->name('admin.quotation.delete');
                Route::get('/quotation/{id}/mail', 'sendQuotationMail')->name('admin.quotation.email');

                Route::get('/quotation/archive', 'quotationArchive')->name('admin.quotation.archive');
                Route::get('/quotation/{id}/unarchive', 'unarchiveQto')->name('admin.quotation.unarchive');
                Route::get('/quotation/archive/{year}', 'yearArchive')->name('admin.quotation.archive.year');

            });

            Route::controller(InvoiceController::class)->group(function () {
                Route::get('/invoice', 'show')->name('admin.invoice');
                //Draf Invoice
                Route::get('/invoice-draft', 'showDraft')->name('admin.invoice.draft');
                Route::get('/invoice-draft/create', 'create')->name('admin.invoice.draft.create');
                Route::post('/invoice-draf', 'store')->name('admin.invoice.draft.store');
                Route::get('/invoice/{id}/view', 'viewInv')->name('admin.invoice.view');
                Route::get('/invoice-draft/{id}/pending', 'pendingInv')->name('admin.invoice.set.pending');
                Route::get('/invoice-draft/{id}/confirm', 'confirmInv')->name('admin.invoice.set.confirm');
                Route::get('/invoice-draft/{id}/draft', 'draftInv')->name('admin.invoice.set.draft');
                Route::get('/invoice/{id}/print', 'print')->name('admin.invoice.print');
                Route::get('/invoice-confirmed', 'showConf')->name('admin.invoice.confirmed');
                Route::get('/invoice-draft/{id}/selesai', 'doneInv')->name('admin.invoice.set.selesai');
                Route::get('/invoice-draft/{id}/delete', 'destroy')->name('admin.invoice.delete');
                Route::get('/invoice-draft/{id}/archive', 'archiveInv')->name('admin.invoice.set.archive');
                Route::get('/invoice/{id}/edit', 'edit')->name('admin.invoice.edit');
                Route::post('/invoice/{id}/update', 'update')->name('admin.invoice.draft.update');

                Route::get('/invoice/{id}/unarchive', 'unarchiveInv')->name('admin.invoice.unarchive');
                Route::get('/invoice/archive', 'invoiceArchive')->name('admin.invoice.archive');
                Route::get('/invoice/archive/{year}', 'yearArchive')->name('admin.invoice.archive.year');
            });

            Route::controller(ProjectController::class)->group(function () {
                Route::get('/project', 'index')->name('admin.project');
                Route::get('/project-ongoing', 'showOngoing')->name('admin.project.ongoing');
                Route::get('/project-ongoing/{id}/edit', 'edit')->name('admin.project.ongoing.edit');
                Route::post('/project-ongoing/{id}/update', 'update')->name('admin.project.ongoing.update');
                Route::get('/project-done', 'showDone')->name('admin.project.done');
                Route::get('/project-done/{id}/view', 'editDone')->name('admin.project.done.edit');
                Route::get('/project-ongoing/{id}/archive', 'archiveProject')->name('admin.project.set.archive');
                Route::get('/project-ongoing/{id}/delete', 'destroy')->name('admin.project.ongoing.delete');
                Route::get('/project-ongoing/create', 'create')->name('admin.project.ongoing.create');
                Route::post('/project-ongoing/create', 'store')->name('admin.project.ongoing.store');

                Route::get('/project/{id}/unarchive', 'unarchiveProject')->name('admin.project.unarchive');
                Route::get('/project/archive', 'projectArchive')->name('admin.project.archive');
                Route::get('/project/archive/{year}', 'yearArchive')->name('admin.project.archive.year');
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
                Route::get('/delivery-draft/{id}/view', 'viewDelivery')->name('admin.delivery.view');
                Route::get('/delivery/{id}/print', 'print')->name('admin.delivery.print');

                Route::get('/delivery-draft/{id}/confirm', 'confirmDo')->name('admin.delivery.confirm');
                Route::get('/delivery-draft/{id}/done', 'doneDo')->name('admin.delivery.done');
                Route::get('/delivery/{id}/unarchive', 'unarchiveDo')->name('admin.delivery.unarchive');
                Route::get('/delivery/archive', 'deliveryArchive')->name('admin.delivery.archive');
                Route::get('/delivery/archive/{year}', 'yearArchive')->name('admin.delivery.archive.year');

                Route::get('/delivery-draft/{id}/archive', 'archiveDelivery')->name('admin.delivery.set.archive');

            });

            Route::controller(ArchiveController::class)->group(function () {
            });
        });
    });
});

Route::group(['middleware' => ['auth:user']], function () {
    Route::group(['middleware' => ['cek_login:3']], function () {
        Route::get('/manager', [DashboardController::class, 'index'])->name('manager.dashboard');
        Route::get('/manager/profile',[ManagerProfileController::class,'index'])->name('manager.profile');
        Route::post('/manager/profile',[ManagerProfileController::class,'update'])->name('manager.profile.update');
        Route::post('/manager/profile/password',[ManagerProfileController::class,'password_update'])->name('manager.profile.password');
        Route::prefix('manager')->group(function () {
            Route::controller(CvController::class)->group(function () {
                Route::get('/cv', 'show')->name('manager.cv');
                Route::post('/cv', 'update')->name('manager.cv.update');
            });

            Route::controller(ManagerProdukController::class)->group(function () {
                Route::get('/produk', 'show')->name('manager.produk');
                Route::get('/produk/create', 'create')->name('manager.produk.create');
                Route::post('/produk', 'store')->name('manager.produk.store');
                Route::get('/produk/{slug}/edit', 'edit')->name('manager.produk.edit');
                Route::post('/produk/{id}/update', 'update')->name('manager.produk.update');
                Route::get('/produk/{id}/delete', 'destroy')->name('manager.produk.delete');
            });

            Route::controller(ManagerPerusahaanController::class)->group(function () {
                Route::get('/perusahaan', 'show')->name('manager.perusahaan');
                Route::get('/perusahaan/create', 'create')->name('manager.perusahaan.create');
                Route::post('/perusahaan', 'store')->name('manager.perusahaan.store');
                Route::get('/perusahaan/{slug}/edit', 'edit')->name('manager.perusahaan.edit');
                Route::post('/perusahaan/{id}/update', 'update')->name('manager.perusahaan.update');
                Route::get('/perusahaan/{id}/delete', 'destroy')->name('manager.perusahaan.delete');
            });

            Route::controller(ManagerKaryawanController::class)->group(function () {
                Route::get('/karyawan', 'show')->name('manager.karyawan');
                Route::get('/karyawan/create', 'create')->name('manager.karyawan.create');
                Route::post('/karyawan', 'store')->name('manager.karyawan.store');
                Route::get('/karyawan/{slug}/edit', 'edit')->name('manager.karyawan.edit');
                Route::get('/karyawan/{id}/reset-password', 'resetPassword')->name('manager.karyawan.reset');
            });

            Route::controller(ManagerQuotationController::class)->group(function () {
                Route::get('/quotation', 'show')->name('manager.quotation');
                Route::get('/quotation-draft', 'showDraft')->name('manager.quotation.draft');
                Route::get('/quotation/{id}/view', 'viewQto')->name('manager.quotation.view');
                Route::get('/quotation-draft/{id}/accepted' ,'acceptedQto')->name('manager.quotation.set.accepted');
                Route::get('/quotation-confirmed', 'showConf')->name('manager.quotation.confirmed');
                Route::get('/quotation/{id}/print', 'print')->name('manager.quotation.print');
                Route::post('/quotation/{id}/reject', 'reject')->name('manager.quotation.reject');

                Route::get('/quotation/archive', 'quotationArchive')->name('manager.quotation.archive');
                Route::get('/quotation/archive/{year}', 'yearArchive')->name('manager.quotation.archive.year');
            });

            Route::controller(ManagerInvoiceController::class)->group(function () {
                Route::get('/invoice', 'show')->name('manager.invoice');
                //Draf Invoice
                Route::get('/invoice-draft', 'showDraft')->name('manager.invoice.draft');
                Route::get('/invoice/{id}/view', 'viewInv')->name('manager.invoice.view');
                Route::get('/invoice-draft/{id}/accepted', 'acceptedInv')->name('manager.invoice.set.accepted');
                Route::get('/invoice/{id}/print', 'print')->name('manager.invoice.print');
                Route::get('/invoice-confirmed', 'showConf')->name('manager.invoice.confirmed');
                Route::post('/invoice-draft/{id}/tolak', 'rejectInv')->name('manager.invoice.set.reject');
                Route::get('/invoice/archive', 'invoiceArchive')->name('manager.invoice.archive');
                Route::get('/invoice/archive/{year}', 'yearArchive')->name('manager.invoice.archive.year');
            });

            Route::controller(ManagerProjectController::class)->group(function () {
                Route::get('/project', 'index')->name('manager.project');
                Route::get('/project-ongoing', 'showOngoing')->name('manager.project.ongoing');
                Route::get('/project-ongoing/{id}/edit', 'edit')->name('manager.project.ongoing.edit');
                Route::post('/project-ongoing/{id}/update', 'update')->name('manager.project.ongoing.update');
                Route::get('/project-done', 'showDone')->name('manager.project.done');
                Route::get('/project-done/{id}/view', 'editDone')->name('manager.project.done.edit');
                Route::get('/project/archive', 'projectArchive')->name('manager.project.archive');
                Route::get('/project/archive/{year}', 'yearArchive')->name('manager.project.archive.year');
                //Draf Invoice
            });

            Route::controller(ManagerDeliveryController::class)->group(function () {
                Route::get('/delivery', 'index')->name('manager.delivery');
                Route::get('/delivery-draft', 'showDraft')->name('manager.delivery.draft');
                Route::get('/delivery-confirmed', 'showConf')->name('manager.delivery.confirmed');
                Route::get('/delivery-draft/create', 'create')->name('manager.delivery.draft.create');
                Route::post('/delivery-draft', 'store')->name('manager.delivery.draft.store');
                Route::get('/delivery-draft/{id}/edit', 'edit')->name('manager.delivery.draft.edit');
                Route::post('/delivery-draft/{id}/edit', 'update')->name('manager.delivery.draft.update');
                Route::get('/deliver-draft/{id}/delete', 'destroy')->name('manager.delivery.draft.delete');
                Route::get('/deliver/{id}/view', 'viewDelivery')->name('manager.delivery.view');
                Route::get('/delivery/archive', 'deliveryArchive')->name('manager.delivery.archive');
                Route::get('/delivery/archive/{year}', 'yearArchive')->name('manager.delivery.archive.year');
                Route::get('/delivery/{id}/print', 'print')->name('manager.delivery.print');

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
                Route::post('/profile','update')->name('karyawan.update.profile');
                Route::post('/profile/password','password_update')->name('karyawan.update.password');
            });


        });
    });
});
