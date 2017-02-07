@extends('adminlte::page')

@section('title', 'Tambah Lembaga')

@section('css')
@endsection

@section('content_header')
    <h1><i class="fa fa-bank"></i>&nbsp; Tambah Lembaga</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('master/lembaga')}}">Lembaga</a></li>
                <li class="active">Tambah Lembaga</li>
            </ol>
        </div>
        <div class="box-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form role="form" class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Jenis</label>
                    <div class="col-md-6">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default active">
                                <input type="radio" name="jenis_lembaga" value="pendidikan" autocomplete="off" checked> Pendidikan
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="jenis_lembaga" value="non_pendidikan" autocomplete="off"> Non Pendidikan
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama" class="control-label col-md-3">Nama Lembaga</label>
                    <div class="col-md-6">
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alias" class="control-label col-md-3">Alias <small>(Optional)</small></label>
                    <div class="col-md-6">
                        <input type="text" name="alias" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="alamat" class="control-label col-md-3">Alamat <small>(Optional)</small></label>
                    <div class="col-md-6">
                        <textarea name="alamat" class="form-control"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="induk" class="control-label col-md-3">Induk Langsung <small>(Optional)</small></label>
                    <div class="col-md-6">
                        <select name="induk_langsung" class="form-control">
                            <option>--Pilih Lembaga--</option>
                            @forelse($lembaga as $k => $v)
                                <option value="{{$v->hashid}}">{{$v->nama_lembaga}}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-md-offset-3">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default pull-right">Simpan <i class="fa fa-save"></i></button>
                    
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
@endsection
