@extends('adminlte::page')

@section('title', 'Pelantikan Baru')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.css')}}">
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('css/select2.min.css')}}"> --}}
@endsection

@section('content_header')
    <h1><i class="fa fa-credit-card-alt"></i>&nbsp; Pelantikan Baru</h1>
@endsection

@section('content')
    @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

    @if(Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('pelantikan')}}">Pelantikan</a></li>
                <li class="active">Pelantikan Baru</li>
            </ol>
        </div>
        <div class="box-body">
            <div class="col-md-8">
                <form role="form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="personalia" class="control-label col-md-3">Personalia</label>
                        <div class="col-md-9">
                            <select name="personalia" id="personalia" class="form-control select2" data-placeholder="Pilih/ketik nama atau nomor personalia" required>
                                @if(Session::has('personalia'))
                                    <option value="{{session('personalia')->hashid}}" selected>
                                        {{session('personalia')->nama}} 
                                        @if(session('personalia')->alias !== null) 
                                            ({{session('personalia')->alias}}) 
                                        @endif
                                        {{' - ' . session('personalia')->nomor}}
                                    </option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lembaga" class="control-label col-md-3">Lembaga/Institusi</label>
                        <div class="col-md-9">
                            <select name="lembaga" id="lembaga" class="form-control select2" data-placeholder="Pilih nama lembaga" required>
                                @forelse($lembaga as $k => $v)
                                    <option value="{{$v->hashid}}" @if(old('lembaga') && old('lembaga') == $v->hashid) selected @endif>{{$v->nama_lembaga}} - {{$v->alias}} ({{ucwords(str_replace('_', ' ',$v->jenis_lembaga))}})</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="jabatan" class="control-label col-md-3">Jabatan</label>
                        <div class="col-md-9">
                            <select name="jabatan" id="jabatan" class="form-control select2" data-placeholder="Pilih nama jabatan" required>
                                @forelse($jabatan as $k => $v)
                                    <option value="{{$v->hashid}}" @if(old('jabatan') && old('jabatan') == $v->hashid) selected @endif>{{$v->nama_jabatan}} - ({{ucwords(str_replace('_', ' ',$v->jenis_jabatan))}})</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="masa" class="control-label col-md-3">Masa Pengabdian</label>
                        <div class="col-md-9">
                            <div class="input-daterange input-group" id="masa">
                                <input type="text" class="form-control" name="sejak" value="{{old('sejak')}}" required>
                                <span class="input-group-addon">s/d</span>
                                <input type="text" class="form-control" name="hingga" value="{{old('hingga')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dokumen_pendukung" class="control-label col-md-3">Dokumen Pendukung</label>
                        <div class="col-md-9">
                            <input type="file" name="dokumen_pendukung" class="form-control">
                            <span class="help-block">-Surat Keputusan (SK)<br>-File: PDF, JPG/JPEG<br>-Maksimal: 2MB</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dasar_keputusan" class="control-label col-md-3">Dasar Keputusan</label>
                        <div class="col-md-9">
                            <textarea name="dasar_keputusan" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="control-label col-md-3">Keterangan</label>
                        <div class="col-md-9">
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3">
                            {{csrf_field()}}
                        </div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success btn-flat pull-right">Simpan <i class="fa fa-save"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-4 well">
                <h3 class="text-center">
                    <i class="fa fa-info-circle"></i>
                </h3>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript" src="{{asset('js/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/bootstrap-datepicker.id.min.js')}}"></script>
    <script type="text/javascript">
        $('.input-daterange').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });
        $("#personalia").select2({
            ajax: {
                url: "{{url('personalia/getJSON')}}"
            },
            cache: true,
            dataType: 'json',
            delay: 250,
            minimumInputLength: 1
        });
        $("#lembaga, #jabatan").select2();
    </script>
@endsection
