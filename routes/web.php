<?php

use App\Http\Controllers\CreateController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DeleteController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\ShowEditController;
use App\Http\Controllers\ShowPrintPreviewController;
use App\Http\Controllers\Edit\AddressController;
use App\Http\Controllers\Edit\BasicDataController;
use App\Http\Controllers\Edit\EducationController;
use App\Http\Controllers\Edit\EmploymentController;
use App\Http\Controllers\Edit\LanguageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/create', [CreateController::class, 'index'])->name('create.index');
Route::post('/create', [CreateController::class, 'store'])->name('create.store');
Route::post('/delete', [DeleteController::class, 'destroy'])->name('delete.destroy');
Route::get('/cv/{id}', [ShowEditController::class, 'show'])->name('cv.show');
Route::get('/printPreview/{id}', [ShowPrintPreviewController::class, 'show'])->name('printPreview.show');

Route::post('/cv/update/basicData', [BasicDataController::class, 'update'])->name('basicData.update');
Route::post('/cv/update/address', [AddressController::class, 'update'])->name('address.update');
Route::post('/cv/update/education', [EducationController::class, 'update'])->name('education.update');
Route::post('/cv/update/employment', [EmploymentController::class, 'update'])->name('employment.update');
Route::post('/cv/update/language', [LanguageController::class, 'update'])->name('language.update');
Route::post('/cv/delete/education', [DeleteController::class, 'destroyEducationEntity'])->name('delete.destroyEducationEntity');
Route::post('/cv/delete/employment', [DeleteController::class, 'destroyEmploymentEntity'])->name('delete.destroyEmploymentEntity');
Route::post('/cv/delete/language', [DeleteController::class, 'destroyLanguageEntity'])->name('delete.destroyLanguageEntity');

Route::get('/session', [SessionController::class, 'index'])->name('session.index');
