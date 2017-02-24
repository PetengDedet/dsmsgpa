@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')        
    <div class="box">
        <div class="box-heading">
        	<ol class="breadcrumb">
        		<li class="active"><a href="#"><i class="fa fa-home"></i></a></li>
        	</ol>
        </div>
        <div class="box-body">
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
<script type="text/javascript">
</script>
@endsection
