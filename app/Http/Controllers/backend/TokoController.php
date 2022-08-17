<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class TokoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public function index()
    {
        $data = DB::table('toko')
        ->orderby('nama','asc')
        ->get();
        return view('backend.data.toko.index', compact('data'));
    }

    public function cari_toko(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('toko')
                    ->where('nama','like','%'.$cari.'%')
                    ->get();
            $print = [
                'toko'=>$data
            ];
            return response()->json($print);
        }
        $data = DB::table('toko')
                ->orderby('nama','asc')
                ->get();
        $print = [
            'toko'=>$data
        ];
        return response()->json($print);
    }

    public function cari_hasil_toko($id)
    {
        $data = DB::table('toko')
        ->where('id', $id)
        ->get();
        $print = [
            'toko'=>$data
        ];
        return response()->json($print);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.data.toko.create');
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
            'nama'=>'required'
        ]);
        $add = DB::table('toko')->insert([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp
        ]);
        return redirect('/backend/toko')->with('status','Berhasil tambah data');
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
        $data = DB::table('toko')
                ->where('id',$id)
                ->get();
        return view('backend.data.toko.edit',compact('data'));
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
            'nama'=>'required'
        ]);
        DB::table('toko')->where('id',$id)->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'telp'=>$request->telp
        ]);
        return redirect('/backend/toko')->with('status','Berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::table('toko')->where('id', $id);
        $data->delete();
        // return redirect('/backend/toko')->with('status','Sukses menghapus data');
    }
}
