<?php

use App\Http\Controllers\MailingController;
use Illuminate\Support\Facades\Route;

Route::get('/',[MailingController::class, 'create']);
Route::post('/',[MailingController::class, 'store']);
Route::get('/{id?}',[MailingController::class, 'show']);
Route::post('/{id?}/delete',[MailingController::class, 'destroy']);

