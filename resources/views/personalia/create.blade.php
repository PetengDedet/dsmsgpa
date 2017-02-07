@extends('adminlte::page')

@section('title', 'Tambah Personalia')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/fuelux.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker3.css')}}">
<style type="text/css">
    .table-condensed {
        background: #fff;
    }
</style>
@endsection

@section('content_header')
<h1>
    <i class="fa fa-users"></i>&nbsp; Tambah Personalia
</h1>
@endsection

@section('content')

    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb" style="margin-bottom: 0;">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                <li><a href="{{url('personalia')}}">Personalia</a></li>
                <li class="active">Tambah Personalia</li>
            </ol>
        </div>
        <div class="box-body fuelux" style="padding: 0;">
            <div class="wizard" data-initialize="wizard" id="personaliaWizard">
                <div class="steps-container">
                    <ul class="steps">
                        <li data-step="1" data-name="data_diri" class="active">
                            <span class="badge"><i class="fa fa-user"></i></span>Data Diri
                            <span class="chevron"></span>
                        </li>
                        <li data-step="2" data-name="riwayat_pendidikan">
                            <span class="badge"><i class="fa fa-globe"></i></span>Alamat
                            <span class="chevron"></span>
                        </li>
                        <li data-step="3" data-name="riwayat_pendidikan">
                            <span class="badge"><i class="fa fa-graduation-cap"></i></span>Riwayat Pendidikan
                            <span class="chevron"></span>
                        </li>
                        <li data-step="4" data-name="kontak">
                            <span class="badge"><i class="fa fa-phone"></i></span>Kontak
                            <span class="chevron"></span>
                        </li>
                        <li data-step="5" data-name="riwayat_organisasi">
                            <span class="badge"><i class="fa fa-flag"></i></span>Riwayat Organisasi
                            <span class="chevron"></span>
                        </li>
                       {{--  <li data-step="6" data-name="riwayat_karir_prodesional">
                            <span class="badge"><i class="fa fa-suitcase"></i></span>Riwayat Karir Profesional
                            <span class="chevron"></span>
                        </li> --}}
                    </ul>
                </div>
                <div class="actions">
                    <button type="button" class="btn btn-default btn-prev">
                        <span class="glyphicon glyphicon-arrow-left"></span>Prev
                    </button>
                    <button type="button" class="btn btn-primary btn-next" data-last="Complete">Next
                        <span class="glyphicon glyphicon-arrow-right"></span>
                    </button>
                </div>
                <div class="step-content">
                    <div class="step-pane active sample-pane alert" data-step="1">
                        <form role="form" id="dataDiriForm" class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                <label for="nomor_induk" class="control-label col-md-3">Nomor Induk</label>
                                <div class="col-md-6">
                                    <input type="text" name="nomor_induk" class="form-control" required id="nomor_induk" autofocus>
                                    <span class="help-block">Nomor induk kepegawaian</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama" class="control-label col-md-3">Nama</label>
                                <div class="col-md-6">
                                    <input type="text" name="nama" class="form-control" required autocomplete="off" id="nama">
                                    <span class="help-block">Nama lengkap tanpa gelar</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="alias" class="control-label col-md-3">Alias <small>(optional)</small></label>
                                <div class="col-md-6">
                                    <input type="text" name="alias" class="form-control" required autocomplete="off" id="alias">
                                    <span class="help-block">Nama lain</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="type" class="control-label col-md-3">Jenis Kelamin</label>
                                <div class="col-md-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input type="radio" name="jk" class="jk" value="L" autocomplete="off" checked><i class="fa fa-male"></i> Laki-laki
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jk" class="jk" value="P" autocomplete="off"><i class="fa fa-female"></i> Perempuan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tempat_lahir" class="control-label col-md-3">Tempat Lahir</label>
                                <div class="col-md-6">
                                    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" required autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_lahir" class="control-label col-md-3">Tanggal Lahir</label>
                                <div class="col-md-6">
                                    <input type="text" name="tanggal_lahir" class="form-control" id="tgl_lahir" readonly>
                                    <div data-date="{{date('d' . '/' . 'm' . '/' . 'Y')}}" id="tglLahirPicker"></div>
                                    {{-- <input type="hidden" name="tmt" id="tmt" class="form-control" required> --}}
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pendidikan_terakhir" class="control-label col-md-3">Pendidikan Terakhir</label>
                                <div class="col-md-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input type="radio" name="pendidikan_terakhir" class="pendidikan_terakhir" value="sma_sederajat" checked required><i class="fa fa-star"></i><br>SMA/SMK
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="pendidikan_terakhir" class="pendidikan_terakhir" value="diploma" required><i class="fa fa-star"></i><i class="fa fa-star"></i><br>Diploma
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="pendidikan_terakhir" class="pendidikan_terakhir" value="s1" required><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><br>Sarjana
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="pendidikan_terakhir" class="pendidikan_terakhir" value="s2" required><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><br>Pascasarjana
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="pendidikan_terakhir" class="pendidikan_terakhir" value="s3" required><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><br>Doktoral
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="pendidikan_terakhir" class="pendidikan_terakhir" value="lainnya" required><i class="fa fa-star-o"></i><br>Lainnya
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="tmt" class="control-label col-md-3">TMT</label>
                                <div class="col-md-6">
                                    <div data-date="{{date('d' . '/' . 'm' . '/' . 'Y')}}" id="tmtPicker"></div>
                                    <input type="hidden" name="tmt" id="tmt" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-md-offset-3">
                                {{csrf_field()}}
                                <input type="hidden" name="personalia_id" class="personalia_id" value="">
                            </div>
                        </form>
                        
                    </div>
                    <div class="step-pane sample-pane" data-step="2">
                        <form class="form-horizontal" method="post" action="">
                            <div class="form-group">
                                <label for="alamat" class="control-label col-md-3">Alamat</label>
                                <div class="col-md-6">
                                    <textarea name="alamat" class="form-control" id="alamat"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    {{csrf_field()}}
                                    <input type="hidden" name="personalia_id" class="personalia_id" value="">
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right" role="group" aria-label="..." id="tombol_1">
                                        <button type="button" class="btn btn-default hapus_alamat" disabled><i class="fa fa-trash-o"></i>&nbsp; Hapus</button>
                                        <button type="button" class="btn btn-success simpan_alamat" onclick="sendAlamat($(this))"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="step-pane sample-pane" data-step="3">
                        <form class="form-horizontal" enctype="multipart/form-data" method="post" action="">
                            <div class="form-group">
                                <label for="jenis_pendidikan" class="control-label col-md-3">Jenis Pendidikan</label>
                                <div class="col-md-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input type="radio" name="jenis_pendidikan" class="jenis_pendidikan" value="formal" autocomplete="off" checked><i class="fa fa-thumbs-up"></i> Formal
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jenis_pendidikan" class="jenis_pendidikan" value="non_formal" autocomplete="off"><i class="fa fa-thumbs-o-up"></i> Non Formal
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_lembaga_pendidikan" class="control-label col-md-3">Nama Lembaga Pendidikan</label>
                                <div class="col-md-6">
                                    <input type="text" name="nama_lembaga_pendidikan" class="form-control" required id="nama_lembaga_pendidikan">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="masa_pendidikan" class="control-label col-md-3">Masa Pendidikan</label>
                                <div class="col-md-6">
                                    <div class="input-daterange input-group" id="masa_pendidikan">
                                        <input type="text" class="form-control" name="masa_pendidikan_sejak">
                                        <span class="input-group-addon">s/d</span>
                                        <input type="text" class="form-control" name="masa_pendidikan_hingga">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="gelar_akademis" class="control-label col-md-3">Gelar Akademis <small>(Optional)</small></label>
                                <div class="col-md-6">
                                    <input type="text" name="gelar_akademis" class="form-control" required id="gelar_akademis">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    {{csrf_field()}}
                                    <input type="hidden" name="personalia_id" class="personalia_id" value="">
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right" role="group" aria-label="..." id="tombol_1">
                                        <button type="button" class="btn btn-default hapus_pendidikan" disabled><i class="fa fa-trash-o"></i>&nbsp; Hapus</button>
                                        <button type="button" class="btn btn-success simpan_pendidikan" onclick="sendRiwayatPendidikan($(this))"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="step-pane sample-pane" data-step="4">
                        <form class="form-horizontal" id="formKontak" enctype="multipart/form-data" method="post" action="">
                            <div class="form-group">
                                <label for="jenis_kontak" class="control-label col-md-3">Jenis Kontak</label>
                                <div class="col-md-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input type="radio" name="jenis_kontak" class="jenis_kontak" value="telepon" autocomplete="off" checked><i class="fa fa-phone"></i><br>Telepon
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jenis_kontak" class="jenis_kontak" value="email" autocomplete="off"><i class="fa fa-at"></i><br>Email
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jenis_kontak" class="jenis_kontak" value="facebook" autocomplete="off"><i class="fa fa-facebook"></i><br>facebook
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jenis_kontak" class="jenis_kontak" value="website" autocomplete="off"><i class="fa fa-globe"></i><br>Website
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jenis_kontak" class="jenis_kontak" value="lainnya" autocomplete="off"><i class="fa fa-ellipsis-h"></i><br>Lainnya
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kontak_value" class="control-label col-md-3">Value</label>
                                <div class="col-md-6">
                                    <input type="text" name="kontak_value" id="kontak_value" class="form-control" placeholder="081xxxxxxxxx">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    {{csrf_field()}}
                                    <input type="hidden" name="personalia_id" class="personalia_id" value="">
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right" role="group" aria-label="..." id="tombol_1">
                                        <button type="button" class="btn btn-default hapus_kontak" disabled><i class="fa fa-trash-o"></i>&nbsp; Hapus</button>
                                        <button type="button" class="btn btn-success simpan_kontak" onclick="sendKontak($(this))"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>    
                    </div>
                    <div class="step-pane sample-pane" data-step="5">
                        <form class="form-horizontal" id="formOrganisasi" enctype="multipart/form-data" method="post" action="">
                            <div class="form-group">
                                <label for="jenis_organisasi" class="control-label col-md-3">Jenis Organisasi</label>
                                <div class="col-md-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="btn btn-default active">
                                            <input type="radio" name="jenis_organisasi" class="jenis_organisasi" value="profit" autocomplete="off" checked><i class="fa fa-bell"></i><br>Profit
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jenis_organisasi" class="jenis_organisasi" value="non_profit" autocomplete="off"><i class="fa fa-bell-o"></i><br>Non Profit
                                        </label>
                                        <label class="btn btn-default">
                                            <input type="radio" name="jenis_organisasi" class="jenis_organisasi" value="prmerintahan" autocomplete="off"><i class="fa fa-bell-slash"></i><br>Pemerintahan
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nama_organisasi" class="control-label col-md-3">Nama Organisasi</label>
                                <div class="col-md-6">
                                    <input type="text" name="nama_organisasi" id="nama_organisasi" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="peran" class="control-label col-md-3">Peran</label>
                                <div class="col-md-6">
                                    <input type="text" name="peran" id="peran" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="masa_peran" class="control-label col-md-3">Masa Berperan</label>
                                <div class="col-md-6">
                                    <div class="input-daterange input-group" id="masa_peran">
                                        <input type="text" class="form-control" name="masa_berperan_sejak">
                                        <span class="input-group-addon">s/d</span>
                                        <input type="text" class="form-control" name="masa_berperan_hingga">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-3">
                                    {{csrf_field()}}
                                    <input type="hidden" name="personalia_id" class="personalia_id" value="">
                                </div>
                                <div class="col-md-6">
                                    <div class="btn-group pull-right" role="group" aria-label="..." id="tombol_1">
                                        <button type="button" class="btn btn-default hapus_organisasi" disabled><i class="fa fa-trash-o"></i>&nbsp; Hapus</button>
                                        <button type="button" class="btn btn-success simpan_organisasi" onclick="sendOrganisasi($(this))"><i class="fa fa-save"></i>&nbsp; Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    {{-- <div class="step-pane sample-pane" data-step="6">
                        Karir
                    </div> --}}
                </div>
            </div>
        </div>
    </div>


@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/wizard.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/bootstrap-datepicker.id.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/dropzone.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var d = new Date('{{date('D M d Y H:i:s 0')}}');
        var month = d.getMonth()+1;
        var day = d.getDate();
        var year = d.getFullYear();
        // console.log(d);
        $('#tglLahirPicker').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        }).on('changeDate', function() {
            $('#tgl_lahir').val(
                $('#tglLahirPicker').datepicker('getFormattedDate')
            );
        });

        $('.input-daterange').datepicker({
            format : 'dd MM yyyy',
            clearBtn: true,
            language: 'id',
            autoclose: true,
            todayHighlight: true
        });

        $("#tmtPicker").datepicker( {
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years",
            autoclose: true
        }).on('changeDate', function() {
            $('#tmt').val(
                $('#tmtPicker').datepicker('getFormattedDate')
            );
        });

    });


    $('#personaliaWizard').wizard().on('actionclicked.fu.wizard', function (evt, data) {
        // console.log(data.step);
        if (data.step == 1) {
            evt.preventDefault();
            if ($('#nomor_induk').val().length < 1) {
                notie.alert('error', 'Nomor Induk tidak boleh kosong', 1);
                $('#nomor_induk').focus().addClass('animated shake');
                return false;
            }

            if ($('#nama').val().length < 1) {
                notie.alert('error', 'Nama tidak boleh kosong', 1);
                $('#nama').focus().addClass('animated shake');
                return false;
            }

            if ($('#tempat_lahir').val().length < 1) {
                notie.alert('error', 'Tempat Lahir tidak boleh kosong', 1);
                $('#tempat_lahir').focus().addClass('animated shake');
                return false;
            }

            if ($('#tgl_lahir').val().length < 1) {
                notie.alert('error', 'Tanggal Lahir tidak boleh kosong', 1);
                $('#tgl_lahir').focus().addClass('animated shake');
                return false;
            }

            if ($('#tmt').val().length < 1) {
                notie.alert('error', 'TMT tidak boleh kosong', 1);
                $('#tmt').focus().addClass('animated shake');
                return false;
            }

            var data = $('#dataDiriForm').serialize();
            $.ajax({
                url: '{{url('personalia/kirimdatadiri')}}',
                type: 'POST',
                dataType: 'JSON',
                data: data,
                beforeSend: function(){
                    $('.btn-next').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                    $('#nomor_induk, #nama, #tgl_lahir, #tempat_lahir, .jk, .pendidikan_terakhir, #alias, tmt').prop('readonly', true);
                },
                success: function(resp) {
                    if (resp.status) {
                        $('#dataDiriForm').remove('#edit').append('<input type="hidden" name="edit" id="edit" value="'+ resp.data.hashid +'">');
                        $('.personalia_id').val(resp.data.hashid);
                        $('#personaliaWizard').wizard('selectedItem', {
                            step: 2
                        });
                        // $('#myWizard').wizard();

                    }else{
                        notie.alert('error', resp.message);
                    }

                    $('.btn-next').prop('disabled', false).html('Next <span class="glyphicon glyphicon-arrow-right"></span>');
                    $('#nomor_induk, #nama, #tgl_lahir, #tempat_lahir, .jk, .pendidikan_terakhir, #alias, tmt').prop('readonly', false);
                },
                error: function(resp) {
                    $('.btn-next').prop('disabled', false).html('Next <span class="glyphicon glyphicon-arrow-right"></span>');
                    $('#nomor_induk, #nama, #tgl_lahir, #tempat_lahir, .jk, .pendidikan_terakhir, #alias, tmt').prop('readonly', false);
                    notie.alert('error', resp, 3);    
                }
            });
        }else if(data.step == 2){

        }
    });

    $('#personaliaWizard').wizard().on('finished.fu.wizard', function (evt, data) {
        window.location.replace('{{url('personalia')}}');
    });

    //Pendidikan
   function sendRiwayatPendidikan(obj) {
        var form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        var nama_lembaga_pendidikan = form.find('input[name="nama_lembaga_pendidikan"]');
        if (nama_lembaga_pendidikan.val().length < 1) {
            notie.alert('error', 'Nama Lembaga Pendidikan tidak boleh kosong', 2);
            nama_lembaga_pendidikan.focus().addClass('animated shake');
            return false;
        }

        var data = form.serialize();
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
                    var pender="";
                    pender += "<form class=\"form-horizontal\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
                    pender += "    <div class=\"form-group\">";
                    pender += "        <label for=\"jenis_pendidikan\" class=\"control-label col-md-3\">Jenis Pendidikan<\/label>";
                    pender += "        <div class=\"col-md-6\">";
                    pender += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
                    pender += "                <label class=\"btn btn-default active\">";
                    pender += "                    <input type=\"radio\" name=\"jenis_pendidikan\" class=\"jenis_pendidikan\" value=\"formal\" autocomplete=\"off\" checked><i class=\"fa fa-thumbs-up\"><\/i> Formal";
                    pender += "                <\/label>";
                    pender += "                <label class=\"btn btn-default\">";
                    pender += "                    <input type=\"radio\" name=\"jenis_pendidikan\" class=\"jenis_pendidikan\" value=\"non_formal\" autocomplete=\"off\"><i class=\"fa fa-thumbs-o-up\"><\/i> Non Formal";
                    pender += "                <\/label>";
                    pender += "            <\/div>";
                    pender += "        <\/div>";
                    pender += "    <\/div>";
                    pender += "    <div class=\"form-group\">";
                    pender += "        <label for=\"nama_lembaga_pendidikan\" class=\"control-label col-md-3\">Nama Lembaga Pendidikan<\/label>";
                    pender += "        <div class=\"col-md-6\">";
                    pender += "            <input type=\"text\" name=\"nama_lembaga_pendidikan\" class=\"form-control\" required id=\"nama_lembaga_pendidikan\">";
                    pender += "        <\/div>";
                    pender += "    <\/div>";
                    pender += "    <div class=\"form-group\">";
                    pender += "        <label for=\"masa_pendidikan\" class=\"control-label col-md-3\">Masa Pendidikan<\/label>";
                    pender += "        <div class=\"col-md-6\">";
                    pender += "            <div class=\"input-daterange input-group\" id=\"masa_pendidikan\">";
                    pender += "                <input type=\"text\" class=\"form-control\" name=\"masa_pendidikan_sejak\">";
                    pender += "                <span class=\"input-group-addon\">s\/d<\/span>";
                    pender += "                <input type=\"text\" class=\"form-control\" name=\"masa_pendidikan_hingga\">";
                    pender += "            <\/div>";
                    pender += "        <\/div>";
                    pender += "    <\/div>";
                    pender += "    <div class=\"form-group\">";
                    pender += "        <label for=\"gelar_akademis\" class=\"control-label col-md-3\">Gelar Akademis <small>(Optional)<\/small><\/label>";
                    pender += "        <div class=\"col-md-6\">";
                    pender += "            <input type=\"text\" name=\"gelar_akademis\" class=\"form-control\" required id=\"gelar_akademis\">";
                    pender += "        <\/div>";
                    pender += "    <\/div>";
                    pender += "   ";
                    pender += "    <div class=\"form-group\">";
                    pender += "        <div class=\"col-md-3\">";
                    pender += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
                    pender += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\""+ resp.hashid +"\">";
                    pender += "        <\/div>";
                    pender += "        <div class=\"col-md-6\">";
                    pender += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
                    pender += "                <button type=\"button\" class=\"btn btn-default hapus_pendidikan\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
                    pender += "                <button type=\"button\" class=\"btn btn-success simpan_pendidikan\" onclick=\"sendRiwayatPendidikan($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
                    pender += "            <\/div>";
                    pender += "        <\/div>";
                    pender += "    <\/div>";
                    pender += "<\/form>";
                    form.parent().append(pender);

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

    function sendKontak(obj) {
        var form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        var kontak_value = form.find('input[name="kontak_value"]');
        if (kontak_value.val().length < 1) {
            notie.alert('error', 'Value Kontak tidak boleh kosong', 2);
            kontak_value.focus().addClass('animated shake');
            return false;
        }

        var data = form.serialize();
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


                    var pender="";
                        pender += "<form class=\"form-horizontal\" id=\"formKontak\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <label for=\"jenis_kontak\" class=\"control-label col-md-3\">Jenis Kontak<\/label>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
                        pender += "                <label class=\"btn btn-default active\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"telepon\" autocomplete=\"off\" checked><i class=\"fa fa-phone\"><\/i><br>Telepon";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"email\" autocomplete=\"off\"><i class=\"fa fa-at\"><\/i><br>Email";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"facebook\" autocomplete=\"off\"><i class=\"fa fa-facebook\"><\/i><br>facebook";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_kontak\" class=\"jenis_kontak\" value=\"website\" autocomplete=\"off\"><i class=\"fa fa-globe\"><\/i><br>Website";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default\">";
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

    //Alamat
    function sendAlamat(obj) {
        var form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        var alamat = form.find('textarea[name="alamat"]');
        if (alamat.val().length < 1) {
            notie.alert('error', 'Alamat tidak boleh kosong', 2);
            alamat.focus().addClass('animated shake');
            return false;
        }

        var data = form.serialize();
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
                    form.find('.hapus_alamat').prop('disabled', false).attr('onclick', 'hapusAlamat(\''+ resp.data.hashid +'\',$(this))');
                    form.find('.simpan_alamat').prop('disabled', false).remove();
                    var strVar="";
                        strVar += "<form class=\"form-horizontal\" method=\"post\" action=\"\">";
                        strVar += "    <div class=\"form-group\">";
                        strVar += "        <label for=\"alamat\" class=\"control-label col-md-3\">Alamat<\/label>";
                        strVar += "        <div class=\"col-md-6\">";
                        strVar += "            <textarea name=\"alamat\" class=\"form-control\" id=\"alamat\"><\/textarea>";
                        strVar += "        <\/div>";
                        strVar += "    <\/div>";
                        strVar += "    <div class=\"form-group\">";
                        strVar += "        <div class=\"col-md-3\">";
                        strVar += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
                        strVar += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"" + resp.hashid + "\">";
                        strVar += "        <\/div>";
                        strVar += "        <div class=\"col-md-6\">";
                        strVar += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
                        strVar += "                <button type=\"button\" class=\"btn btn-default hapus_alamat\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
                        strVar += "                <button type=\"button\" class=\"btn btn-success simpan_alamat\" onclick=\"sendAlamat($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
                        strVar += "            <\/div>";
                        strVar += "        <\/div>";
                        strVar += "    <\/div>";
                        strVar += "<\/form>";

                        
                        form.parent().append(strVar);
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

    function hapusAlamat(hashid, obj) {
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

    function sendOrganisasi(obj) {
        var form = obj.parent().parent().parent().parent();
        //console.log(form.serialize());
        var nama_organisasi = form.find('input[name="nama_organisasi"]');
        var peran = form.find('input[name="peran"]');

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

        var data = form.serialize();
        $.ajax({
            url: '{{url('personalia/kirimorganisasi')}}',
            type: 'POST',
            dataType: 'JSON',
            data: data,
            beforeSend: function(){
                $('.simpan_organisasi').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Loading...');
                form.find('input[name="nama_organisasi"]').prop('readonly', true);
                form.find('input[name="peran"]').prop('readonly', true);
                form.find('input[name="masa_berperan_sejak"]').prop('readonly', true);
                form.find('input[name="masa_berperan_hingga"]').prop('readonly', true);
            },
            success: function(resp) {
                if (resp.status) {
                    form.find('.hapus_organisasi').prop('disabled', false).attr('onclick', 'hapusPendidikan(\''+ resp.data.hashid +'\',$(this))');
                    form.find('.simpan_organisasi').prop('disabled', false).remove();

                    var pender="";
                        pender += "<form class=\"form-horizontal\" id=\"formOrganisasi\" enctype=\"multipart\/form-data\" method=\"post\" action=\"\">";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <label for=\"jenis_organisasi\" class=\"control-label col-md-3\">Jenis Organisasi<\/label>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <div class=\"btn-group\" data-toggle=\"buttons\">";
                        pender += "                <label class=\"btn btn-default active\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"profit\" autocomplete=\"off\" checked><i class=\"fa fa-bell\"><\/i><br>Profit";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"non_profit\" autocomplete=\"off\"><i class=\"fa fa-bell-o\"><\/i><br>Non Profit";
                        pender += "                <\/label>";
                        pender += "                <label class=\"btn btn-default\">";
                        pender += "                    <input type=\"radio\" name=\"jenis_organisasi\" class=\"jenis_organisasi\" value=\"prmerintahan\" autocomplete=\"off\"><i class=\"fa fa-bell-slash\"><\/i><br>Pemerintahan";
                        pender += "                <\/label>";
                        pender += "            <\/div>";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <label for=\"nama_organisasi\" class=\"control-label col-md-3\">Nama Organisasi<\/label>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <input type=\"text\" name=\"nama_organisasi\" id=\"nama_organisasi\" class=\"form-control\">";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <label for=\"peran\" class=\"control-label col-md-3\">Peran<\/label>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <input type=\"text\" name=\"peran\" id=\"peran\" class=\"form-control\">";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <label for=\"masa_peran\" class=\"control-label col-md-3\">Masa Berperan<\/label>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <div class=\"input-daterange input-group\" id=\"masa_peran\">";
                        pender += "                <input type=\"text\" class=\"form-control\" name=\"masa_peran_sejak\">";
                        pender += "                <span class=\"input-group-addon\">s\/d<\/span>";
                        pender += "                <input type=\"text\" class=\"form-control\" name=\"masa_peran_hingga\">";
                        pender += "            <\/div>";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "    <div class=\"form-group\">";
                        pender += "        <div class=\"col-md-3\">";
                        pender += "            <input type=\"hidden\" name=\"_token\" value=\"{{csrf_token()}}\">";
                        pender += "            <input type=\"hidden\" name=\"personalia_id\" class=\"personalia_id\" value=\"\">";
                        pender += "        <\/div>";
                        pender += "        <div class=\"col-md-6\">";
                        pender += "            <div class=\"btn-group pull-right\" role=\"group\" aria-label=\"...\" id=\"tombol_1\">";
                        pender += "                <button type=\"button\" class=\"btn btn-default hapus_organisasi\" disabled><i class=\"fa fa-trash-o\"><\/i>&nbsp; Hapus<\/button>";
                        pender += "                <button type=\"button\" class=\"btn btn-success simpan_organisasi\" onclick=\"sendOrganisasi($(this))\"><i class=\"fa fa-save\"><\/i>&nbsp; Simpan<\/button>";
                        pender += "            <\/div>";
                        pender += "        <\/div>";
                        pender += "    <\/div>";
                        pender += "<\/form>";

                        form.parent().append(pender);

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
                    form.find('input[name="masa_berperan_sejak"]').prop('readonly', false);
                    form.find('input[name="masa_berperan_hingga"]').prop('readonly', false);
                    notie.alert('error', resp, 3);
                }
            },
            error: function(resp) {
                $('.simpan_organisasi').prop('disabled', false).html('<i class="fa fa-save"></i> Simpan');
                form.find('input[name="nama_organisasi"]').prop('readonly', false);
                form.find('input[name="peran"]').prop('readonly', false);
                form.find('input[name="masa_berperan_sejak"]').prop('readonly', false);
                form.find('input[name="masa_berperan_hingga"]').prop('readonly', false);
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
</script>
@endsection
