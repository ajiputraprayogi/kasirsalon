<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CustomerController extends Controller
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
        $data = DB::table('customer')
                ->orderby('nama','asc')
                ->get();
        return view('backend.data.customer.index',compact('data'));
    }

    public function cari_customer(Request $request)
    {
        if($request->has('q')){
            $cari = $request->q;
            $data = DB::table('customer')
                    ->where('nama','like','%'.$cari.'%')
                    ->get();
            $print = [
                'customer'=>$data
            ];
            return response()->json($print);
        }
        $data = DB::table('customer')
                ->orderby('nama','asc')
                ->get();
        $print = [
            'customer'=>$data
        ];
        return response()->json($print);
    }

    public function cari_customer_hasil($id)
    {
        $data = DB::table('customer')
                ->where('id', $id)
                ->get();
        $print = [
            'customer'=>$data
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
        return view('backend.data.customer.create');
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
        DB::table('customer')->insert([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_wa'=>$request->no_wa,
            'email'=>$request->email
        ]);
        return redirect('/backend/customer')->with('status', 'Berhasil tambah data');
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
        $data = DB::table('customer')
                ->where('id', $id)
                ->get();
        return view('backend.data.customer.edit',compact('data'));
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
        DB::table('customer')->where('id',$id)->update([
            'nama'=>$request->nama,
            'alamat'=>$request->alamat,
            'no_wa'=>$request->no_wa,
            'email'=>$request->email
        ]);
        return redirect('/backend/customer')->with('status', 'Berhasil edit data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('customer')->where('id',$id)->delete();
    }
}
