@extends('adminlte::page')

@section('title', 'Sunting Lembaga')

@section('css')
@endsection

@section('content_header')
    <h1><i class="fa fa-bank"></i>&nbsp; Sunting Lembaga</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('master/lembaga')}}">Lembaga</a></li>
                <li class="active">Sunting Lembaga</li>
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
            <form role="form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="nama" class="control-label col-md-3">Nama Lembaga</label>
                    <div class="col-md-6">
                        <input type="text" name="nama" value="{{$lembaga->nama}}" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alias" class="control-label col-md-3">Alias</label>
                    <div class="col-md-6">
                        <input type="text" name="alias" value="{{$lembaga->alias}}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_pimpinan" class="control-label col-md-3">Nama Pimpinan</label>
                    <div class="col-md-6">
                        <input type="text" name="nama_pimpinan" value="{{$lembaga->nama_pimpinan}}" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="foto_pimpinan" class="control-label col-md-3">Foto Pimpinan</label>
                    <div class="col-md-6">
                        @if(strlen($lembaga->foto_pimpinan) > 0)
                            <img src="{{asset('img/' . $lembaga->foto_pimpinan)}}" width="150" height="auto"><br>
                        @endif
                        <input type="file" name="foto_pimpinan" required>
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
