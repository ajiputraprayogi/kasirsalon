<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProdukController extends Controller
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
        $data = DB::table('produk')
                ->orderBy('nama','asc')
                ->get();
        return view('backend.data.produk.index', compact('data'));
    }

    public function cari_produk(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('produk')
                    ->where('nama','like','%'.$cari.'%')
                    ->get();
            $print = [
                'produk'=>$data
            ];
            return response()->json($print);
        }
        $data = DB::table('produk')
                ->orderby('nama','asc')
                ->get();
        $print = [
            'produk'=>$data
        ];
        return response()->json($print);
    }

    public function cari_produk_hasil($id)
    {
        $data = DB::table('produk')
                ->where('id', $id)
                ->get();
        $print = [
            'produk'=>$data
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
        return view('backend.data.produk.create');
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
            'nama'=>'required',
            'stok'=>'required',
            'harga'=>'required'
        ]);
        DB::table('produk')->insert([
            'nama'=>$request->nama,
            'stok'=>$request->stok,
            'harga'=>$request->harga
        ]);
        return redirect('/backend/produk')->with('status', 'Berhasil tambah data');
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
        $data = DB::table('produk')
                ->where('id', $id)
                ->get();
        return view('backend.data.produk.edit', compact('data'));
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
        DB::table('produk')->where('id', $id)->update([
            'nama'=>$request->nama,
            'stok'=>$request->stok,
            'harga'=>$request->harga
        ]);
        return redirect('/backend/produk')->with('status', 'Berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('produk')->where('id', $id)->delete();
    }
}
