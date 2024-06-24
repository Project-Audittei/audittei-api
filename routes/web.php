<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email-validacao', function () {
    return new \App\Mail\EmailValidacaoConta("Fernando", "asd123sad");
});
