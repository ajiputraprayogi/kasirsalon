@extends('layouts.base')
@section('title')
    Data History Transaksi
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
<link href="{{asset('assets/plugins/select2/filter-history-transaksi/css/select2.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection
@section('content')
<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data History Transaksi</h4>
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
								<a href="#">History Transaksi</a>
							</li>
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							@if(session('status'))
								<div class="alert alert-success">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4>Info!</h4>
									{{ session('status') }}
								</div>
							@endif
							<div class="card">
								<div class="card-header">
                                    <div class="card-head-row">
                                        <h4 class="card-title">History Transaksi</h4>
                                    </div>
								</div>
								<div class="card-body">
                                    <form method="get">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2" name="toko" id="toko">
                                                        <option value="Semua Toko">Semua Toko</option>
                                                        @foreach($toko as $row_toko)
                                                        <option value="{{$row_toko->id}}" @if($active_toko==$row_toko->id) selected
                                                            @endif>{{$row_toko->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select class="form-control select2" name="pegawai" id="pegawai">
                                                        <option value="Semua Pegawai">Semua Pegawai</option>
                                                        @foreach($pegawai as $row_pegawai)
                                                        <option value="{{$row_pegawai->id}}" @if($active_pegawai==$row_pegawai->id) selected
                                                            @endif>{{$row_pegawai->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <style>
                                                    .border{
                                                        border: 2px solid red;
                                                        border-radius: 4px;
                                                    }
                                                </style>
                                                @if($tanggal=='')
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <input class="form-control border" id="tanggal" name="tanggal" placeholder="Pilih Tanggal" autocomplete="off"/>
                                                        <div class="input-group-prepend" style="border-radius:10p;">
                                                            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                                                            <a href="{{url('/backend/history-transaksi')}}" class="btn btn-secondary"
                                                                style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                                                    class="fas fa-sync"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="form-group">
                                                    <div class="input-group mb-3">
                                                        <input class="form-control border" id="tanggal" name="tanggal" placeholder="Pilih Tanggal" value="{{$tanggal}}" autocomplete="off"/>
                                                        <div class="input-group-prepend" style="border-radius:10p;">
                                                            <button type="submit" class="btn btn-secondary"><i class="fas fa-search"></i></button>
                                                            <a href="{{url('/backend/history-transaksi')}}" class="btn btn-secondary"
                                                                style="border-top-right-radius: 10px;border-bottom-right-radius: 10px;"><i
                                                                    class="fas fa-sync"></i></a>
                                                        </div>
                                                    </div>    
                                                </div>
                                                @endif
                                            </div>

                                        </div>
                                    </form>
                                    <div class="form-group"></div>
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Kode Transaksi</th>
                                                    <th>Total</th>
                                                    <th>Tunai</th>
                                                    <th>Kembali</th>
                                                    <th>Customer</th>
                                                    <th>Pegawai</th>
												</tr>
											</thead>
											<tfoot>
												<tr>
                                                    <th>Kode Transaksi</th>
                                                    <th>Total</th>
                                                    <th>Tunai</th>
                                                    <th>Kembali</th>
                                                    <th>Customer</th>
                                                    <th>Pegawai</th>
												</tr>
											</tfoot>
											<tbody>
                                                @foreach($data as $row)
                                                    <tr>
                                                        <td>{{$row->faktur}}</td>
                                                        <td>{{$row->total}}</td>
                                                        <td>{{$row->tunai}}</td>
                                                        <td>{{$row->kembali}}</td>
                                                        <td>{{$row->nama}}</td>
                                                        <td>{{$row->namap}}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
										</table>
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
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('assets/plugins/select2/filter-history-transaksi/js/select2.min.js')}}"></script>
<script src="{{asset('customjs/backend/filter_history_transaksi.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    $(function() {
    flatpickr("#tanggal", {
        enableTime: false,
        dateFormat: "d-m-Y",
        mode: "range",
    });
    // $("#tanggal").prop('readonly', false);
    });
</script>
<script>
	function hapusdata(kode) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: true
    })
    swalWithBootstrapButtons.fire({
        title: 'Hapus Data ?',
        text: "Data tidak dapat di pulihkan kembali!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'DELETE',
                url: '/backend/history-transaksi/' + kode,
                data: {
                    '_token': $('input[name=_token]').val(),
                },
                success: function () {
                    swalWithBootstrapButtons.fire(
                        'Deleted!',
						'Data Berhasil Dihapus.',
						'success'
                    )
                    location.reload();
                }
            });
        }
    })
}
</script>
<script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
                aaSorting : [[0, 'desc']],
			});

			$('#multi-filter-select').DataTable( {
				"pageLength": 5,
				initComplete: function () {
					this.api().columns().every( function () {
						var column = this;
						var select = $('<select class="form-control"><option value=""></option></select>')
						.appendTo( $(column.footer()).empty() )
						.on( 'change', function () {
							var val = $.fn.dataTable.util.escapeRegex(
								$(this).val()
								);

							column
							.search( val ? '^'+val+'$' : '', true, false )
							.draw();
						} );

						column.data().unique().sort().each( function ( d, j ) {
							select.append( '<option value="'+d+'">'+d+'</option>' )
						} );
					} );
				}
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
		});
	</script>
@endsection