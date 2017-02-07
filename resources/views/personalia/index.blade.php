@extends('adminlte::page')

@section('title', 'Personalia')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/dataTables.bootstrap.min.css')}}">
@endsection

@section('content_header')
    <h1><i class="fa fa-users"></i>&nbsp; Personalia</h1>
@endsection

@section('content')
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                <li class="active"><a href="#">Personalia</a></li>
            </ol>
        </div>
        <div class="box-body">
            <a href="{{url('personalia/create')}}" class="btn btn-default"><i class="fa fa-plus"></i>&nbsp;Tambah Personalia Baru</a>
            <br>
            <br>
            <div>
                {!! $dataTable->table() !!}
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('/js/jquery-datatables.js')}}" type="text/javascript"></script> 
    <script src="{{asset('/js/datatables.js')}}" type="text/javascript"></script>
    {!! $dataTable->scripts() !!}
@endsection
