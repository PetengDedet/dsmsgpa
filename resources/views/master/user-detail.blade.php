@extends('adminlte::page')

@section('title', 'Detail User')

@section('css')
@endsection

@section('content_header')
    <h1><i class="fa fa-user-secret"></i>&nbsp; Detail User</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
                <ol class="breadcrumb">
                    <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                    <li><a href="{{url('master/user')}}">User</a></li>
                    <li class="active">Detail User</li>
                </ol>
        </div>
        <div class="box-body">
            <div class="box-body box-profile">
                <h3 class="profile-username text-center">{{$user->name}}</h3>
                <p class="text-muted text-center">{{$user->username}}</p>
                <p class="text-muted text-center">{{$user->email}}</p>
                <ul class="list-group list-group-unbordered">
                    <li class="list-group-item">
                        <b>Tipe</b> <a class="pull-right">{{strtoupper($user->type)}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
