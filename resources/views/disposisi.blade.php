@extends('adminlte::page')

@section('title', 'Disposisi')

@section('css')
@endsection

@section('content_header')
    <h1>Disposisi</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                {{-- <li><a href="{{url('master/lembaga')}}">Lembaga</a></li> --}}
                <li class="active">Disposisi</li>
            </ol>
        </div>
        <div class="box-body">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(Session::has('msg'))
                <div class="alert alert-info">{{Session::get('msg')}}</div>
            @endif
            <form role="form" class="form-horizontal" method="post" action="{{url('simpan-disposisi')}}">
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Lembaga</label>
                    <div class="col-md-6">
                        <select name="lembaga" class="form-control">
                            @foreach($lembaga as $k => $v)
                                @if($v->id != 1)
                                    <option value="{{$v->id}}">{{$v->alias}} - {{$v->nama}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="tahun" class="control-label col-md-3">Tahun</label>
                    <div class="col-md-6">
                        <select name="tahun" class="form-control">
                            @for($i = date('Y'); $i <= date('Y') + 3; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="bulan" class="control-label col-md-3">Bulan</label>
                    <div class="col-md-6">
                        <select name="bulan" class="form-control">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nilai" class="control-label col-md-3">Nilai</label>
                    <div class="col-md-6">
                        <input type="number" name="nilai" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-3">
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default pull-right">Simpan <i class="fa fa-save"></i></button>
                    
                </div>
            </form>
        </div>
    </div>

    <div class="box">
        <div class="box-body">
            <table class="table table-striped table-hover table-condensed">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lembaga</th>
                            <th>Tahun</th>
                            <th>Bulan</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($disposisi as $k => $v)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$v->lembaga->alias}} - {{$v->lembaga->nama}}</td>
                                <td>{{$v->tahun}}</td>
                                <td>
                                    @php
                                        $bulan = 'Januari';
                                        switch ($v->bulan) {
                                            case 1:
                                                $bulan = 'Januari';
                                                break;
                                            case 2:
                                                $bulan = 'Pebruari';
                                                break;
                                            case 3:
                                                $bulan = 'Maret';
                                                break;
                                            case 4:
                                                $bulan = 'April';
                                                break;
                                            case 5:
                                                $bulan = 'Mei';
                                                break;
                                            case 6:
                                                $bulan = 'Juni';
                                                break;
                                            case 7:
                                                $bulan = 'Juli';
                                                break;
                                            case 8:
                                                $bulan = 'Agustus';
                                                break;
                                            case 9:
                                                $bulan = 'September';
                                                break;
                                            case 10:
                                                $bulan = 'Oktober';
                                                break;
                                            case 11:
                                                $bulan = 'Nopember';
                                                break;
                                            case 12:
                                                $bulan = 'Desember';
                                                break;
                                            default:
                                                $bulan = 'Januari';
                                                break;
                                        }
                                    @endphp

                                    {{$bulan}}
                                </td>
                                <td>{{$v->nilai}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!!$disposisi->links()!!}
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
