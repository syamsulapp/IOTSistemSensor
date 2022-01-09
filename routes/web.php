<?php

use App\Http\Controllers\IotController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/iot_sistem_sensor/index', [IotController::class, 'index'])->name('home');
Route::get('/iot_sistem_sensor/suhu', [IotController::class, 'suhu'])->name('suhu');

Route::post('/iot_sistem_sensor/post', [IotController::class, 'store'])->name('post_data');
Route::post('/iot_sistem_sensor/lampu1', [IotController::class, 'lampu'])->name('request_lampu');
