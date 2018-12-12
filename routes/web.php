<?php

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

Route::get('/', function () {
    phpinfo();
});

Route::get('/test', function () {


    $a = 0.2;
    $b = 1.7;

    if($a + $b == 1.9){
        echo '两个值相等';
    }else{
        echo $a + $b;
    }
});
