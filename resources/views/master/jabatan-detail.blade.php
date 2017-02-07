@extends('adminlte::page')

@section('title', 'Detail Jabatan')

@section('css')
@endsection

@section('content_header')
    <h1><i class="fa fa-shield"></i>&nbsp; Detail Jabatan</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
                <ol class="breadcrumb">
                    <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                    <li><a href="{{url('master/jabatan')}}">Jabatan</a></li>
                    <li class="active">Detail Jabatan</li>
                </ol>
        </div>
        <div class="box-body">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center">{{$jabatan->nama_jabatan}}</h3>
                <p class="text-muted text-center">{{$jabatan->alias_jabatan}}</p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Tipe</b> <a class="pull-right">{{strtoupper(str_replace('_', ' ', $jabatan->jenis_jabatan))}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Tugas</b> <a class="pull-right">{{$jabatan->tugas_jabatan}}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Keterangan</b>
                        <a class="pull-right">{{$jabatan->keterangan}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
