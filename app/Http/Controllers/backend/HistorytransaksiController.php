<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HistorytransaksiController extends Controller
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

    public function index(Request $request)
    {
        $active_toko = 'Semua Toko';
        if($request->has('toko')){
            if($request->toko!='Semua Toko'){
                $active_toko = $request->toko;
            }else{
                $active_toko = 'Semua Toko';
            }
        }

        $active_pegawai = 'Semua Pegawai';
        if($request->has('pegawai')){
            if($request->pegawai!='Semua Pegawai'){
                $active_pegawai = $request->pegawai;
            }else{
                $active_pegawai = 'Semua Pegawai';
            }
        }

        $tanggal = $request->tanggal;
        if($request->tanggal!=''){
            $active_tanggal = explode(" to ", $request->tanggal);
            if(count($active_tanggal)<2){
                $tglsatu = $active_tanggal[0];
                $tglsatuformat = Carbon::createFromFormat('d-m-Y', $tglsatu)->format('Y-m-d 00:00:00');
                $tgldua = $active_tanggal[0];
                $tglduaformat = Carbon::createFromFormat('d-m-Y', $tgldua)->format('Y-m-d 23:59:59');
            }else{
                $tglsatu = $active_tanggal[0];
                $tglsatuformat = Carbon::createFromFormat('d-m-Y', $tglsatu)->format('Y-m-d 00:00:00');
                $tgldua = $active_tanggal[1];
                $tglduaformat = Carbon::createFromFormat('d-m-Y', $tgldua)->format('Y-m-d 23:59:59');
            }
        }else{
            $active_tanggal = '';
        }
        if($active_tanggal!=''){
            if($active_toko!='Semua Toko'){
                if($active_pegawai!='Semua Pegawai'){
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->whereBetween('transaksi.created_at', array($tglsatuformat, $tglduaformat))
                    ->where([['users.id_toko','=',$active_toko],['pegawai.id','=',$active_pegawai]])
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }else{
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->whereBetween('transaksi.created_at', array($tglsatuformat, $tglduaformat))
                    ->where('users.id_toko','=',$active_toko)
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }
            }else{
                if($active_pegawai!='Semua Pegawai'){
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->whereBetween('transaksi.created_at', array($tglsatuformat, $tglduaformat))
                    ->where('pegawai.id','=',$active_pegawai)
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }else{
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->whereBetween('transaksi.created_at', array($tglsatuformat, $tglduaformat))
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }
            }
        }else{
            if($active_toko!='Semua Toko'){
                if($active_pegawai!='Semua Pegawai'){
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->where([['users.id_toko','=',$active_toko],['pegawai.id','=',$active_pegawai]])
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }else{
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->where('users.id_toko','=',$active_toko)
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }
            }else{
                if($active_pegawai!='Semua Pegawai'){
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->where('pegawai.id','=',$active_pegawai)
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }else{
                    $data = DB::table('transaksi')
                    ->leftjoin('customer','customer.id','=','transaksi.id_customer')
                    ->leftjoin('users','users.id','=','transaksi.id_user')
                    ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                    ->select('transaksi.*','customer.nama','pegawai.nama as namap')
                    ->orderBy('faktur', 'desc')
                    ->get();
                    // dd($data);
        
                    $toko = DB::table('toko')
                    ->orderby('nama','asc')
                    ->get();

                    $pegawai = DB::table('pegawai')
                    ->orderby('nama','asc')
                    ->get();
                }
            }
        }
        return view('backend.history_transaksi.index', compact('data','tanggal','toko','active_toko','pegawai','active_pegawai'));
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
        //
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
}
