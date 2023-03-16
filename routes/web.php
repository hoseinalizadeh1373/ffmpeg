<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToImageController;
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

Route::get("/image",[ToImageController::class,'tovideo']);
Route::get('/visualiser',function(){
    return view('/music_visualiser');
});