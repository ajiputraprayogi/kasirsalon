@extends('layouts.base')
@section('title')
    Tambah Customer
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
                                    <h4 class="card-title">Tambah Customer</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{url('/backend/customer')}}" method="post">
                                @csrf
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" id="" placeholder="Masukkan Nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <input type="text" class="form-control" id="" placeholder="Masukkan Alamat" name="alamat">
                                    </div>
                                    <div class="form-group">
                                        <label for="">No WhatsApp</label>
                                        <input type="number" class="form-control" id="" placeholder="Masukkan No WhatsApp" name="no_wa">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" id="" placeholder="Masukkan Email" name="email">
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