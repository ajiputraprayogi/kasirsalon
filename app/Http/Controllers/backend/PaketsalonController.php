<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PaketsalonController extends Controller
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
        $data = DB::table('paket_salon')
                ->orderBy('paket', 'asc')
                ->get();
        return view('backend.data.paket_salon.index', compact('data'));
    }

    public function cari_paket_salon(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('paket_salon')
                    ->where('paket', 'like','%'.$cari.'%')
                    ->get();
            $print = [
                'paket'=>$data
            ];
            return response()->json($print);
        }
        $data = DB::table('paket_salon')
                ->orderby('paket', 'asc')
                ->get();
        $print = [
            'paket'=>$data
        ];
        return response()->json($print);
    }

    public function cari_paket_salon_hasil($id)
    {
        $data = DB::table('paket_salon')
                ->where('id', $id)
                ->get();
        $print = [
            'paket'=>$data
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
        return view('backend.data.paket_salon.create');
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
            'paket'=>'required',
            'harga'=>'required'
        ]);
        DB::table('paket_salon')->insert([
            'paket'=>$request->paket,
            'harga'=>$request->harga,
            'fee_capster'=>$request->fee_capster
        ]);
        return redirect('backend/paket_salon')->with('status', 'Berhasil tambah data');
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
        $data = DB::table('paket_salon')
                ->where('id', $id)
                ->get();
        return view('backend.data.paket_salon.edit', compact('data'));
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
            'paket'=>'required',
            'harga'=>'required',
            'fee_capster'=>'required'
        ]);
        DB::table('paket_salon')->where('id', $id)->update([
            'paket'=>$request->paket,
            'harga'=>$request->harga,
            'fee_capster'=>$request->fee_capster
        ]);
        return redirect('backend/paket_salon')->with('status', 'Berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('paket_salon')->where('id', $id)->delete();
    }
}
