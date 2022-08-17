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
                                <form action="{{url('/backend/admin/'.$data->id)}}" role="form" method="post" enctype="multipart/form-data">
                                @csrf
                                    <input type="hidden" name="_method" value="PUT">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama" name="nama" value="{{$data->name}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Username</label>
                                        <input type="hidden" name="oldusername" value="{{$data->username}}">
                                        <input type="text" class="form-control" name="username"
                                            value="{{$data->username}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="hidden" name="oldemail" value="{{$data->email}}">
                                        <input type="email" class="form-control" name="email" value="{{$data->email}}"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">No. Telp</label>
                                        <input type="text" class="form-control" id="telp" placeholder="Masukkan No. Telp" name="telp" value="{{$data->telp}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Toko</label>
                                        <select name="toko" class="form-control">
                                            @foreach($toko as $row_toko)
                                            <option value="{{$row_toko->id}}" @if($data->id_toko==$row_toko->id)
                                                selected
                                                @endif>{{$row_toko->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Level</label>
                                        <select name="level" class="form-control">
                                            @foreach($roles as $row_roles)
                                            <option value="{{$row_roles->name}}" @if($data->level==$row_roles->name)
                                                selected
                                                @endif>{{$row_roles->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @if($data->gambar!='')
                                    <div class="col-md-12">
                                        <img src="{{asset('img/admin/'.$data->gambar)}}" alt="" class="img-thumbnail"
                                            width="200px;">
                                        <br>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        <label for="exampleInputFile">Gambar Baru*</label>
                                        <input type="file" class="form-control" name="gambar" accept="image/*">
                                        <input type="hidden" name="gambar_lama" value="{{$data->gambar}}">
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