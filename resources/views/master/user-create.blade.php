@extends('adminlte::page')

@section('title', 'Tambah User')

@section('css')
@endsection

@section('content_header')
    <h1><i class="fa fa-user-secret"></i>&nbsp; Tambah User</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('master/user')}}">User</a></li>
                <li class="active">Tambah User</li>
            </ol>
        </div>
        <div class="box-body">
            <form role="form" class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <label for="username" class="control-label col-md-3">Username</label>
                    <div class="col-md-6">
                        <input type="text" name="username" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Jenis</label>
                    <div class="col-md-6">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default active">
                                <input type="radio" name="type" value="admin" autocomplete="off" checked> Admin
                            </label>
                            <label class="btn btn-default">
                                <input type="radio" name="type" value="user" autocomplete="off"> User
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label col-md-3">Password</label>
                    <div class="col-md-6">
                        <input type="password" name="password" class="form-control" required>
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
