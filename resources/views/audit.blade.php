@extends('adminlte::page')

@section('title', 'Audit')

@section('css')
@endsection

@section('content_header')
    <h1>Audit</h1>
@endsection

@section('content')
    <div class="box">
        <div class="box-heading">
            <ol class="breadcrumb">
                <li><a href="{{url('dashboard')}}"><i class="fa fa-home"></i></a></li>
                {{-- <li><a href="{{url('master/lembaga')}}">Lembaga</a></li> --}}
                <li class="active">Audit</li>
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
            <form role="form" class="form-horizontal" method="post" action="{{url('simpan-audit')}}">
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
                    <label for="triwulan" class="control-label col-md-3">Triwulan</label>
                    <div class="col-md-6">
                        <select name="triwulan" class="form-control">
                            @for($i = 1; $i <= 4; $i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pending" class="control-label col-md-3">Jumlah Audit (Pending)</label>
                    <div class="col-md-6">
                        <input type="number" name="pending" class="form-control" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="selesai" class="control-label col-md-3">Jumlah Audit (Selesai)</label>
                    <div class="col-md-6">
                        <input type="number" name="selesai" class="form-control" required>
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
                            <th>Tahun</th>
                            <th>Triwulan</th>
                            <th>Pending</th>
                            <th>Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($audit as $k => $v)
                            <tr>
                                <td>{{$k+1}}</td>
                                <td>{{$v->tahun}}</td>
                                <td>{{$v->triwulan}}</td>
                                <td>{{$v->pending}}</td>
                                <td>{{$v->selesai}}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {!!$audit->links()!!}
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript">

</script>
@endsection
