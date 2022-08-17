@extends('layouts.base')
@section('title')
    Data Customer
@endsection
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('content')
<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Data Customer</h4>
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
								<a href="#">Data Master</a>
							</li>
							<li class="separator">
								<i class="flaticon-right-arrow"></i>
							</li>
							<li class="nav-item">
								<a href="#">Data Customer</a>
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
                                        <h4 class="card-title">Customer</h4>
                                        <div class="card-tools">
                                            <a href="{{url('backend/customer/create')}}" class="btn btn-info btn-sm mr-2">
                                                <span class="btn-label">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                                Tambah Customer
                                            </a>
                                        </div>
                                    </div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>No WhatsApp</th>
                                                    <th>Email</th>
													<th><center>Aksi</center></th>
												</tr>
											</thead>
											<tfoot>
												<tr>
                                                    <th>Nama</th>
                                                    <th>Alamat</th>
                                                    <th>No WhatsApp</th>
                                                    <th>Email</th>
													<th><center>Aksi</center></th>
												</tr>
											</tfoot>
											<tbody>
                                                @foreach($data as $row)
                                                <tr>
                                                    <td>{{$row->nama}}</td>
                                                    <td>{{$row->alamat}}</td>
                                                    <td>{{$row->no_wa}}</td>
                                                    <td>{{$row->email}}</td>
                                                    <td>
                                                        <center>
                                                            <a href="{{('/backend/customer/'.$row->id.'/edit')}}" class="btn btn-info btn-xs" title="Edit">
                                                                <span>
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </span>
                                                            </a>
															<button title="Hapus" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" onclick="hapusdata({{$row->id}})">
																<span>
                                                                    <i class="fas fa-trash-alt"></i>
                                                                </span>
															</button>
                                                        </center>
                                                    </td>
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
                url: '/backend/customer/' + kode,
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