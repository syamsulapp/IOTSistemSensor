<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ApiSistemSensor;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('/data/{param}/{data}', function ($param, $data) {
  // $data = [
  //   'id' => 1,
  //   'data' => $param,
  //   'message' => 'ada datanya',
  // ];

  if ($param && $data != 0) {
    return response()->json([
      'id' => $param,
      'data' => $data,
      'message' => 'data di temukan'
    ], 200);
  } else {
    return response()->json([
      'id' => null,
      'data' => null,
      'message' => 'data tidak di temukan'
    ], 404);
  }
});


Route::get('/data_sensor', function (ApiSistemSensor $allSensor) {
  return $allSensor->all();
});

Route::get('/data_perintah', function () {
  $data_perintah = [
    'id' => 1,
    'lampu_1' => DB::table('data')->max('lampu_1'),
    'lampu_2' => DB::table('data')->max('lampu_2'),
    'sensor_suhu' => DB::table('data')->max('sensor_suhu'),
    'teras_rumah' => DB::table('data')->max('teras_rumah'),
  ];
  if ($data_perintah) {
    return response()->json([
      'id' => 1,
      'lampu_1' => $data_perintah['lampu_1'],
      'lampu_2' => $data_perintah['lampu_2'],
      'sensor_suhu' => $data_perintah['sensor_suhu'],
      'teras_rumah' => $data_perintah['teras_rumah'],
      'message' => 'data di temukan ',
    ], 200);
  } else {
    return response()->json([
      'id' => 1,
      'message' => 'ada datanya',
    ], 404);
  }
});

/**
 * CREATED BY MUHAMMAD SYAMSUL MARIF (ENDPOINT REST API OTOMATISASI RUMAH DENGAN SENSOR SUHU , LAMPU DAN SERVO)
 * END POINT TERDIRI DARI 4 ENDPOINT (1. ENDPOINT UNTUK LAMPU1 2. ENPOINT UNTUK LAMPU 2  3.ENDPOINT UNTUK SENSOR SUHU  4. ENDPOINT UNTUK SERVO)
 * TERIMAKASIH MELIHAT LOGIC PROGRAM(CODE) BUATAN SAYA SENDIRI
 **/
// endpoint untuk data LAMPU 1
Route::get('/sistem_sensor/lampu_1/{id}/{lampu_1}', function ($id, $Lampu1) {

  $DataLampu1 = ApiSistemSensor::find($id);
  if ($Lampu1 == 0 || $Lampu1 == 1) {
    $DataLampu1->lampu_1 = $Lampu1;
    $result_data = $DataLampu1->save();
    if ($result_data) {
      return ["data" => "status data lampu 1 berhasil di update "];
    } else {
      return ["data" => "data tidak di temukan"];
    }
  }

  if ($Lampu1 >= (-100) && $Lampu1 <= (-1)) {
    return response()->json([
      "result data" => "tidak ada data digital yang " . $Lampu1,
      "response_code" => 500,
    ], 500);
  } else {
    return response()->json([
      "result_data" => "data tidak boleh analog harus data digital",
      'respon_status' => 404,
    ], 404);
  }
});

// endpoint untuk data LAMPU 2
Route::get('/sistem_sensor/lampu_2/{id}/{Lampu2}', function ($id, $Lampu2) {

  $DataLampu2 = ApiSistemSensor::find($id);
  if ($Lampu2 == 0 || $Lampu2 == 1) {
    $DataLampu2->lampu_2 = $Lampu2;
    $result_data = $DataLampu2->save();
    if ($result_data) {
      return ["data" => "status data lampu 2 berhasil di update "];
    } else {
      return ["data" => "data tidak di temukan"];
    }
  }

  if ($Lampu2 >= (-100) && $Lampu2 <= (-1)) {
    return response()->json([
      "result data" => "tidak ada data digital yang " . $Lampu2,
      "response_code" => 500,
    ], 500);
  } else {
    return response()->json([
      "result_data" => "data tidak boleh analog harus data digital",
      'respon_status' => 404,
    ], 404);
  }
});

// endpoint untuk data LAMPU 2
Route::get('/sistem_sensor/teras/{id}/{teras}', function ($id, $teras) {

  $DataLampu2 = ApiSistemSensor::find($id);
  if ($teras == 0 || $teras == 1) {
    $DataLampu2->teras_rumah = $teras;
    $result_data = $DataLampu2->save();
    if ($result_data) {
      return ["data" => "status lampu teras berhasil di update "];
    } else {
      return ["data" => "data tidak di temukan"];
    }
  }

  if ($teras >= (-100) && $teras <= (-1)) {
    return response()->json([
      "result data" => "tidak ada data digital yang " . $teras,
      "response_code" => 500,
    ], 500);
  } else {
    return response()->json([
      "result_data" => "data tidak boleh analog harus data digital",
      'respon_status' => 404,
    ], 404);
  }
});

// endpoint untuk data SENSOR SUHU
Route::get('/sistem_sensor/suhu/{id}/{suhu}', function ($id, $suhu) {

  $SensorSuhu = ApiSistemSensor::find($id);
  if ($suhu != 0 && $suhu != 1) {

    $SensorSuhu->sensor_suhu = $suhu;
    $result_data = $SensorSuhu->save();
    if ($result_data) {
      return response()->json([
        'data_suhu' => 'suhu sekarang : ' . $suhu,
        'response_code' => 200,
      ], 200);
    }
  }
  return response()->json([
    'id' => 1,
    'data_suhu' => 'data yang di masukan bukan data digital tapi data analog',
    'response_code' => 404,
  ], 404);
});

// endpoint untuk data SERVO
/* di nonaktif kan sementara
Route::get('/sistem_sensor/servo/{id}/{servo_write}',function($id,$servo_write){
  $ServoPintu = ApiSistemSensor::find($id);

  if($servo_write == 180 || $servo_write == 0){
    $ServoPintu->pintu = $servo_write;
    $result_data = $ServoPintu->save();
    if($result_data){
      if($servo_write == 180) {
        return response()->json([
          'data' => "pintu terbuka",
          'response_code' => 200,
        ],200);
      } else if($servo_write == 0) {
        return response()->json([
          'data' => "pintu tertutup",
          'response_code' => 200,
        ],200);
      }
    }
  }
  return response()->json([
    'data' => 'nilai servo write tidak bisa untuk buka pintu',
  ],404);
});
*/
