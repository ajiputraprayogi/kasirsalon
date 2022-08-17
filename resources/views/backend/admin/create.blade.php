@extends('layouts.base')
@section('title')
    Tambah Admin
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
                                    <h4 class="card-title">Tambah Admin</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{url('/backend/admin')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" id="" placeholder="Masukkan Nama" name="nama" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" id="" placeholder="Masukkan Username" name="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" id="" placeholder="Masukkan Email" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="">No. Telp</label>
                                        <input type="text" class="form-control" id="" placeholder="Masukkan No. Telp" name="telp">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Toko</label>
                                        <select name="toko" class="form-control">
                                            @foreach($toko as $row_toko)
                                            <option value="{{$row_toko->id}}">{{$row_toko->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Level</label>
                                        <select name="level" class="form-control">
                                            @foreach($roles as $row_roles)
                                            <option value="{{$row_roles->name}}">{{$row_roles->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Gambar</label>
                                        <input type="file" class="form-control" name="gambar" accept="image/*" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input type="password" class="form-control" id="password" name="userpassword"
                                            autocomplete="new-password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Konfirmasi Password</label>
                                        <input type="password" class="form-control" id="kpassword" required>
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