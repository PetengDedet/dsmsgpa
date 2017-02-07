@extends('adminlte::page')

@section('title', 'Profil Personalia')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-editable.css')}}">
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
                <h3 class="profile-username text-center" id="nama">{{$personalia->nama}}</h3>
                <p class="text-muted text-center" id="alias">{{$personalia->alias}}</p>
                <ul class="list-group">
                    <li class="list-group-item person">
                        Jenis Kelamin<span class="pull-right">{!! ($personalia->jk == 'L') ? '<span class="label label-default" id="jk">Laki-laki</span>' : '<span class="label label-default" id="jk">Perempuan</span>'!!}</span>
                    </li>
                    <li class="list-group-item person">
                        Tempat Lahir <span class="pull-right" id="tempat_lahir">{{$personalia->tempat_lahir}}</span>
                    </li>
                    <li class="list-group-item person">
                        Tanggal Lahir <span class="pull-right" id="tanggal_lahir">{{\App\Library\Datify::readify(substr($personalia->tanggal_lahir, 0, 10))}}</span>
                    </li>
                    <li class="list-group-item person">
                        Umur <span class="pull-right">{{\Carbon\Carbon::parse($personalia->tanggal_lahir)->age}} Tahun</span>
                    </li>
                    <li class="list-group-item person">
                        Pendidikan Terakhir <span class="pull-right" id="pendidikan_terakhir">{{strtoupper($personalia->pendidikan_terakhir)}}</span>
                    </li>
                    <li class="list-group-item person">
                        TMT <span class="pull-right" id="tmt">{{$personalia->tmt}}</span>
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
            <h2><kbd class="text-center" id="nomor">{{$personalia->nomor}}</kbd></h2>
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
<script type="text/javascript" src="{{asset('js/bootstrap-editable.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/moment.min.js')}}"></script>
<script type="text/javascript">
    var hashid = '{{$personalia->hashid}}';
    $.fn.editable.defaults.params = function (params) {
        params._token = '{{csrf_token()}}';
        return params;
    };

    $('#nama').editable({
        type: 'text',
        pk: hashid,
        url: '{{url('personalia/editnama')}}',
        title: 'Nama Personalia',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Nama tidak boleh kosong';
            }
        },
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'Nama Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->nama}}'
    });

    $('#alias').editable({
        type: 'text',
        pk: hashid,
        url: '{{url('personalia/editalias')}}',
        title: 'Alias Personalia',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Alias tidak boleh kosong';
            }
        },
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'Alias Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->alias}}'
    });

    $('#jk').editable({
        type: 'select',
        pk: hashid,
        url: '{{url('personalia/editjk')}}',
        title: 'Jenis Kelamin',
        value: '{{$personalia->jk}}',
        source: [
            {value: 'L', text: 'Laki-laki'},
            {value: 'P', text: 'Perempuan'}
        ],
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'Jenis Kelamin Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->jk}}'
    });

    $('#tempat_lahir').editable({
        type: 'text',
        pk: hashid,
        url: '{{url('personalia/edittempatlahir')}}',
        title: 'Tempat Lahir',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Tempat Lahir tidak boleh kosong';
            }
        },
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'Tempat Lahir Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->tempat_lahir}}'
    });

    $('#tanggal_lahir').editable({
        type: 'combodate',
        placement: 'left',
        pk: hashid,
        url: '{{url('personalia/edittanggallahir')}}',
        title: 'Tanggal Lahir',
        locale: 'id',
        format: 'YYYY-MM-DD',    
        viewformat: 'DD MMMM YYYY',    
        template: 'DMMMMYYYY',    
        combodate: {
            minYear: 1926,
            maxYear: {{date('Y')}}
        },
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Tanggal Lahir tidak valid';
            }
        },
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'Tanggal Lahir Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->getTglLahirAttribute('-')}}'
    });

    $('#pendidikan_terakhir').editable({
        type: 'select',
        pk: hashid,
        url: '{{url('personalia/editpendidikanterakhir')}}',
        title: 'Pendidikan Terakhir',
        value: '{{$personalia->pendidikan_terakhir}}',
        source: [
            {value: 'sma_sederajat', text: 'SMA Sederajat'},
            {value: 'diploma', text: 'Diploma'},
            {value: 's1', text: 'S1'},
            {value: 's2', text: 'S2'},
            {value: 's3', text: 'S3'},
            {value: 'lainnya', text: 'Lainnya'}
        ],
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'Pendidikan Terakhir Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->pendidikan_terakhir}}'
    });

    $('#tmt').editable({
        type: 'combodate',
        pk: hashid,
        url: '{{url('personalia/edittmt')}}',
        title: 'TMT',
        locale: 'id',
        format: 'YYYY',
        viewformat: 'YYYY',    
        template: 'YYYY',    
        combodate: {
            minYear: 1926,
            maxYear: {{date('Y')}}
        },
        validate: function(value) {
            if($.trim(value) == '') {
                return 'TMT tidak valid';
            }
        },
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'TMT Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->tmt}}'
    });

    $('#nomor').editable({
        type: 'text',
        pk: hashid,
        url: '{{url('personalia/editnomor')}}',
        title: 'Nomor Induk Kepegawaian',
        validate: function(value) {
            if($.trim(value) == '') {
                return 'Nomor tidak boleh kosong';
            }
        },
        success:function(resp) {
            if (resp.status) {
                notie.alert('success', 'Nomor Berhasil diperbaharui', 1);
            }else{
                notie.alert('error', resp.message, 2);
            }
        },
        error: function(resp) {
            notie.alert('error', resp.message[0], 2);
        },
        defaultValue: '{{$personalia->nomor}}'
    });
</script>
@endsection
