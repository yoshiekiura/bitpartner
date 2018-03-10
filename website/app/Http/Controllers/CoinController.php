<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coin;

class CoinController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        $coins = Coin::orderBy('genesis_date','asc')->paginate(60);
        return view('coins')->with(['coins'=>$coins]);
    }

    public function show($id)
    {
        $coin = Coin::findOrFail($id);
        return view('coin')->with(['coin'=>$coin]);
    }

    public function create()
    {
        if (!$this->checkRole()) return \Redirect::route('coins.index');

        return view('coin-create');
    }

    public function store(Request $request)
    {
        if (!$this->checkRole()) return \Redirect::route('coins.index');

        $coin = new Coin($request->all());
        if (!$coin->save()) {
            return back()->with('error', 'Unable to save coin');
        }
        return \Redirect::route('coins.index')->with('success', 'Coin #'.$coin->id.' has been added.');
    }

    public function edit($id)
    {
        if (!$this->checkRole()) return \Redirect::route('coins.index');

        $coin = Coin::findOrFail($id);
        return view('coin-edit')->with(['coin'=>$coin]);
    }

    public function update(Request $request, $id)
    {
        if (!$this->checkRole()) return \Redirect::route('coins.index');

        $coin = Coin::findOrFail($id);
        $coin->update($request->all());
        if (!$coin->save()) {
            return back()->with('error', 'Unable to save coin');
        }
        return \Redirect::route('coins.show',$id)->with('success', 'Coin #'.$coin->id.' has been update.');
    }

    public function destroy()
    {
        if (!$this->checkRole()) return \Redirect::route('coins.index');

        Role::destroy($id);
        return \Redirect::route('coin.index')->with('message', 'Coin #'.$id.' has been deleted');
    }

}
