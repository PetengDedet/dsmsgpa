@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')        
    {{-- <div class="box">
        <div class="box-body"> --}}
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$lembaga}}</h3>

                        <p>Lembaga</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-bank"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$jabatan}}</h3>

                        <p>Jenis Jabatan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shield"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$pelantikan}}</h3>

                        <p>Pelantikan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-credit-card-alt"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$personalia}}</h3>

                        <p>Personalia</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Selengkapnya <i class="fa fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
{{--         </div>
    </div> --}}
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
<script type="text/javascript">
</script>
@endsection
