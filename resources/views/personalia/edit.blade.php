@extends('adminlte::page')

@section('title', 'Profil Personalia')

@section('css')
<style type="text/css">
    .detail {
        padding: 0px;
    }

    .panel-group {
        margin-bottom: 2px;
    }
</style>
@endsection

@section('content_header')
<h1><i class="fa fa-users"></i>&nbsp; Profil Personalia</h1>
@endsection

@section('content')
<div class="box">
    <div class="box-heading">
        <ol class="breadcrumb">
            <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
            <li><a href="{{url('personalia')}}">Personalia</a></li>
            <li class="active">Profil Personalia</li>
        </ol>
    </div>
    <div class="box-body">
        <div class="col-md-4">
            <div class="box-body box-profile person">
                <h3 class="profile-username text-center">{{$personalia->nama}}</h3>
                <p class="text-muted text-center">{{$personalia->alias}}</p>
                <ul class="list-group">
                    <li class="list-group-item person">
                        Jenis Kelamin<span class="pull-right">{!! ($personalia->jk == 'L') ? '<span class="label label-default"><i class="fa fa-male"></i>&nbsp; Laki-laki</span>' : '<span class="label label-danger"><i class="fa fa-female"></i>&nbsp; Perempuan</span>'!!}</span>
                    </li>
                    <li class="list-group-item person">
                        Tempat, Tanggal Lahir <span class="pull-right">{{$personalia->tempat_lahir}}, {{\App\Library\Datify::readify(substr($personalia->tanggal_lahir, 0, 10))}}</span>
                    </li>
                    <li class="list-group-item person">
                        Umur <span class="pull-right">{{\Carbon\Carbon::parse($personalia->tanggal_lahir)->age}} Tahun</span>
                    </li>
                    <li class="list-group-item person">
                        Pendidikan Terakhir <span class="pull-right">{{strtoupper($personalia->pendidikan_terakhir)}}</span>
                    </li>
                    <li class="list-group-item person">
                        TMT <span class="pull-right">{{$personalia->tmt}}</span>
                    </li>
                    <li class="list-group-item person">
                        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($personalia->nomor)) !!}" class="img-rounded img-thumbnail">

                        <div class="btn-group pull-right" style="width: 160px;">
                            <a href="{{url('personalia/lantik/' . $personalia->hashid)}}" class="btn btn-default btn-block btn-sm" style="min-width: 160px;"><i class="fa fa-credit-card-alt"></i>&nbsp; Lantik</a>
                            <a href="#" class="btn btn-default btn-block btn-sm" style="min-width: 160px;"><i class="fa fa-trash-o"></i>&nbsp; Hapus</a>
                            <a href="{{url('personalia/cetak/' . $personalia->hashid)}}" class="btn btn-default btn-block btn-sm" target="_blank" style="min-width: 160px;"><i class="fa fa-print"></i>&nbsp; Cetak</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-8">
            <h2><kbd class="text-center">{{$personalia->nomor}}</kbd></h2>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="alamatHeading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#alamat" aria-expanded="true" aria-controls="alamat">
                                <i class="fa fa-globe"></i>&nbsp;Alamat
                            </a>
                        </h4>
                    </div>
                    <div id="alamat" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="alamatHeading">
                        <ul class="list-group">
                            @forelse($personalia->alamat as $k => $v)
                            <li class="list-group-item">
                                <address>{{$v->jalan}}</address>
                            </li>
                            @empty
                            <li class="list-group-item">-</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="kontakHeading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#kontak" aria-expanded="true" aria-controls="kontak">
                                <i class="fa fa-phone"></i>&nbsp;Kontak
                            </a>
                        </h4>
                    </div>
                    <div id="kontak" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="kontakHeading">
                        <ul class="list-group">

                            @forelse($personalia->kontak as $k => $v)

                                <li class="list-group-item">

                                    @if($v->jenis_kontak == 'telepon')
                                        <i class="fa fa-phone"></i>&nbsp; Telepon <span class="pull-right">{{$v->identifier}}</span>

                                    @elseif($v->jenis_kontak == 'email')
                                        <i class="fa fa-at"></i>&nbsp; Email <span class="pull-right"><a href="mailto:{{$v->identifier}}">{{$v->identifier}}</a></span>

                                    @elseif($v->jenis_kontak == 'facebook')
                                        <i class="fa fa-facebook"></i>&nbsp; Facebook <span class="pull-right">{{$v->identifier}}</span>

                                    @elseif($v->jenis_kontak == 'website')
                                        <i class="fa fa-globe"></i>&nbsp; Website <span class="pull-right"><a href="http://{{str_replace('http://', '',str_replace('https://', '', $v->identifier))}}" target="_blank">{{$v->identifier}}</a></span>

                                    @else
                                        - <i class="fa fa-ellipsis-h"></i>&nbsp; Lainnya <span class="pull-right">{{$v->identifier}}</span>
                                    @endif
        
                                </li>
    
                            @empty
                                <li class="list-group-item">-</li>

                            @endforelse

                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="riwayat_pendidikan_heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#riwayat_pendidikan" aria-expanded="true" aria-controls="riwayat_pendidikan">
                                <i class="fa fa-graduation-cap"></i>&nbsp;Riwayat Pendidikan
                            </a>
                        </h4>
                    </div>
                    <div id="riwayat_pendidikan" class="panel-collapse collapse" role="tabpanel" aria-labelledby="riwayat_pendidikan_heading">
                        <ul class="list-group">
                            
                            @forelse($personalia->riwayat_pendidikan as $k => $v)
                            
                                <li class="list-group-item">
                                    <address>
                                        <strong>{{$v->nama_lembaga}}</strong><span class="label @if($v->jenis_pendidikan == 'formal') label-success @else label-default @endif pull-right">{{strtoupper($v->jenis_pendidikan)}}</span><br>

                                        {{($v->sejak != null) ? substr($v->sejak, 0, 4) : '-'}}

                                        <small> s/d </small>

                                        {{($v->hingga != null) ? substr($v->hingga, 0, 4) : '-'}}

                                        @if($v->gelar != null)
                                            <br>
                                            Gelar Akademis: <strong>{{$v->gelar}}</strong>
                                        @endif
                                        
                                    </address>
                                </li>
                            @empty
                                <li class="list-group-item">-</li>
                            @endforelse
                            
                        </ul>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="riwayat_organisasi_heading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#riwayat_organisasi" aria-expanded="true" aria-controls="riwayat_organisasi">
                                <i class="fa fa-flag"></i>&nbsp;Riwayat Organisasi
                            </a>
                        </h4>
                    </div>
                    <div id="riwayat_organisasi" class="panel-collapse collapse" role="tabpanel" aria-labelledby="riwayat_organisasi_heading">
                        <ul class="list-group">
                            @forelse($personalia->riwayat_organisasi as $k => $v)
                            <li class="list-group-item">
                                <address>
                                    <strong>{{$v->nama_organisasi}}</strong><span class="label @if($v->jenis_organisasi == 'profit') label-success @elseif($v->jenis_organisasi == 'non_profit') label-info @else label-default @endif pull-right">{{strtoupper(str_replace('_', ' ', $v->jenis_organisasi))}}</span>

                                    {{($v->sejak != null) ? substr($v->sejak, 0, 4) : '-'}}

                                    <small> s/d </small>

                                    {{($v->hingga != null) ? substr($v->hingga, 0, 4) : '-'}}

                                    @if($v->jabatan != null)
                                    <br>
                                    Peran: <strong>{{strtoupper($v->gelar)}}</strong>
                                    @endif
                                    
                                </address>
                            </li>
                            @empty
                            <li class="list-group-item">-</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>            
        </div>
        <div class="col-md-12">
            <div class="box-body box-profile">
                <div class="panel-group" id="pengabdianAccordion" role="tablist" aria-multiselectable="true">
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="pengabdianHeading">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#pengabdianAccordion" href="#pengabdian" aria-expanded="true" aria-controls="pengabdian">
                                <i class="fa fa-heartbeat"></i>&nbsp;Pengabdian
                            </a>
                        </h4>
                    </div>
                    <div id="pengabdian" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="pengabdianHeading">
                        <ul class="list-group">
                        @forelse($personalia->riwayat_organisasi as $k => $v)
                            <li class="list-group-item">
                                <address>
                                    <strong>{{$v->nama_organisasi}}</strong><span class="label @if($v->jenis_organisasi == 'profit') label-success @elseif($v->jenis_organisasi == 'non_profit') label-info @else label-default @endif pull-right">{{strtoupper(str_replace('_', ' ', $v->jenis_organisasi))}}</span>

                                    {{($v->sejak != null) ? substr($v->sejak, 0, 4) : '-'}}

                                    <small> s/d </small>

                                    {{($v->hingga != null) ? substr($v->hingga, 0, 4) : '-'}}

                                    @if($v->jabatan != null)
                                    <br>
                                    Peran: <strong>{{strtoupper($v->gelar)}}</strong>
                                    @endif
                                    
                                </address>
                            </li>
                            @empty
                            <li class="list-group-item">-</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection
