<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/redis-test', function () {
    Redis::set('name', 'Sina');
    return Redis::get('name');
});
