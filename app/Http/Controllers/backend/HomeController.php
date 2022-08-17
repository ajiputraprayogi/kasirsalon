<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use File;
use DB;
use Auth;
use Hash;

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        $customer = DB::table("customer")
        ->count();
        $pegawai = DB::table('pegawai')
        ->count();
        $order = DB::table('transaksi')
        ->count();
        $tglsatuformat = date('Y-m-d 00:00:00');
        $tglduaformat = date('Y-m-d 23:59:59');
        $pemasukan = DB::table('transaksi')
        ->select(DB::raw('sum(transaksi.total) as total'))
        ->whereBetween('transaksi.created_at', array($tglsatuformat, $tglduaformat))
        ->get();
        // dd($pemasukan);
        $total_harga = DB::table('transaksi')
        ->select(DB::raw("CAST(SUM(total)as int) as total"))
        ->groupby(DB::raw('Month(created_at)'))
        ->orderBy('created_at', 'ASC')
        ->pluck('total');
        // dd($total_harga);
        $bulan = DB::table('transaksi')
        ->select(DB::raw('MONTHNAME(created_at) as bulan'))
        ->groupby(DB::raw('MONTHNAME(created_at)'))
        ->orderBy('created_at', 'ASC')
        ->pluck('bulan');
        // dd($bulan);
        return view('backend.dashboard.index', compact('customer','pegawai','order','pemasukan','total_harga','bulan'));
    }

    //==================================================================
    public function editprofile(){
        $data = User::find(Auth::user()->id);
        return view('backend.dashboard.editprofile',['data'=>$data]);
    }

    //==================================================================
    public function aksieditprofile(Request $request,$id){
        if($request->hasFile('gambar')){
            File::delete('img/admin/'.$request->gambar_lama);
            $nameland=$request->file('gambar')->
            getClientOriginalname();
            $lower_file_name=strtolower($nameland);
            $replace_space=str_replace(' ', '-', $lower_file_name);
            $finalname=time().'-'.$replace_space;
            $destination=public_path('img/admin');
            $request->file('gambar')->move($destination,$finalname);

            if($request->password==''){
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'gambar'=>$finalname,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'gambar'=>$finalname,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }else{
            if($request->password==''){
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                ]);
            }else{
                User::find($id)
                ->update([
                    'name'=>$request->nama,
                    'username'=>$request->username,
                    'email'=>$request->email,
                    'telp'=>$request->telp,
                    'password'=>Hash::make($request->password),
                ]);
            }
        }

        return redirect('/backend/home')->with('status','Sukses memperbarui profile');
    }

    //==================================================================
    public function websetting()
    {
        $data = DB::table('settings')->orderby('id','desc')->get();
        return view('backend.dashboard.websetting',compact('data'));
    }

    //==================================================================
    public function updatewebsetting(Request $request)
    {
        DB::table('settings')->where('id',$request->kode)
        ->update([
            'singkatan_nama_program'=>$request->singkatan_nama_program,
            'nama_program'=>$request->nama_program,
            'instansi'=>$request->instansi,
            'deskripsi_program'=>$request->deskripsi,
        ]);
        return redirect('/backend/home')->with('status','Sukses memperbarui setting web');
    }
}