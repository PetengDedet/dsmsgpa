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
                                <a href="{{url('personalia/lantik/' . $personalia->hashid)}}" class="btn btn-default btn-block btn-sm" style="min-width: 160px;">
                                    <i class="fa fa-credit-card-alt"></i>&nbsp; Lantik
                                </a>
                                <a href="#" class="btn btn-default btn-block btn-sm" style="min-width: 160px;">
                                    <i class="fa fa-trash-o"></i>&nbsp; Hapus
                                </a>
                                <a href="{{url('personalia/cetak/' . $personalia->hashid)}}" class="btn btn-default btn-block btn-sm" target="_blank" style="min-width: 160px;">
                                    <i class="fa fa-print"></i>&nbsp; Cetak
                                </a>
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
                                        <address class="alamat">
                                            {{$v->jalan}}
                                            <button type="button" class="btn btn-danger btn-sm pull-right hapus-alamat" data-hashid="{{$v->hashid}}"><i class="fa fa-trash-o"></i></button>
                                        </address>
                                    </li>
                                @empty
                                    <li class="list-group-item">-</li>
                                @endforelse

                                <li class="list-group-item" style="padding-bottom: 30px;">
                                    <button type="button" class="btn btn-xs btn-default" style="float: right;" id="tambah-alamat">Tambah Alamat <i class="fa fa-plus"></i></button>
                                </li>
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
                                            <i class="fa fa-phone"></i>&nbsp; Telepon <span class="pull-right">{{$v->identifier}}
                                        @elseif($v->jenis_kontak == 'email')
                                            <i class="fa fa-at"></i>&nbsp; Email <span class="pull-right"><a href="mailto:{{$v->identifier}}">{{$v->identifier}}</a>
                                        @elseif($v->jenis_kontak == 'facebook')
                                            <i class="fa fa-facebook"></i>&nbsp; Facebook <span class="pull-right">{{$v->identifier}}
                                        @elseif($v->jenis_kontak == 'website')
                                            <i class="fa fa-globe"></i>&nbsp; Website <span class="pull-right"><a href="http://{{str_replace('http://', '',str_replace('https://', '', $v->identifier))}}" target="_blank">{{$v->identifier}}</a>
                                        @else
                                            - <i class="fa fa-ellipsis-h"></i>&nbsp; Lainnya <span class="pull-right">{{$v->identifier}}
                                        @endif
                                        
                                        &nbsp; <button type="button" class="btn btn-danger btn-sm hapus-kontak" data-hashid="{{$v->hashid}}"><i class="fa fa-trash-o"></i></button>
                                        </span>
                                    </li>
                                @empty
                                    <li class="list-group-item">-</li>
                                @endforelse

                                <li class="list-group-item" style="padding-bottom: 30px;">
                                    <button type="button" class="btn btn-xs btn-default" style="float: right;" id="tambah-kontak">Tambah Kontak <i class="fa fa-plus"></i></button>
                                </li>
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
                                                <strong>{{$v->nama_lembaga}}</strong>
                                            <span class="pull-right">
                                                <span class="label @if($v->jenis_pendidikan == 'formal') label-success @else label-default @endif">
                                                    {{strtoupper($v->jenis_pendidikan)}}
                                                </span>
                                                &nbsp; <button type="button" class="btn btn-danger btn-xs hapus-pendidikan" data-hashid="{{$v->hashid}}"><i class="fa fa-trash-o"></i></button>
                                            </span>
                                            <br>

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

                                <li class="list-group-item" style="padding-bottom: 30px;">
                                    <button type="button" class="btn btn-xs btn-default" style="float: right;" id="tambah-pendidikan">Tambah Pendidikan <i class="fa fa-plus"></i></button>
                                </li>
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
                                            <strong>{{$v->nama_organisasi}}</strong>
                                            <span class="pull-right">
                                                <span class="label @if($v->jenis_organisasi == 'profit') label-success @elseif($v->jenis_organisasi == 'non_profit') label-info @else label-default @endif">
                                                    {{strtoupper(str_replace('_', ' ', $v->jenis_organisasi))}}
                                                </span>
                                                &nbsp; <button type="button" class="btn btn-danger btn-xs hapus-organisasi" data-hashid="{{$v->hashid}}"><i class="fa fa-trash-o"></i></button>
                                            </span>

                                            {{($v->sejak != null) ? substr($v->sejak, 0, 4) : '-'}}

                                            <small> s/d </small>

                                            {{($v->hingga != null) ? substr($v->hingga, 0, 4) : '-'}}

                                            @if($v->jabatan != null)
                                            <br>
                                                Peran: <strong>{{strtoupper($v->jabatan)}}</strong>
                                            @endif
                                            
                                        </address>
                                    </li>
                                @empty
                                    <li class="list-group-item">-</li>
                                @endforelse

                                <li class="list-group-item" style="padding-bottom: 30px;">
                                    <button type="button" class="btn btn-xs btn-default" style="float: right;" id="tambah-organisasi">Tambah Riwayat Organisasi <i class="fa fa-plus"></i></button>
                                </li>
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
                                @forelse($personalia->pelantikan as $k => $v)
                                    <li class="list-group-item">
                                        {{$v->hashid}}
                                        <br>
                                        {{$v}}
                                    </li>
                                @empty
                                    <li class="list-group-item">
                                        - Belum ada riwayat pengabdian
                                    </li>
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
    let hashid = '{{$personalia->hashid}}';
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

    $('.hapus-alamat').on('click', function(){
        if (confirm('Hapus alamat ini?')) {
            hapusAlamat($(this));
        }
        return false;
    });

    function hapusAlamat(obj) {
        $.ajax({
            url: '{{url('personalia/hapusalamat')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + obj.attr('data-hashid') + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus alamat', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>');
                    notie.alert('error', 'Gagal menghapus alamat', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>');
                notie.alert('error', 'Gagal menghapus alamat', 1);
            }
        });
    }

    $(document).on('click', '#tambah-alamat', function() {
        let t = $(this);
        if (t.parent().find('form').length > 0) {
            t.prop('disabled', true);
            return false;
        }
        t.prop('disabled', true);
        let p ="";
            p += "<form class=\"form-horizontal\" method=\"post\" action=\"\">";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"alamat\" class=\"control-label col-md-3\">Alamat<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <textarea name=\"alamat\" class=\"form-control\" id=\"alamat\"><\/textarea>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <div class=\"col-md-3\">";
            p += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
            p += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"{{$personalia->hashid}}\">";
            p += "        <\/div>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
            p += "                <button type=\"button\" class=\"btn btn-default hapus_alamat\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
            p += "                <button type=\"button\" class=\"btn btn-success simpan_alamat\" onclick=\"sendAlamat($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "<\/form>";

        t.parent().append(p);
    });

    function sendAlamat(obj) {
        let form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        let alamat = form.find('textarea[name="alamat"]');
        if (alamat.val().length < 1) {
            notie.alert('error', 'Alamat tidak boleh kosong', 2);
            alamat.focus().addClass('animated shake');
            return false;
        }

        let data = form.serialize();
        $.ajax({
            url: '{{url('personalia/kirimalamat')}}',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            beforeSend: function(){
                $('.simpan_alamat').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                form.find('textarea[name="alamat"]').prop('readonly', true);
            },
            success: function(resp) {
                if (resp.status) {
                    form.find('.hapus_alamat').prop('disabled', false).attr('onclick', 'hapusAlamatTambahan(\''+ resp.data.hashid +'\',$(this))');
                    form.find('.simpan_alamat').prop('disabled', false).remove();
                    let p ="";
                        p += "<form class=\"form-horizontal\" method=\"post\" action=\"\">";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"alamat\" class=\"control-label col-md-3\">Alamat<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <textarea name=\"alamat\" class=\"form-control\" id=\"alamat\"><\/textarea>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <div class=\"col-md-3\">";
                        p += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
                        p += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"" + resp.hashid + "\">";
                        p += "        <\/div>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
                        p += "                <button type=\"button\" class=\"btn btn-default hapus_alamat\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
                        p += "                <button type=\"button\" class=\"btn btn-success simpan_alamat\" onclick=\"sendAlamat($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
                        p += "            <\/div>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "<\/form>";

                        
                        form.parent().append(p);
                }else{
                    $('.simpan_alamat').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    form.find('input[textarea="alamat"]').prop('readonly', false);
                    notie.alert('error', resp, 3);  
                }
            },
            error: function(resp) {
                $('.simpan_alamat').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                form.find('input[name="alamat"]').prop('readonly', false);
                notie.alert('error', resp, 3);    
            }
        });
    }

    function hapusAlamatTambahan(hashid, obj) {
        $.ajax({
            url: '{{url('personalia/hapusalamat')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + hashid + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus alamat', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                    notie.alert('error', 'Gagal menghapus alamat', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                notie.alert('error', 'Gagal menghapus alamat', 1);
            }
        });
    }

    $(document).on('click', '#tambah-kontak', function() {
        let t = $(this);
        if (t.parent().find('form').length > 0) {
            t.prop('disabled', true);
            return false;
        }
        t.prop('disabled', true);
        let p ="";
            p += "<form class=\"form-horizontal\" id=\"formKontak\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"jenis_kontak\" class=\"control-label col-md-3\">Jenis Kontak<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
            p += "                <label class=\"btn btn-default btn-sm active\">";
            p += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"telepon\" autocomplete=\"off\" checked><i class=\"fa fa-phone\"><\/i><br>Telepon";
            p += "                <\/label>";
            p += "                <label class=\"btn btn-default btn-sm\">";
            p += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"email\" autocomplete=\"off\"><i class=\"fa fa-at\"><\/i><br>Email";
            p += "                <\/label>";
            p += "                <label class=\"btn btn-default btn-sm\">";
            p += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"facebook\" autocomplete=\"off\"><i class=\"fa fa-facebook\"><\/i><br>facebook";
            p += "                <\/label>";
            p += "                <label class=\"btn btn-default btn-sm\">";
            p += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"website\" autocomplete=\"off\"><i class=\"fa fa-globe\"><\/i><br>Website";
            p += "                <\/label>";
            p += "                <label class=\"btn btn-default btn-sm\">";
            p += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"lainnya\" autocomplete=\"off\"><i class=\"fa fa-ellipsis-h\"><\/i><br>Lainnya";
            p += "                <\/label>";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"kontak_value\" class=\"control-label col-md-3\">Value<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <input type=\"text\" name=\"kontak_value\" id=\"kontak_value\" class=\"form-control\" placeholder=\"081xxxxxxxxx\">";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <div class=\"col-md-3\">";
            p += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
            p += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"{{$personalia->hashid}}\">";
            p += "        <\/div>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
            p += "                <button type=\"button\" class=\"btn btn-default hapus_kontak\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
            p += "                <button type=\"button\" class=\"btn btn-success simpan_kontak\" onclick=\"sendKontak($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "<\/form>";
            
            t.parent().append(p);
    });

    function sendKontak(obj) {
        let form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        let kontak_value = form.find('input[name="kontak_value"]');
        if (kontak_value.val().length < 1) {
            notie.alert('error', 'Value Kontak tidak boleh kosong', 2);
            kontak_value.focus().addClass('animated shake');
            return false;
        }

        let data = form.serialize();
        $.ajax({
            url: '{{url('personalia/kirimkontak')}}',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            beforeSend: function(){
                $('.simpan_kontak').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                form.find('input[name="kontak_value"]').prop('readonly', true);
            },
            success: function(resp) {
                if (resp.status) {
                    form.find('.hapus_kontak').prop('disabled', false).attr('onclick', 'hapusKontak(\''+ resp.data.hashid +'\',$(this))');
                    form.find('.simpan_kontak').prop('disabled', false).remove();


                    let pender="";
                        pender += "<form class=\"form-horizontal\" id=\"formKontak\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <label for=\"jenis_kontak\" class=\"control-label col-md-3\">Jenis Kontak<\/label>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
                        pender += "                <label class=\"btn btn-default btn-sm active\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"telepon\" autocomplete=\"off\" checked><i class=\"fa fa-phone\"><\/i><br>Telepon";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default btn-sm\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"email\" autocomplete=\"off\"><i class=\"fa fa-at\"><\/i><br>Email";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default btn-sm\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"facebook\" autocomplete=\"off\"><i class=\"fa fa-facebook\"><\/i><br>facebook";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default btn-sm\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"website\" autocomplete=\"off\"><i class=\"fa fa-globe\"><\/i><br>Website";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default btn-sm\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"lainnya\" autocomplete=\"off\"><i class=\"fa fa-ellipsis-h\"><\/i><br>Lainnya";
                        pender += "                <\/label>";
                        pender += "            <\/div>";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <label for=\"kontak_value\" class=\"control-label col-md-3\">Value<\/label>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <input type=\"text\" name=\"kontak_value\" id=\"kontak_value\" class=\"form-control\" placeholder=\"081xxxxxxxxx\">";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <div class=\"col-md-3\">";
                        pender += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
                        pender += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\""+ resp.hashid +"\">";
                        pender += "        <\/div>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
                        pender += "                <button type=\"button\" class=\"btn btn-default hapus_kontak\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
                        pender += "                <button type=\"button\" class=\"btn btn-success simpan_kontak\" onclick=\"sendKontak($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
                        pender += "            <\/div>";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "<\/form>";
                        
                        form.parent().append(pender);
                }else{
                    $('.simpan_kontak').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    form.find('input[name="kontak_value"]').prop('readonly', false);
                    notie.alert('error', resp, 3);  
                }
            },
            error: function(resp) {
                $('.simpan_kontak').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                form.find('input[name="kontak_value"]').prop('readonly', false);
                notie.alert('error', resp, 3);    
            }
        });
    }

    function hapusKontak(hashid, obj) {
        $.ajax({
            url: '{{url('personalia/hapuskontak')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + hashid + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus kontak', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                    notie.alert('error', 'Gagal menghapus kontak', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                notie.alert('error', 'Gagal menghapus kontak', 1);
            }
        });
    }

    $('.hapus-kontak').on('click', function() {
        if (! confirm('Hapus kontak ini?')) {
            return false;
        }

        let obj = $(this);
        $.ajax({
            url: '{{url('personalia/hapuskontak')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + obj.attr('data-hashid') + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus kontak', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>');
                    notie.alert('error', 'Gagal menghapus kontak', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>');
                notie.alert('error', 'Gagal menghapus kontak', 1);
            }
        });
    });

    $(document).on('click', '#tambah-pendidikan', function() {
        let t = $(this);
        if (t.parent().find('form').length > 0) {
            t.prop('disabled', true);
            return false;
        }
        t.prop('disabled', true);

        let p ="";
            p += "<form class=\"form-horizontal\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"jenis_pendidikan\" class=\"control-label col-md-3\">Jenis Pendidikan<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
            p += "                <label class=\"btn btn-default btn-sm active\">";
            p += "                    <input type=\"radio\" name=\"jenis_pendidikan\" class=\"jenis_pendidikan\" value=\"formal\" autocomplete=\"off\" checked><i class=\"fa fa-thumbs-up\"><\/i> Formal";
            p += "                <\/label>";
            p += "                <label class=\"btn btn-default btn-sm\">";
            p += "                    <input type=\"radio\" name=\"jenis_pendidikan\" class=\"jenis_pendidikan\" value=\"non_formal\" autocomplete=\"off\"><i class=\"fa fa-thumbs-o-up\"><\/i> Non Formal";
            p += "                <\/label>";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"nama_lembaga_pendidikan\" class=\"control-label col-md-3\">Nama Lembaga Pendidikan<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <input type=\"text\" name=\"nama_lembaga_pendidikan\" class=\"form-control\" required id=\"nama_lembaga_pendidikan\">";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"masa_pendidikan\" class=\"control-label col-md-3\">Masa Pendidikan<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"input-daterange input-group\" id=\"masa_pendidikan\">";
            p += "                <input type=\"text\" class=\"form-control\" name=\"masa_pendidikan_sejak\">";
            p += "                <span class=\"input-group-addon\">s\/d<\/span>";
            p += "                <input type=\"text\" class=\"form-control\" name=\"masa_pendidikan_hingga\">";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"gelar_akademis\" class=\"control-label col-md-3\">Gelar Akademis <small>(Optional)<\/small><\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <input type=\"text\" name=\"gelar_akademis\" class=\"form-control\" required id=\"gelar_akademis\">";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "   ";
            p += "    <div class=\"form-group\">";
            p += "        <div class=\"col-md-3\">";
            p += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
            p += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"{{$personalia->hashid}}\">";
            p += "        <\/div>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
            p += "                <button type=\"button\" class=\"btn btn-default hapus_pendidikan\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
            p += "                <button type=\"button\" class=\"btn btn-success simpan_pendidikan\" onclick=\"sendRiwayatPendidikan($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "<\/form>";

        t.parent().append(p);

        $('.input-daterange').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });
    });
    
    function sendRiwayatPendidikan(obj) {
        let form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        let nama_lembaga_pendidikan = form.find('input[name="nama_lembaga_pendidikan"]');
        if (nama_lembaga_pendidikan.val().length < 1) {
            notie.alert('error', 'Nama Lembaga Pendidikan tidak boleh kosong', 2);
            nama_lembaga_pendidikan.focus().addClass('animated shake');
            return false;
        }

        let data = form.serialize();
        $.ajax({
            url: '{{url('personalia/kirimriwayatpendidikan')}}',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            beforeSend: function(){
                $('.simpan_pendidikan').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                form.find('input[name="nama_lembaga_pendidikan"]').prop('readonly', true);
                form.find('input[name="masa_pendidikan_sejak"]').prop('readonly', true);
                form.find('input[name="masa_pendidikan_hingga"]').prop('readonly', true);
                form.find('input[name="gelar_akademis"]').prop('readonly', true);
                form.find('input[name="dokumen_pendukung"]').prop('readonly', true);
            },
            success: function(resp) {
                if (resp.status) {
                    form.find('.hapus_pendidikan').prop('disabled', false).attr('onclick', 'hapusPendidikan(\''+ resp.data.hashid +'\',$(this))');
                    form.find('.simpan_pendidikan').prop('disabled', false).remove();

                    //
                    let p ="";
                        p += "<form class=\"form-horizontal\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"jenis_pendidikan\" class=\"control-label col-md-3\">Jenis Pendidikan<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
                        p += "                <label class=\"btn btn-default btn-sm active\">";
                        p += "                    <input type=\"radio\" name=\"jenis_pendidikan\" class=\"jenis_pendidikan\" value=\"formal\" autocomplete=\"off\" checked><i class=\"fa fa-thumbs-up\"><\/i> Formal";
                        p += "                <\/label>";
                        p += "                <label class=\"btn btn-default btn-sm\">";
                        p += "                    <input type=\"radio\" name=\"jenis_pendidikan\" class=\"jenis_pendidikan\" value=\"non_formal\" autocomplete=\"off\"><i class=\"fa fa-thumbs-o-up\"><\/i> Non Formal";
                        p += "                <\/label>";
                        p += "            <\/div>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"nama_lembaga_pendidikan\" class=\"control-label col-md-3\">Nama Lembaga Pendidikan<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <input type=\"text\" name=\"nama_lembaga_pendidikan\" class=\"form-control\" required id=\"nama_lembaga_pendidikan\">";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"masa_pendidikan\" class=\"control-label col-md-3\">Masa Pendidikan<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <div class=\"input-daterange input-group\" id=\"masa_pendidikan\">";
                        p += "                <input type=\"text\" class=\"form-control\" name=\"masa_pendidikan_sejak\">";
                        p += "                <span class=\"input-group-addon\">s\/d<\/span>";
                        p += "                <input type=\"text\" class=\"form-control\" name=\"masa_pendidikan_hingga\">";
                        p += "            <\/div>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"gelar_akademis\" class=\"control-label col-md-3\">Gelar Akademis <small>(Optional)<\/small><\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <input type=\"text\" name=\"gelar_akademis\" class=\"form-control\" required id=\"gelar_akademis\">";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "   ";
                        p += "    <div class=\"form-group\">";
                        p += "        <div class=\"col-md-3\">";
                        p += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
                        p += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\""+ resp.hashid +"\">";
                        p += "        <\/div>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
                        p += "                <button type=\"button\" class=\"btn btn-default hapus_pendidikan\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
                        p += "                <button type=\"button\" class=\"btn btn-success simpan_pendidikan\" onclick=\"sendRiwayatPendidikan($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
                        p += "            <\/div>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "<\/form>";
                    form.parent().append(p);

                    $('#tgl_lahir, .input-daterange').datepicker({
                        format : 'dd MM yyyy',
                        clearBtn: true,
                        language: 'id',
                        autoclose: true,
                        todayHighlight: true
                    });

                }else{
                    $('.simpan_pendidikan').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    form.find('input[name="nama_lembaga_pendidikan"]').prop('readonly', false);
                    form.find('input[name="masa_pendidikan_sejak"]').prop('readonly', false);
                    form.find('input[name="masa_pendidikan_hingga"]').prop('readonly',false);
                    form.find('input[name="gelar_akademis"]').prop('readonly', false);
                    form.find('input[name="dokumen_pendukung"]').prop('readonly', false);
                    notie.alert('error', resp, 3);  
                }
            },
            error: function(resp) {
                $('.simpan_pendidikan').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                form.find('input[name="nama_lembaga_pendidikan"]').prop('readonly', false);
                form.find('input[name="masa_pendidikan_sejak"]').prop('readonly', false);
                form.find('input[name="masa_pendidikan_hingga"]').prop('readonly',false);
                form.find('input[name="gelar_akademis"]').prop('readonly', false);
                form.find('input[name="dokumen_pendukung"]').prop('readonly', false);
                notie.alert('error', resp, 3);    
            }
        });
    }

    function hapusPendidikan(hashid, obj) {
        $.ajax({
            url: '{{url('personalia/hapusriwayatpendidikan')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + hashid + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus riwayat pendidikan', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                    notie.alert('error', 'Gagal menghapus riwayat pendidikan', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                notie.alert('error', 'Gagal menghapus riwayat pendidikan', 1);
            }
        });
    }

    $('.hapus-pendidikan').on('click', function() {
        if (! confirm('Hapus pendidikan ini?')) {
            return false;
        }

        let obj = $(this);
        $.ajax({
            url: '{{url('personalia/hapusriwayatpendidikan')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + obj.attr('data-hashid') + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus riwayat pendidikan', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>');
                    notie.alert('error', 'Gagal menghapus riwayat pendidikan', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>');
                notie.alert('error', 'Gagal menghapus riwayat pendidikan', 1);
            }
        });
    });
    
    $(document).on('click', '#tambah-organisasi', function() {
        let t = $(this);
        if (t.parent().find('form').length > 0) {
            t.prop('disabled', true);
            return false;
        }
        t.prop('disabled', true);

        let p ="";
            p += "<form class=\"form-horizontal\" id=\"formOrganisasi\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"jenis_organisasi\" class=\"control-label col-md-3\">Jenis Organisasi<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
            p += "                <label class=\"btn btn-default btn-sm active\">";
            p += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"profit\" autocomplete=\"off\" checked><i class=\"fa fa-bell\"><\/i><br>Profit";
            p += "                <\/label>";
            p += "                <label class=\"btn btn-default btn-sm\">";
            p += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"non_profit\" autocomplete=\"off\"><i class=\"fa fa-bell-o\"><\/i><br>Non Profit";
            p += "                <\/label>";
            p += "                <label class=\"btn btn-default btn-sm\">";
            p += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"pemerintahan\" autocomplete=\"off\"><i class=\"fa fa-bell-slash\"><\/i><br>Pemerintahan";
            p += "                <\/label>";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"nama_organisasi\" class=\"control-label col-md-3\">Nama Organisasi<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <input type=\"text\" name=\"nama_organisasi\" id=\"nama_organisasi\" class=\"form-control\">";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"peran\" class=\"control-label col-md-3\">Peran<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <input type=\"text\" name=\"peran\" id=\"peran\" class=\"form-control\">";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <label for=\"masa_peran\" class=\"control-label col-md-3\">Masa Berperan<\/label>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"input-daterange input-group\" id=\"masa_peran\">";
            p += "                <input type=\"text\" class=\"form-control\" name=\"masa_peran_sejak\">";
            p += "                <span class=\"input-group-addon\">s\/d<\/span>";
            p += "                <input type=\"text\" class=\"form-control\" name=\"masa_peran_hingga\">";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "    <div class=\"form-group\">";
            p += "        <div class=\"col-md-3\">";
            p += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
            p += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"{{$personalia->hashid}}\">";
            p += "        <\/div>";
            p += "        <div class=\"col-md-6\">";
            p += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
            p += "                <button type=\"button\" class=\"btn btn-default hapus_organisasi\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
            p += "                <button type=\"button\" class=\"btn btn-success simpan_organisasi\" onclick=\"sendOrganisasi($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
            p += "            <\/div>";
            p += "        <\/div>";
            p += "    <\/div>";
            p += "<\/form>";

            t.parent().append(p);

        $('.input-daterange').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });
    });

    function sendOrganisasi(obj) {
        let form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        let nama_organisasi = form.find('input[name="nama_organisasi"]');
        let peran = form.find('input[name="peran"]');

        if (nama_organisasi.val().length < 1) {
            notie.alert('error', 'Nama Organisasi tidak boleh kosong', 2);
            nama_organisasi.focus().addClass('animated shake');
            return false;
        }

        if (peran.val().length < 1) {
            notie.alert('error', 'Peran tidak boleh kosong', 2);
            peran.focus().addClass('animated shake');
            return false;
        }

        let data = form.serialize();
        $.ajax({
            url: '{{url('personalia/kirimorganisasi')}}',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            beforeSend: function(){
                $('.simpan_organisasi').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                form.find('input[name="nama_organisasi"]').prop('readonly', true);
                form.find('input[name="peran"]').prop('readonly', true);
                form.find('input[name="masa_peran_sejak"]').prop('readonly', true);
                form.find('input[name="masa_peran_hingga"]').prop('readonly', true);
            },
            success: function(resp) {
                if (resp.status) {
                    form.find('.hapus_organisasi').prop('disabled', false).attr('onclick', 'hapusOrganisasi(\''+ resp.data.hashid +'\',$(this))');
                    form.find('.simpan_organisasi').prop('disabled', false).remove();

                    let p ="";
                        p += "<form class=\"form-horizontal\" id=\"formOrganisasi\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"jenis_organisasi\" class=\"control-label col-md-3\">Jenis Organisasi<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
                        p += "                <label class=\"btn btn-default btn-sm active\">";
                        p += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"profit\" autocomplete=\"off\" checked><i class=\"fa fa-bell\"><\/i><br>Profit";
                        p += "                <\/label>";
                        p += "                <label class=\"btn btn-default btn-sm\">";
                        p += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"non_profit\" autocomplete=\"off\"><i class=\"fa fa-bell-o\"><\/i><br>Non Profit";
                        p += "                <\/label>";
                        p += "                <label class=\"btn btn-default btn-sm\">";
                        p += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"pemerintahan\" autocomplete=\"off\"><i class=\"fa fa-bell-slash\"><\/i><br>Pemerintahan";
                        p += "                <\/label>";
                        p += "            <\/div>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"nama_organisasi\" class=\"control-label col-md-3\">Nama Organisasi<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <input type=\"text\" name=\"nama_organisasi\" id=\"nama_organisasi\" class=\"form-control\">";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"peran\" class=\"control-label col-md-3\">Peran<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <input type=\"text\" name=\"peran\" id=\"peran\" class=\"form-control\">";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <label for=\"masa_peran\" class=\"control-label col-md-3\">Masa Berperan<\/label>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <div class=\"input-daterange input-group\" id=\"masa_peran\">";
                        p += "                <input type=\"text\" class=\"form-control\" name=\"masa_peran_sejak\">";
                        p += "                <span class=\"input-group-addon\">s\/d<\/span>";
                        p += "                <input type=\"text\" class=\"form-control\" name=\"masa_peran_hingga\">";
                        p += "            <\/div>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "    <div class=\"form-group\">";
                        p += "        <div class=\"col-md-3\">";
                        p += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
                        p += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"{{$personalia->hashid}}\">";
                        p += "        <\/div>";
                        p += "        <div class=\"col-md-6\">";
                        p += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
                        p += "                <button type=\"button\" class=\"btn btn-default hapus_organisasi\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
                        p += "                <button type=\"button\" class=\"btn btn-success simpan_organisasi\" onclick=\"sendOrganisasi($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
                        p += "            <\/div>";
                        p += "        <\/div>";
                        p += "    <\/div>";
                        p += "<\/form>";

                        form.parent().append(p);

                    $('.input-daterange').datepicker({
                        format : 'dd MM yyyy',
                        clearBtn: true,
                        language: 'id',
                        autoclose: true,
                        todayHighlight: true
                    });

                }else{
                    $('.simpan_organisasi').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                    form.find('input[name="nama_organisasi"]').prop('readonly', false);
                    form.find('input[name="peran"]').prop('readonly', false);
                    form.find('input[name="masa_peran_sejak"]').prop('readonly', false);
                    form.find('input[name="masa_peran_hingga"]').prop('readonly', false);
                    notie.alert('error', resp, 3);
                }
            },
            error: function(resp) {
                $('.simpan_organisasi').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                form.find('input[name="nama_organisasi"]').prop('readonly', false);
                form.find('input[name="peran"]').prop('readonly', false);
                form.find('input[name="masa_peran_sejak"]').prop('readonly', false);
                form.find('input[name="masa_peran_hingga"]').prop('readonly', false);
                notie.alert('error', resp, 3);
            }
        });
    }

    function hapusOrganisasi(hashid, obj) {
        $.ajax({
            url: '{{url('personalia/hapusorganisasi')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + hashid + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i> Loading...');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus organisasi', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                    notie.alert('error', 'Gagal menghapus organisasi', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>&nbsp;Hapus');
                notie.alert('error', 'Gagal menghapus organisasi', 1);
            }
        });
    }

    $('.hapus-organisasi').on('click', function() {
        if (! confirm('Hapus riwayat ini?')) {
            return false;
        }

        let obj = $(this);
        $.ajax({
            url: '{{url('personalia/hapusorganisasi')}}',
            type: 'POST',
            dataType: 'JSON',
            data: 'hashid=' + obj.attr('data-hashid') + '&_token={{csrf_token()}}',
            beforeSend: function() {
                obj.html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(response) {
                if (response.status) {
                    obj.parent().parent().parent().remove();
                    notie.alert('success', 'Berhasil menghapus organisasi', 1);
                }else{
                    obj.html('<i class="fa fa-trash-o"></i>');
                    notie.alert('error', 'Gagal menghapus organisasi', 1);
                }
            },
            error: function(response) {
                obj.html('<i class="fa fa-trash-o"></i>');
                notie.alert('error', 'Gagal menghapus organisasi', 1);
            }
        });
    });
</script>
@endsection
