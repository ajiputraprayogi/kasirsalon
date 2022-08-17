@extends('layouts.pdf')
@section('style')
<style>
    table.receipt-table {
        width: 310px;
        border-collapse: collapse;
    }
    table.receipt-table th {
        padding: 5px 0;
    }
    table.receipt-table td {
        padding: 3px 0;
    }
</style>
@endsection
@section('content')
    @foreach($data as $row)
        <table class="receipt-table">
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">.</td>
                    <td class="text-center">.</td>
                    <td class="text-center">.</td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <h3 class="text-center">{{$row->toko}}</h3>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-center">
                        {{$row->alamat}}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-center">
                        {{$row->hp_toko}}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="width:100px">Kode Transaksi</td>
                    <td class="strong">: {{$row->faktur}}</td>
                    <td class="text-right">{{ date('d-m-Y') }}</td>
                </tr>
                <tr>
                    <td>Kasir</td>
                    <td>: {{$row->kasir}}</td>
                    <td class="text-right">{{ date('H:i:s')}}</td>
                </tr>
                <tr>
                    <td>Customer</td>
                    <td>: {{$row->customer}}</td>
                </tr>
                <tr>
                    <td>No. Telp</td>
                    <td>: {{$row->telp}}</td>
                </tr>
                <tr>
                    <th class="text-left"><b>List Pesanan</b></th>
                </tr>
                <tr>
                    <th class="text-left border-bottom"><b>Jumlah</b></th>
                    <th class="text-right border-bottom"><b>Harga</b></th>
                    <th class="text-right border-bottom" style="width:90px"><b>Subtotal</b></th>
                </tr>
                @php
                    $list_pesanan = DB::table('list_pesanan')
                    ->leftjoin('transaksi','transaksi.faktur','=','list_pesanan.faktur')
                    ->leftjoin('paket_salon','paket_salon.id','=','list_pesanan.id_paket')
                    ->leftjoin('produk','produk.id','=','list_pesanan.id_produk')
                    ->orderby('list_pesanan.id_paket','desc')
                    ->where('list_pesanan.faktur', $row->faktur)
                    ->select([
                        'paket_salon.paket',
                        'paket_salon.harga as hargapk',
                        'produk.nama as produk',
                        'produk.harga as hargapr',
                        'list_pesanan.id_paket',
                        'list_pesanan.jumlah_paket',
                        'list_pesanan.id_produk',
                        'list_pesanan.jumlah_produk'
                        ])
                    ->get();
                    //dd($list_pesanan);
                @endphp
                <?php
                $no=1;
                ?>
                @foreach($list_pesanan as $item)
                <tr>
                    <td class="strong">{{$no++}})&nbsp;
                        @if($item->id_produk=='')
                            {{$item->paket}}
                        @elseif($item->id_paket=='')
                            {{$item->produk}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="text-center border-bottom" style="vertical-align: top;">
                        @if($item->id_produk=='')
                            {{$item->jumlah_paket}}
                        @elseif($item->id_paket=='')
                            {{$item->jumlah_produk}}
                        @endif
                    </td>
                    <td class="text-right border-bottom">
                        @if($item->id_produk=='')
                            Rp. {{$item->hargapk}}
                        @elseif($item->id_paket=='')
                            Rp. {{$item->hargapr}}
                        @endif
                    </td>
                    <td class="text-right border-bottom">
                        @if($item->id_produk=='')
                            <?php
                                $subtotal_paket = $item->hargapk * $item->jumlah_paket;
                            ?>
                            Rp. {{$subtotal_paket}} 
                        @elseif($item->id_paket=='')
                            <?php
                                $subtotal_produk = $item->hargapr * $item->jumlah_produk;
                            ?>
                            Rp. {{$subtotal_produk}} 
                        @endif
                    </td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="2" class="text-right">Total :</th>
                    <th class="text-right">Rp. {{$row->subtotal}}</th>
                </tr>
                <tr>
                    <th colspan="2" class="text-right">{{$row->namadiskon}} :</th>
                    <th class="text-right">Rp. {{$row->diskon}}</th>
                </tr>
                <tr>
                    <th colspan="2" class="text-right">Bayar :</th>
                    <th class="text-right">Rp. {{$row->tunai}}</th>
                </tr>
                <tr>
                    <th colspan="2" class="text-right">Kembali :</th>
                    <th class="text-right">Rp. {{$row->kembali}}</th>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>**********************</td>
                    <td class="text-center">
                        ************************* <br>
                        Terima kasih
                    </td>
                    <td>**********************</td>
                </tr>
                <tr>
                    <td>**********************</td>
                    <td class="text-center">
                        *************************
                    </td>
                    <td>**********************</td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-center">
                        <i class="fab fa-instagram"> cutlers_barberhouse</i>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center">.</td>
                    <td class="text-center">.</td>
                    <td class="text-center">.</td>
                </tr>
            </tbody>
        </table>
    @endforeach
@endsection