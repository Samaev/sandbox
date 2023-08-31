<?php

use App\Http\Controllers\HubSpotController;
use App\Http\Controllers\MyPlaceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogoExtractorController;
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
use App\Http\Controllers\WebPageExportController;

Route::get('/export-webpage', [WebPageExportController::class, 'export']);


Route::get('/', function () {
    return view('welcome');
});
Route::get('/extract-logos', [LogoExtractorController::class, 'extractLogos']);
Route::get('/my-page', [MyPlaceController::class, 'index']);
Route::get('/create-note', [HubSpotController::class, 'createNoteInTicket']);

