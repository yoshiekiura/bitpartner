<?php

namespace App\Http\Controllers;
use App\Traits\LastUpdate;
use App\ICO;

use Illuminate\Http\Request;

class ICOController extends Controller
{
    public function index()
    {
        $icos = ICO::orderBy('genesis_date','asc')->paginate(60);
        $last_updated = ICO::lastUpdated();
        return view('icos')->with(['icos'=>$icos, 'last_updated'=> $last_updated]);
    }

    public function show($id)
    {
        if (is_numeric($id)) {
            $ico = ICO::findOrFail($id);
        } else {
            $ico = ICO::where('slug','=',$id)->firstOrFail();
        }
        return view('ico')->with(['ico'=>$ico]);
    }

}
