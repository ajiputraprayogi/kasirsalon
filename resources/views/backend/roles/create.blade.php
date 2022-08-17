@extends('layouts.base')
@section('title')
    Tambah Roles
@endsection
@section('content')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-head-row">
                                    <h4 class="card-title">Tambah Roles</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{url('/backend/roles')}}" method="post">
                                @csrf
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" id="" placeholder="Masukkan Nama" name="nama" required>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="exampleInputEmail1">Pilih Permission</label>
                                        </div>
                                        @foreach($data_permission as $row_data_permission)
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" name="permission[]"
                                                        id="customCheckbox{{$row_data_permission->id}}"
                                                        value="{{$row_data_permission->id}}">
                                                    <label for="customCheckbox{{$row_data_permission->id}}"
                                                        class="custom-control-label">{{$row_data_permission->name}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox"
                                                id="checkall">
                                            <label for="checkall"
                                                class="custom-control-label">Pilih Semua</label>
                                        </div>
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        <button type="reset" onclick="history.go(-1)" class="btn btn-danger btn-sm">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('customjs')
<script>
$('#checkall').on('click',function(event) {
    if (this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
});
</script>
@endsection