@extends('adminlte::page')

@section('title', 'Detail Pelantikan')

@section('css')
    <style type="text/css">
        .preview {
            width: 100%;
            min-width: 400px;
            height: auto;
        }
    </style>
@endsection

@section('content_header')
    <h1><i class="fa fa-credit-card-alt"></i>&nbsp; Detail Pelantikan</h1>
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
                <li class="active">Detail Pelantikan: {{$pelantikan->hashid}}</li>
            </ol>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                <dl class="dl-horizontal">
                    <dt>Personalia</dt>
                    <dd>
                        {{$pelantikan->personalia->nama}}
                        <a href="{{url('personalia/lihat/' . $pelantikan->personalia->hashid)}}">
                            ({{$pelantikan->personalia->nomor}})
                        </a>
                        <br>
                        {!!(($pelantikan->personalia->jk == 'L') ? '<i class="fa fa-male"></i> Laki laki' : '<i class="fa fa-female" style="color:red;"></i> Perempuan' )!!}
                        <br>
                        {{$pelantikan->personalia->tempat_tanggal_lahir . ' (' . $pelantikan->personalia->umur . ' Th)'}}
                        <br>
                        <br>
                    </dd>
                    <dt>Lembaga</dt>
                    <dd>
                        {{$pelantikan->lembaga->nama_lembaga}}
                        <br>
                        {{$pelantikan->lembaga->format_jenis}}
                        <br>
                        <br>
                    </dd>
                    <dt>Periode</dt>
                    <dd>
                        <strong>{{$pelantikan->jabatan->nama_jabatan}} <small>({{$pelantikan->jabatan->format_jenis}})</small></strong>
                        <br>
                        {{$pelantikan->period['formatSejak']}} - {{$pelantikan->period['formatHingga']}}
                        <br>
                        ({{$pelantikan->period['duration']}} Hari)
                        @if($pelantikan->period['sudahBerlalu'])
                            Sudah belalu
                        @endif
                        <br>
                        Dasar Keputusan: {{($pelantikan->dasar_keputusan != null) ? $pelantikan->dasar_keputusan : '-'}}
                        <br>
                        Keterangan : {{($pelantikan->keterangan != null) ? $pelantikan->keterangan : '-'}}
                    </dd>
                </dl>
            </div>
            <div class="col-md-6">
                <div class="well">
                    <dl class="dl-horizontal">
                        @if(count($file) > 0)
                            @if($file['extension'] == 'png' OR $file['extension'] == 'jpg' OR $file['extension'] == 'jpeg')
                                <img src="{{url('attachment/preview/' . $pelantikan->dokumen_sk)}}?dl=0" class="preview">
                                <hr>
                            @elseif($file['extension'] == 'pdf')
                                <embed src="{{url('attachment/preview/' . $pelantikan->dokumen_sk)}}?dl=1" width="470" height="500"></embed>
                            @endif
                            <a href="{{url('attachment/preview/' . $pelantikan->dokumen_sk)}}?dl=1" class="btn btn-success btn-flat btn-block">
                                Unduh <i class="fa fa-download"></i>
                            </a> 
                        @else
                        @endif
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
