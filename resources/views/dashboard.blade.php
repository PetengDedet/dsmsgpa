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
            <form action="{{url('riwayat')}}" class="dropzone">
                <div class="fallback">
                    <input name="file" type="file" class="riwayat" multiple />
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
<script type="text/javascript">
    $(".riwayat").dropzone({ url: "{{url('dashboard')}}" });
</script>
@endsection
