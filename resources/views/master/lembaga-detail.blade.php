@extends('adminlte::page')

@section('title', 'Detail Lembaga')

@section('css')
@endsection

@section('content_header')
    <h1><i class="fa fa-bank"></i>&nbsp; Detail Lembaga</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
                <ol class="breadcrumb">
                    <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                    <li><a href="{{url('master/lembaga')}}">Lembaga</a></li>
                    <li class="active">Detail Lembaga</li>
                </ol>
        </div>
        <div class="box-body">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center">{{$lembaga->nama}}</h3>
                <p class="text-muted text-center">{{$lembaga->alias}}</p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Foto Pimpinan</b> <a class="pull-right">{{$lembaga->foto_pimpinan}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Nama Pimpinan</b> <a class="pull-right">{{$lembaga->nama_pimpinan}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
