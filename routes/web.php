<?php

use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect('/admin');
});


 
Route::get('admin/level_pdf', [PDFController::class, 'generatePDF'])
    ->middleware(['moonshine', \MoonShine\Laravel\Http\Middleware\Authenticate::class])
    ->name('level_pdf');