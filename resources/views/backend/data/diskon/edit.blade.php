@extends('layouts.base')
@section('title')
    Edit Diskon
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
                                    <h4 class="card-title">Edit Diskon</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                @foreach($data as $row)
                                <form action="{{url('/backend/diskon/'.$row->id)}}" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                    <div class="form-group">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control" id="" placeholder="Masukkan Nama" name="nama" value="{{$row->nama}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Diskon</label>
                                        <input type="number" class="form-control" id="" placeholder="Masukkan Diskon" name="diskon" value="{{$row->diskon}}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select class="form-control" name="status" id="">
                                            @if($row->status=='Y')
                                                <option value="Y">Aktif</option>
                                                <option value="N">Tidak aktif</option>
                                            @elseif($row->status=='N')
                                                <option value="N">Tidak aktif</option>
                                                <option value="Y">Aktif</option>
                                            @endif
                                        </select>    
                                    </div>
                                    <div class="form-group text-right">
                                        <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        <button type="reset" onclick="history.go(-1)" class="btn btn-danger btn-sm">Batal</button>
                                    </div>
                                </form>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection