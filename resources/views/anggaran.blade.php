@extends('adminlte::page')

@section('title', 'Anggaran')

@section('css')
@endsection

@section('content_header')
    <h1>Anggaran</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                {{-- <li><a href="{{url('master/lembaga')}}">Lembaga</a></li> --}}
                <li class="active">Anggaran</li>
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
            <form role="form" class="form-horizontal" method="post" action="{{url('simpan-anggaran')}}">
                <div class="form-group">
                    <label for="type" class="control-label col-md-3">Lembaga</label>
                    <div class="col-md-6">
                        <select name="lembaga" class="form-control">
                            @foreach($lembaga as $k => $v)
                                <option value="{{$v->id}}">{{$v->alias}} - {{$v->nama}}</option>
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
                    <label for="pagu" class="control-label col-md-3">Pagu</label>
                    <div class="col-md-6">
                        <input type="number" name="pagu" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="realisasi" class="control-label col-md-3">Realisasi</label>
                    <div class="col-md-6">
                        <input type="number" name="realisasi" class="form-control" required>
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
                            <th>Pagu</th>
                            <th>Realisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggaran as $k => $v)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$v->lembaga->alias}} - {{$v->lembaga->nama}}</td>
                                <td>{{$v->tahun}}</td>
                                <td>{{number_format($v->pagu, 0, ',', '.')}}</td>
                                <td>{{number_format($v->realisasi, 0, ',', '.')}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!!$anggaran->links()!!}
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
