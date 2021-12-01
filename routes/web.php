<?php

use App\Http\Controllers\MailingController;
use Illuminate\Support\Facades\Mail;
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

//Route::get('/unsubscribe', function () {
//    return view('emails.delete');
//});
Route::get('/',[MailingController::class, 'create']);
Route::post('/',[MailingController::class, 'store']);
Route::get('/{id?}',[MailingController::class, 'show']);
Route::post('/{id?}/delete',[MailingController::class, 'destroy']);
