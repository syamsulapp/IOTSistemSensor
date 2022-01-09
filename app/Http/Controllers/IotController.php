<?php

namespace App\Http\Controllers;

use App\Models\IotModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lampu = [
            'ruang_tamu' => DB::table('data')->max('lampu_1'),
            'kamar_tidur' => DB::table('data')->max('lampu_2'),
            'teras' => DB::table('data')->max('teras_rumah'),
        ];
        return view('iot', compact('lampu'));
    }

    public function suhu()
    {
        $suhu = DB::table('data')->max('sensor_suhu');
        return view('suhu', compact('suhu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = IotModels::find(1);

        // if ($data) {
        //     $data->lampu_1 = $request->rt;
        //     $data->lampu_2 = $request->kt;
        //     $data->teras_rumah = $request->tr;
        //     $data->save();
        // }
        if ($request->bt1 == "on") {
            $data->lampu_1 = 1;
            $data->lampu_2 = 1;
            $data->teras_rumah = 1;
            $data->save();
        } else if ($request->bt2 == "off") {
            $data->lampu_1 = 0;
            $data->lampu_2 = 0;
            $data->teras_rumah = 0;
            $data->save();
        }


        return redirect('/iot_sistem_sensor/index');
    }

    public function lampu(Request $request)
    {
        $lampu = IotModels::find(1);

        switch ($request->rt) {
            case "on":
                $lampu->lampu_1 = 1;
                $lampu->save();
                break;
            case "off":
                $lampu->lampu_1 = 0;
                $lampu->save();
                break;
        }
        switch ($request->kt) {
            case "on":
                $lampu->lampu_2 = 1;
                $lampu->save();
                break;
            case "off":
                $lampu->lampu_2 = 0;
                $lampu->save();
                break;
        }
        switch ($request->tr) {
            case "on":
                $lampu->teras_rumah = 1;
                $lampu->save();
                break;
            case "off":
                $lampu->teras_rumah = 0;
                $lampu->save();
                break;
        }



        return redirect('/iot_sistem_sensor/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IotModels  $iotModels
     * @return \Illuminate\Http\Response
     */
    public function show(IotModels $iotModels)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IotModels  $iotModels
     * @return \Illuminate\Http\Response
     */
    public function edit(IotModels $iotModels)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IotModels  $iotModels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IotModels $iotModels)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IotModels  $iotModels
     * @return \Illuminate\Http\Response
     */
    public function destroy(IotModels $iotModels)
    {
        //
    }
}
