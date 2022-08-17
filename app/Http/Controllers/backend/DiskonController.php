<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DiskonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('diskon')
        ->get();
        return view('backend.data.diskon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.data.diskon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'diskon' => 'required',
            'status' => 'required'
        ]);
        DB::table('diskon')->insert([
            'nama' => $request->nama,
            'diskon' => $request->diskon,
            'status' => $request->status
        ]);
        return redirect('/backend/diskon')->with('status', 'Berhasil tambah data');
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
        $data = DB::table('diskon')
        ->where('id',$id)
        ->get();
        return view('backend.data.diskon.edit', compact('data'));
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
        $request->validate([
            'nama' => 'required',
            'diskon' => 'required',
            'status' => 'required'
        ]);
        DB::table('diskon')->where('id',$id)->update([
            'nama' => $request->nama,
            'diskon' => $request->diskon,
            'status' => $request->status
        ]);
        return redirect('/backend/diskon')->with('status', 'Berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('diskon')->where('id',$id)->delete();
    }
}
