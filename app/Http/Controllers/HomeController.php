<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $guests = [];
        $brides = [
            'dani'  => 'Dani Susanto',
            'diah'  => 'Diah Permatasari'
        ];
        $bride = null;
        if (! empty($request->query('bride')) && in_array($request->query('bride'), ['dani', 'diah'])) {
            $guests = User::where('bride', $request->query('bride'))->where('status', 0)->orderBy('name', 'ASC')->get()->toArray();
            $bride = $brides[$request->query('bride')];
        }
        return view('index', [
            'guests'    => $guests,
            'bride'     => $bride,
            'brideKey'  => (! empty($request->query('bride'))) ? $request->query('bride') : ''
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if (! empty($user)) {
            $user->status = 1;
            $user->save();
            return redirect()->back()->with('message', "<b>{$user->name}</b> berhasil!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * search
     *
     * @param  mixed $request
     * @return void
     */
    public function search(Request $request)
    {
        return User::where('name', 'like', "%{$request->input('keyword')}%")->where('bride', $request->input('bride'))->where('status', 0)->orderBy('name', 'ASC')->get()->toArray();
    }
}
