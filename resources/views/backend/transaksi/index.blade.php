@extends('layouts.base')
@section('title')
    Transaksi
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('customcss')
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<style>
    .penting{
        color: red;
    }
</style>
@endsection
@section('content')
        <div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Transaksi</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Transaksi</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
                            @if (session()->has('url'))
                                <script>
                                    window.open('{{session()->get('url')}}', "_blank");
                                </script>
                            @endif
                            @if(session('gagal'))
								<div class="alert alert-danger">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4 style="color: red;">Info!</h4>
									{{ session('gagal') }}
								</div>
							@endif
                            @if(session('status'))
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4 style="color: #35cd3a">Info!</h4>
									{{ session('status') }}
								</div>
							@endif
							<div class="card">
								<div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h1><b>Total</b></h1>

                                        </div>
                                        <div class="col-md-8">
                                            <h1 class="text-right">
                                                <?php 
                                                    $total=0;
                                                    foreach($data as $row){
                                                        $subtotal_paket = $row->harga * $row->jumlah_paket;
                                                        $subtotal_produk = $row->hargap * $row->jumlah_produk;
                                                        $total = $total + $subtotal_paket + $subtotal_produk;
                                                    }
                                                    foreach($diskon as $rowdiskon){
                                                        $namadiskon = $rowdiskon->nama;
                                                        $diskon = $rowdiskon->diskon;
                                                        $total_akhir = $total - $diskon;
                                                        //dd($diskon);
                                                        if($total_akhir <= 0){
                                                            $total_akhir = "0";
                                                        }
                                                    }
                                                ?>
                                                <b>@currency($total_akhir)</b>
                                            </h1>
                                        </div>
                                    </div>
                                </div>
							</div>
                            <div class="row">
                                <div class="col-md-7">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('transaksi.list_pesanan.insert') }}" method="post">
                                            @csrf
                                                <input type="hidden" name="faktur" value="{{$finalkode}}">
                                                <div class="form-group">
                                                    <select class="form-control paket" name="paket[]" multiple="multiple" data-placeholder="Pilih Paket">
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <select class="form-control produk" name="produk[]" multiple="multiple" data-placeholder="Pilih Produk">
                                                    </select>
                                                    <input type="hidden" class="id_produk">
                                                </div>
                                                <div class="form-group text-right">
                                                    <button type="submit" class="btn btn-secondary btn-xs btn-border">Tambah ke list pesanan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="{{ route('transaksi.transaksi.insert') }}" method="POST" id="transaksi">
                                                @csrf
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center col-form-label" for="subtotal">Pegawai</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control form-control-sm pegawai" name="pegawai" data-placeholder="Pilih Pegawai" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center col-form-label" for="subtotal">Customer</label>
                                                    <div class="col-md-9">
                                                        <select class="form-control form-control-sm customer" name="customer" data-placeholder="Pilih Customer" required>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center col-form-label" for="subtotal">Subtotal</label>
                                                    <div class="col-md-9">
                                                    <?php 
                                                        $subtotal=0;
                                                        foreach($data as $row){
                                                            $subtotal_paket = $row->harga * $row->jumlah_paket;
                                                            $subtotal_produk = $row->hargap * $row->jumlah_produk;
                                                            $subtotal = $subtotal + $subtotal_paket + $subtotal_produk;
                                                        }
                                                        
                                                        $subtotal_akhir = $subtotal - $diskon;
                                                        if($subtotal_akhir <= 0){
                                                            $subtotal_akhir = "0";
                                                        }
                                                    ?>
                                                        <input type="hidden" class="form-control form-control-sm namadiskon" name="namadiskon" style="color:black; pointer-events: none;" value="{{$namadiskon}}">
                                                        <input type="hidden" class="form-control form-control-sm diskon" name="diskon" style="color:black; pointer-events: none;" value="{{$diskon}}">
                                                        <input type="hidden" class="form-control form-control-sm" name="subtotal" style="color:black; pointer-events: none;" value="{{$subtotal}}">
                                                        <input type="text" class="form-control form-control-sm subtotal" name="total" style="color:black; pointer-events: none;" value="{{$subtotal_akhir}}">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center col-form-label" for="subtotal">Tunai</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control form-control-sm tunai" name="tunai" id="hanyaAngka" style="color:black;" placeholder="0" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label class="control-label col-sm-3 align-self-center col-form-label" for="subtotal">Kembali</label>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control form-control-sm kembali" name="kembali" style="color:black; pointer-events: none;" value="0">
                                                    </div>
                                                </div>
                                                <div class="form-group text-right">
                                                    <button type="submit" value="submit" class="btn btn-secondary btn-xs btn-border selesai" form="transaksi">Bayar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <h4 class="card-title">List Pesanan</h4>
                                    </div>
								</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <form action="{{ route('transaksi.list_pesanan.update') }}" method="post">
                                        @csrf
                                            <!-- <input type="hidden" name="_method" value="put"> -->
                                            <table id="basic-datatables" class="display table table-striped table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Paket/Produk</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Subtotal</th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Paket/Produk</th>
                                                        <th>Harga</th>
                                                        <th>Jumlah</th>
                                                        <th>Subtotal</th>
                                                        <th><center>Aksi</center></th>
                                                    </tr>
                                                </tfoot>
                                                <tbody>
                                                    <?php
                                                        $no=0;
                                                        $no++;
                                                    ?>
                                                    @foreach($data as $row)
                                                    <tr>
                                                        <td>
                                                            {{$no++}}
                                                        </td>
                                                        <td>
                                                            @if($row->id_produk=='')
                                                                {{$row->paket}}
                                                            @elseif($row->id_paket=='')
                                                                {{$row->nama}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if($row->id_produk=='')
                                                                {{$row->harga}}
                                                            @elseif($row->id_paket=='')
                                                                {{$row->hargap}}
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <div class="input-group mb-3" style="max-width: 120px;">
                                                                <div class="input-group-prepend">
                                                                    <button class="btn btn-danger btn-xs btn-border js-btn-minus" type="button">&minus;</button>
                                                                </div>
                                                                @if($row->id_produk=='')
                                                                    <input type="hidden" name="id[]" value="{{$row->id}}">
                                                                    <input type="text" name="qty[]" class="form-control text-center" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="{{$row->jumlah_paket}}" style="pointer-events: none;">
                                                                @elseif($row->id_paket=='')
                                                                    <input type="hidden" name="id2[]" value="{{$row->id}}">
                                                                    <input type="text" name="qty2[]" class="form-control text-center" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" value="{{$row->jumlah_produk}}" style="pointer-events: none;">
                                                                @endif
                                                                <div class="input-group-append">
                                                                    <button class="btn btn-secondary btn-xs btn-border js-btn-plus" type="button">&plus;</button>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            @if($row->id_produk=='')
                                                                <?php
                                                                    $subtotal_paket = $row->harga * $row->jumlah_paket;
                                                                ?>
                                                                {{$subtotal_paket}}
                                                                @elseif($row->id_paket=='')
                                                                <?php
                                                                    $subtotal_produk = $row->hargap * $row->jumlah_produk;
                                                                ?>
                                                                {{$subtotal_produk}}
                                                                @endif
                                                        </td>
                                                        <td>
                                                            <center>
                                                                <a href="{{ route('transaksi.list_pesanan.delete',['id' => $row->id]) }}" class="btn btn-danger btn-xs" title="Edit">
                                                                    <span>
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </span>
                                                                </a>
                                                            </center>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="form-group">
                                                <small class="penting"><b> *Penting : </b> Jika Merubah Jumlah Pada List Pesanan Maka Klik Update List Pesanan Dulu Sebelum Melakukan Pembayaran</small><br><br>
                                                <button class="btn btn-info" type="submit">Update List Pesanan</button>
                                            </div>
                                        </form>
									</div>
                                </div>
                            </div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
@endsection
@section('customjs')
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('customjs/backend/transaksi.js')}}"></script>
<script>
	$(document).ready(function() {
		$('#basic-datatables').DataTable({
            searching: false,
            paging: false,
            info: false,
            // ordering: false
		});
	});
</script>
<script>
    var sitePlusMinus = function() {
		$('.js-btn-minus').on('click', function(e){
			e.preventDefault();
			if ( $(this).closest('.input-group').find('.form-control').val() != 1  ) {
				$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) - 1);
			} else {
				$(this).closest('.input-group').find('.form-control').val(parseInt(1));
			}
		});
		$('.js-btn-plus').on('click', function(e){
			e.preventDefault();
			$(this).closest('.input-group').find('.form-control').val(parseInt($(this).closest('.input-group').find('.form-control').val()) + 1);
		});
	};
	sitePlusMinus();
</script>
<script>
        $(function(){
            $("#hanyaAngka").keypress(function(e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });	
        })
        $(document).ready(function() {
            $(".tunai, .subtotal").keyup(function() {
                var tunai  = $(".tunai").val();
                var subtotal = $(".subtotal").val();

                var kembali = parseInt(tunai) - parseInt(subtotal);
                if(tunai==''){
                    $(".kembali").val("-"+subtotal);
                }else{
                    $(".kembali").val(kembali);
                }
            });
            
            // if($(".tunai").val() < $(".subtotal").val()){
            //     $('.selesai').prop('disabled', 'disabled');        // enables button
            // } else {
            //     $('.selesai').prop('disabled', false);   // disables button
            // }
            window.onunload = function() { debugger; }
        });
        // $(document).ready(function(){
        //     var rupiah = document.getElementById("rupiah");
        //     rupiah.addEventListener("keyup", function(e) {
        //     // tambahkan 'Rp.' pada saat form di ketik
        //     // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        //     rupiah.value = formatRupiah(this.value, "");
        //     });

        //     /* Fungsi formatRupiah */
        //     function formatRupiah(angka, prefix) {
        //     var number_string = angka.replace(/[^,\d]/g, "").toString(),
        //         split = number_string.split(","),
        //         sisa = split[0].length % 3,
        //         rupiah = split[0].substr(0, sisa),
        //         ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        //     // tambahkan titik jika yang di input sudah menjadi angka ribuan
        //     if (ribuan) {
        //         separator = sisa ? "." : "";
        //         rupiah += separator + ribuan.join(".");
        //     }

        //     rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        //     return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
        //     }

        // });
</script>
@endsection