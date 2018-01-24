<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monitor;

class MonitorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readings = Monitor::orderBy('id','desc')->limit(20)->get();
        return view('monitor')->with(['readings'=>$readings]);
    }

    /**
     * Display last 10 resources
     *
     * @return \Illuminate\Http\Response
     */
    public function api()
    {
        $readings = Monitor::orderBy('id','desc')->limit(10)->get();
        return $readings;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Monitor::where('timestamp','=',$request->get('timestamp'))->delete();
        $monitor = new Monitor($request->all());
        $monitor->save();
        return $monitor;
    }

}