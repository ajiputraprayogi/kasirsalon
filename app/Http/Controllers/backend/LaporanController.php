<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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

        if($active_pegawai!='Semua Pegawai'){
            if($active_tanggal!=''){
                $data = DB::table('transaksi')
                ->leftjoin('list_pesanan','list_pesanan.faktur','=','transaksi.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                ->select('transaksi.*','pegawai.id as idp','paket_salon.paket')
                ->where('transaksi.id_pegawai',$active_pegawai)
                ->groupby('transaksi.id_pegawai')
                ->orderby('transaksi.faktur')
                ->get();
                $pegawai = DB::table('pegawai')
                ->orderby('nama','asc')
                ->get();
                $list_pesanan = DB::table('list_pesanan')
                ->select('transaksi.id_pegawai','list_pesanan.id_paket','list_pesanan.*','paket_salon.paket','paket_salon.harga','paket_salon.fee_capster',DB::raw('sum(list_pesanan.jumlah_paket)as jumlah_paket'),'list_pesanan.id_paket')
                ->leftjoin('transaksi','transaksi.faktur','=','list_pesanan.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->whereBetween('list_pesanan.created_at', array($tglsatuformat, $tglduaformat))
                ->orderby('list_pesanan.id_paket','desc')
                ->groupby('list_pesanan.id_paket','transaksi.id_pegawai')
                ->get();
                //dd($list_pesanan);
                // dd($data);
            }else{
                $data = DB::table('transaksi')
                ->leftjoin('list_pesanan','list_pesanan.faktur','=','transaksi.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                ->select('transaksi.*','pegawai.id as idp','paket_salon.paket')
                ->where('transaksi.id_pegawai',$active_pegawai)
                ->groupby('transaksi.id_pegawai')
                ->orderby('transaksi.faktur')
                ->get();
                $pegawai = DB::table('pegawai')
                ->orderby('nama','asc')
                ->get();
                $list_pesanan = DB::table('list_pesanan')
                ->select('transaksi.id_pegawai','list_pesanan.id_paket','list_pesanan.*','paket_salon.paket','paket_salon.harga','paket_salon.fee_capster',DB::raw('sum(list_pesanan.jumlah_paket)as jumlah_paket'),'list_pesanan.id_paket')
                ->leftjoin('transaksi','transaksi.faktur','=','list_pesanan.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->orderby('list_pesanan.id_paket','desc')
                ->groupby('list_pesanan.id_paket','transaksi.id_pegawai')
                ->get();
                //dd($list_pesanan);
                // dd($data);
            }
        }else{
            if($active_tanggal!=''){
                $data = DB::table('transaksi')
                ->leftjoin('list_pesanan','list_pesanan.faktur','=','transaksi.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                ->select('transaksi.*','pegawai.id as idp','paket_salon.paket')
                ->groupby('transaksi.id_pegawai')
                ->orderby('transaksi.faktur')
                ->get();
                $pegawai = DB::table('pegawai')
                ->orderby('nama','asc')
                ->get();

                $list_pesanan = DB::table('list_pesanan')
                ->select('transaksi.id_pegawai','list_pesanan.id_paket','list_pesanan.*','paket_salon.paket','paket_salon.harga','paket_salon.fee_capster',DB::raw('sum(list_pesanan.jumlah_paket)as jumlah_paket'),'list_pesanan.id_paket')
                ->leftjoin('transaksi','transaksi.faktur','=','list_pesanan.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->whereBetween('list_pesanan.created_at', array($tglsatuformat, $tglduaformat))
                ->orderby('list_pesanan.id_paket','desc')
                ->groupby('list_pesanan.id_paket','transaksi.id_pegawai')
                ->get();
                //dd($list_pesanan);
                // dd($data);
            }else{
                $data = DB::table('transaksi')
                ->leftjoin('list_pesanan','list_pesanan.faktur','=','transaksi.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
                ->select('transaksi.*','pegawai.id as idp','paket_salon.paket')
                ->groupby('transaksi.id_pegawai')
                ->orderby('transaksi.faktur')
                ->get();
                $pegawai = DB::table('pegawai')
                ->orderby('nama','asc')
                ->get();
                $list_pesanan = DB::table('list_pesanan')
                ->select('transaksi.id_pegawai','list_pesanan.id_paket','list_pesanan.*','paket_salon.paket','paket_salon.harga','paket_salon.fee_capster',DB::raw('sum(list_pesanan.jumlah_paket)as jumlah_paket'),'list_pesanan.id_paket')
                ->leftjoin('transaksi','transaksi.faktur','=','list_pesanan.faktur')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->orderby('list_pesanan.id_paket','desc')
                ->groupby('list_pesanan.id_paket','transaksi.id_pegawai')
                ->get();
                // dd($data);
            }
        }
        return view('backend.laporan.index', compact('data','pegawai','list_pesanan','active_pegawai','tanggal','active_tanggal'));
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
