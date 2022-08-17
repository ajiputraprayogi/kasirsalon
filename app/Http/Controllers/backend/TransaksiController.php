<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use DB;
use Carbon\Carbon;
use Auth;

class TransaksiController extends Controller
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
        // $cari
        $tgl=date("Ymd");
        // $min=date("-");
        // $fk=DB::table("transaksi")
        // ->select(DB::Raw("MAX(RIGHT(faktur,5)) as kd_max"));
        // if($fk->count()>0){
        //     foreach($fk->get() as $fak){
        //         $tmp=((int)$fak->kd_max)+1;
        //         $finalkode=sprintf("TRF".$tgl.'%00s',$tmp);
        //     }
        // }else{
        //     $finalkode="TRF".$tgl."1";
        // }
        $toko = Auth::user()->id_toko;
        // dd($toko);
        $faktur = "TRF".$tgl;
        $carikode = DB::table('transaksi')
        ->where('faktur','like','%'.$faktur.$toko.'%')
        ->max('faktur');
        // dd($carikode);
        if(!$carikode){
            $finalkode = $faktur.$toko.'.1';
        }else{
            $getnumber = explode('.',$carikode);
            $jumlah = count($getnumber);
            $newno = $getnumber[$jumlah-1]+1;
            $finalkode = $faktur.$toko.'.'.$newno;
        }
        // dd($finalkode);
        $data = DB::table('list_pesanan')
                ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                ->leftjoin('produk','produk.id','=','list_pesanan.id_produk')
                ->select('list_pesanan.*','paket_salon.paket','paket_salon.harga','produk.nama','produk.harga as hargap')
                ->where('list_pesanan.faktur', $finalkode)
                ->orderby('produk.nama','ASC')
                ->orderby('paket_salon.paket', 'ASC')
                ->get();
        Blade::directive('currency', function ( $data ) { return "Rp. <?php echo number_format($data,0,',','.'); ?>"; });
        // dd($data);
        $diskon = DB::table('diskon')
        ->get();
        // dd($diskon);
        return view('backend.transaksi.index', compact('finalkode','data','diskon'));
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
        
    }

    public function insert_transaksi(Request $request)
    {
        
        $tgl=date("Ymd");
        // $min=date("-");
        // $fk=DB::table("transaksi")
        // ->select(DB::Raw("MAX(RIGHT(faktur,5)) as kd_max"));
        // if($fk->count()>0){
        //     foreach($fk->get() as $fak){
        //         $tmp=((int)$fak->kd_max)+1;
        //         $finalkode=sprintf("TRF".$tgl.'%00s',$tmp);
        //     }
        // }else{
        //     $finalkode="TRF".$tgl."1";
        // }
        $toko = Auth::user()->id_toko;
        // dd($toko);
        $faktur = "TRF".$tgl;
        $carikode = DB::table('transaksi')
        ->where('faktur','like','%'.$faktur.$toko.'%')
        ->max('faktur');
        // dd($carikode);
        if(!$carikode){
            $finalkode = $faktur.$toko.'.1';
        }else{
            $getnumber = explode('.',$carikode);
            $jumlah = count($getnumber);
            $newno = $getnumber[$jumlah-1]+1;
            $finalkode = $faktur.$toko.'.'.$newno;
        }
        // dd($finalkode);
        if($request->tunai < $request->total){
            $tunai = $request->tunai;
            if($tunai==''){
                $gagal = ", Tunai Rp. 0".", jumlah tunai kurang";
            }else{
                $gagal = ", Tunai Rp. ".$tunai.", jumlah tunai kurang";
            }
            return redirect('/backend/transaksi')->with('gagal', 'Transaksi gagal'.$gagal);
        }else{
            $id_user = Auth::user()->id;
            DB::table('transaksi')->insert([
                'faktur' => $finalkode,
                'id_user' => $id_user,
                'id_pegawai' => $request->pegawai,
                'id_customer' => $request->customer,
                'subtotal' => $request->subtotal,
                'namadiskon' => $request->namadiskon,
                'diskon' =>$request->diskon,
                'total' => $request->total,
                'tunai' => $request->tunai,
                'kembali' => $request->kembali,
                "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
            ]);
            $cariproduk = DB::table('list_pesanan')
            ->select('id_produk','jumlah_produk')
            ->where('faktur',$finalkode)->get();
            foreach($cariproduk as $produk){
                if($produk->id_produk!=''){
                    $stok = DB::table('produk')->where('id', $produk->id_produk)->first();
                    $kurangi_stok = $stok->stok - $produk->jumlah_produk;
                    
                    $update_stok = DB::table('produk')->where('id', $produk->id_produk)->update([
                        'stok' => $kurangi_stok
                    ]);
                }
            }
            $url = "/backend/cetaknota/$finalkode";
            // session()->flash('url' ,$url);
            // dd($stok);
            return redirect('/backend/transaksi')->with('status', 'Transaksi berhasil, Kembali: Rp. '.$request->kembali)->with('url', $url);
            // return redirect('/backend/cetaknota/'.$finalkode);
        }
    }

    public function cetaknota($id){
        $data = DB::table('transaksi')
        ->leftjoin('list_pesanan','list_pesanan.faktur','=','transaksi.faktur')
        ->leftjoin('users','users.id','=','transaksi.id_user')
        ->leftjoin('pegawai','pegawai.id','=','transaksi.id_pegawai')
        ->leftjoin('customer','customer.id','=','transaksi.id_customer')
        ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
        ->leftjoin('produk','produk.id','=','list_pesanan.id_produk')
        ->leftjoin('toko','toko.id','=','users.id_toko')
        ->where('transaksi.faktur',$id)
        ->select([
            'transaksi.*',
            'users.name as kasir',
            'customer.nama as customer',
            'customer.no_wa as telp',
            'paket_salon.paket',
            'paket_salon.harga as hargapk',
            'produk.nama as produk',
            'list_pesanan.jumlah_paket',
            'toko.nama as toko',
            'toko.alamat',
            'toko.telp as hp_toko'
            ])
        ->groupby('transaksi.faktur')
        ->get();
        return view('backend.transaksi.cetak', compact('data'));
    }

    public function insert_list_pesanan(Request $request)
    {
        $faktur = $request->faktur;
        $paket = $request->paket;
        $produk = $request->produk;
        if($request->produk==''){
            $paket_array = [];
            foreach($paket as $data){
                if(! empty($data)){
                    DB::table('list_pesanan')->insert([
                        $paket_array [] = [
                            'faktur' => $request->faktur,
                            'id_paket' => $data,
                            'jumlah_paket'=> '1',
                            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                        ]
                    ]);
                }
            }
        }elseif($request->paket==''){
            $produk_array = [];
            foreach($produk as $data){
                if(! empty($data)){
                    DB::table('list_pesanan')->insert([
                        $produk_array[] = [
                            'faktur' => $request->faktur,
                            'id_produk' => $data,
                            'jumlah_produk'=> '1',
                            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                        ]
                    ]);
                }
            }
        }else{
            $paket_array = [];
            foreach($paket as $data){
                if(! empty($data)){
                    DB::table('list_pesanan')->insert([
                        $paket_array [] = [
                            'faktur' => $request->faktur,
                            'id_paket' => $data,
                            'jumlah_paket' => '1',
                            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                        ]
                    ]);
                }
            }
            $produk_array = [];
            foreach($produk as $data){
                if(! empty($data)){
                    DB::table('list_pesanan')->insert([
                        $produk_array[] = [
                            'faktur' => $request->faktur,
                            'id_produk' => $data,
                            'jumlah_produk' => '1',
                            "created_at" =>  \Carbon\Carbon::now(), # new \Datetime()
                            "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                        ],
                    ]);
                }
            }
        }
        return redirect('/backend/transaksi');
    }

    public function update_list_pesanan(Request $request)
    {
        if($request->id2==''){
            $index = 0;
            foreach($request->id as $id){
                $data = DB::table('list_pesanan')->where('id', $id)->update([
                    'jumlah_paket'=>$request->qty[$index],
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                $index++;
            }
        }elseif($request->id==''){
            $index2 = 0;
            foreach($request->id2 as $id2){
                $data = DB::table('list_pesanan')->where('id', $id2)->update([
                    'jumlah_produk'=>$request->qty2[$index2],
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                $index2++;
            }
        }else{
            $index = 0;
            foreach($request->id as $id){
                $data = DB::table('list_pesanan')->where('id', $id)->update([
                    'jumlah_paket'=>$request->qty[$index],
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                $index++;
            }
            $index2 = 0;
            foreach($request->id2 as $id2){
                $data = DB::table('list_pesanan')->where('id', $id2)->update([
                    'jumlah_produk'=>$request->qty2[$index2],
                    "updated_at" => \Carbon\Carbon::now(),  # new \Datetime()
                ]);
                $index2++;
            }
        }
        // dd($data);
        return redirect('backend/transaksi');
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
        DB::table('list_pesanan')->where('id', $id)->delete();
        return redirect('/backend/transaksi');
    }
}
