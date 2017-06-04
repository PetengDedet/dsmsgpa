@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
@endsection

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
    <div class="row">
        @forelse($lembaga as $k => $v)
            @php
                $bg = ['bg-red', 'bg-aqua', 'bg-green', 'bg-yellow'];
            @endphp

            <div class="col-md-3">
                <div class="info-box {{$bg[$k]}}">
                    @if(strlen($v->foto_pimpinan) > 0)
                        <span class="info-box-icon">
                            <img src="{{asset('img/' . $v->foto_pimpinan)}}" class="">
                        </span>
                        <div class="info-box-content">
                            {{$v->nama_pimpinan}}
                            <br>
                            @if($v->id == 1)
                                Rektor {{$v->nama}}
                                @else
                                    Dekan {{$v->nama}}
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @empty
            -
        @endforelse
    </div>
        <br>
        <div class="row">
        @forelse($lembaga as $k => $v)
            <div class="col-md-3">
                @php
                    $panelClass = ['danger', 'info', 'success', 'warning'];
                @endphp
                <div class="panel panel-{{$panelClass[$k]}}">
                    <div class="panel-body" id="chart_anggaran_{{$v->id}}">
                    </div>
                    <div class="panel-heading">
                        @if(count($v->anggaran->where('tahun', date('Y'))) > 0)
                            Pagu: <span class="pull-right"> Rp. {{number_format($v->anggaran->where('tahun', date('Y'))->first()->pagu, 0, ',', '.')}},-</span><br>
                            Realisasi: <span class="pull-right"> Rp. {{number_format($v->anggaran->where('tahun', date('Y'))->first()->realisasi, 0, ',', '.')}},-</span><br>
                            Persentase: <span class="pull-right"> {{number_format($v->anggaran->where('tahun', date('Y'))->first()->realisasi / $v->anggaran->where('tahun', date('Y'))->first()->pagu * 100, 2, ',', '.')}}%</span>
                        @else
                            - Belum ada anggaran
                        @endif
                    </div>
                </div>
                {{-- {{$v->nama}} --}}
            </div>
            @empty
                -
        @endforelse
        </div>
        <br>
        <br>
        <div class="col-md-12">
            &nbsp;
        </div>
        <div class="row">

         @forelse($lembaga as $k => $v)
            <div class="col-md-3">
                @php
                    $panelClass = ['danger', 'info', 'success', 'warning'];
                @endphp
                <div class="panel panel-{{$panelClass[$k]}}">
                    <div class="panel-heading">
                        <h4>Agenda {{$v->nama}} @php
                                        $bulan = 'Januari';
                                        switch (date('n')) {
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

                                    {{$bulan}} {{date('Y')}}</h4>
                    </div>
                    <div class="panel-body">
                        @php
                            $agenda[$k] = $v->agenda->where('tahun', date('Y'))->where('bulan', date('n'));
                            if (count($agenda[$k]) > 0) {
                                foreach ($agenda[$k] as $key => $value) {
                                    echo '<i class="fa fa-check"></i>&nbsp;' . $value->agenda;
                                }
                            }
                        @endphp
                    </div>
                </div>
            </div>
            @empty
             -
        @endforelse
        </div>
        <br>
        <br>
        <div class="col-md-12">
            &nbsp;
        </div>

        <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Pertanggungjawaban Dokumen Keuangan {{date('F')}} {{date('Y')}}</h4>
                </div>
                <div class="panel-body">
                    @forelse($lembaga as $k => $v)
                        @php
                            $tj[$k] = $v->keuangan->where('tahun', date('Y'))->where('bulan', date('n'))->first();
                        @endphp
                            <h4>{{$v->nama}}</h4>
                            @if(count($tj[$k]) > 0)
                                {{$tj[$k]->nilai}}
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-{{$panelClass[$k]}} active" role="progressbar" aria-valuenow="{{$tj[$k]->nilai}}" aria-valuemin="0" aria-valuemax="100" style="width: {{$tj[$k]->nilai}}%">
                                        <span class="sr-only">{{$tj[$k]->nilai}}</span>
                                    </div>
                                </div>

                                @else
                                0
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                        <span class="sr-only">0</span>
                                    </div>
                                </div>
                            @endif
                        @empty
                            -
                    @endforelse
                </div>
            </div>
        </div>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            &nbsp;
        </div>
        <div class="row">
        
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Disposisi KADEP {{date('F')}} {{date('Y')}}</h4>
                </div>
                <div class="panel-body">
                    <div id="chart_disposisi"></div>
                </div>
            </div>
        </div>
</div>
        <br>
        <br>
        <div class="col-md-12">
            &nbsp;
        </div>
        <div class="row">

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Status Tindak Lanjut Audit</h4>
                </div>
                <div class="panel-body">
                    @if(count($audit) > 0)
                        <div id="chart_audit"></div>
                    @else
                        - Belum ada data
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Penyelesaian Tindak Lanjut RDK</h4>
                </div>
                <div class="panel-body">
                    @if(count($rdk) > 0)
                        <div id="chart_rdk"></div>
                    @else
                        - Belum ada data
                    @endif
                </div>
            </div>
        </div>
        </div>
        <br>
        <br>
        <div class="col-md-12">
            &nbsp;
        </div>
        {{-- <!-- <div class="box-body"> -->
            @forelse($lembaga as $k => $v)
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <dl class="dl-horizontal">
                                <dt>Nama Lembaga</dt>
                                <dd>{{$v->alias . ' - ' . $v->nama}}</dd>
                                <dt>Pimpinan</dt>
                                <dd>{{$v->nama_pimpinan}}<br>{{$v->foto_pimpinan}}</dd>
                                <dt>Anggaran Tahun {{date('Y')}}</dt>
                                <dd>
                                    @if(count($v->anggaran->where('tahun', date('Y'))) > 0)
                                        Pagu: Rp. {{number_format($v->anggaran->where('tahun', date('Y'))->first()->pagu, 0, ',', '.')}},-<br>
                                        Realisasi: Rp. {{number_format($v->anggaran->where('tahun', date('Y'))->first()->realisasi, 0, ',', '.')}},-<br>
                                        Persentase: {{number_format($v->anggaran->where('tahun', date('Y'))->first()->realisasi / $v->anggaran->where('tahun', date('Y'))->first()->pagu * 100, 2, ',', '.')}}%
                                    @else
                                        - Belum ada anggaran
                                    @endif
                                </dd>
                                <dt>Agenda</dt>
                                <dd>
                                    @if(count($v->agenda->where('tahun', date('Y'))->where('bulan', date('n'))) > 0)

                                        @foreach($v->agenda->where('tahun', date('Y'))->where('bulan', date('n')) as $key => $value)
                                            - {{$value->agenda}}
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </dd>
                                <dt></dt>
                            </dl>
                        </div>
                    </div>
                </div>
            @empty
                -- Belum ada data
            @endforelse
        <!-- </div> --> --}}
    {{-- </div> --}}
@endsection

@section('js')
<script type="text/javascript" src="{{asset('js/highcharts.js')}}"></script>
<script type="text/javascript">
    @forelse($lembaga as $k => $v)
        
        Highcharts.chart('chart_anggaran_{{$v->id}}', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: 250,
                spacingBottom: 0,
                spacingTop: 0,
                spacingLeft: 0,
                spacingRight: 0
            },
            title: {
                text: '@if(count($v->anggaran->where('tahun', date('Y'))) > 0){{number_format($v->anggaran->where('tahun', date('Y'))->first()->realisasi / $v->anggaran->where('tahun', date('Y'))->first()->pagu * 100, 2, ',', '.')}}%@else 0%@endif',
                align: 'center',
                verticalAlign: 'middle',
                y: 40
            },
            // tooltip: {
            //     // pointFormat: '<b>Pagu: </b>'
            // },
            plotOptions: {
                pie: {
                    dataLabels: {
                        enabled: true,
                        distance: -50,
                        style: {
                            // fontWeight: 'bold',
                            color: 'white'
                        }
                    },
                    startAngle: -90,
                    endAngle: 90,
                    center: ['50%', '75%']
                }

            },
            series: [{
                type: 'pie',
                name: 'Rp. ',
                innerSize: '50%',
                data: [
                    @if(count($v->anggaran->where('tahun', date('Y'))) > 0)
                        ['Realisasi', {{$v->anggaran->where('tahun', date('Y'))->first()->realisasi}}],
                        ['Sisa Pagu', {{$v->anggaran->where('tahun', date('Y'))->first()->pagu - $v->anggaran->where('tahun', date('Y'))->first()->realisasi}}]
                        // ['Realisasi', 10],
                        // ['Pagu', 90]
                        @else
                        ['Realisasi', 0],
                        ['Sisa Pagu', 0]
                            
                    @endif
                    // ['Firefox',   10.38],
                    // ['IE',       56.33],
                    // ['Chrome', 24.03],
                    // ['Safari',    4.77],
                    // ['Opera',     0.91],
                    // {
                    //     name: 'Proprietary or Undetectable',
                    //     y: 0.2,
                    //     dataLabels: {
                    //         enabled: false
                    //     }
                    // }
                ]
            }]
        });


        @empty
    
    @endforelse
    @if (count($audit) > 0) 
       Highcharts.chart('chart_audit', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Status Tindak Lanjut Audit'
            },
            subtitle: {
                text: 'Tahun {{date('Y')}}'
            },
            xAxis: {
                categories: [
                    'Triwulan 1',
                    'Triwulan 2',
                    'Triwulan 3',
                    'Triwulan 4'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Pending',
                data: [
                    @php
                        $pending = '';
                        foreach ($audit as $key => $value) {
                            $pending .= $value->pending . ',';
                        }

                        echo trim($pending, ',');
                    @endphp
                ]
            }, {
                name: 'Selesai',
                data: [
                    @php
                        $selesai = '';
                        foreach ($audit as $key => $value) {
                            $selesai .= $value->selesai . ',';
                        }

                        echo trim($selesai, ',');
                    @endphp
                ]
            }]
        });
    @endif

    @if(count($rdk) > 0)
        Highcharts.chart('chart_rdk', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Penyelesaian Tindak Lanjut RDK'
            },
            subtitle: {
                text: 'Bulan {{date('F')}} {{date('Y')}}'
            },
            xAxis: {
                categories: [
                    'Jumlah'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Jumlah'
                }
            },
            // tooltip: {
            //     headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            //     pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            //         '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            //     footerFormat: '</table>',
            //     shared: true,
            //     useHTML: true
            // },
            // plotOptions: {
            //     column: {
            //         pointPadding: 0.2,
            //         borderWidth: 0
            //     }
            // },
            series: [
                {name: 'Pending',
                 data: [{{$rdk->first()->pending}}]},
                 {name: 'Selesai',
                 data: [{{$rdk->first()->selesai}}]}

            ]
        });
    @endif

    @if (count($disposisi) > 0) {
        Highcharts.chart('chart_disposisi', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Disposisi KADEP'
            },
            subtitle: {
                text: 'Bulan {{date('F Y')}}'
            },
            xAxis: {
                categories: [
                    'Bulan {{date('n Y')}}'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.f} Surat</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
                @php
                    $str = '';
                @endphp
                @foreach($lembaga as $k => $v)
                    @if($v->id != 1)
                        @php
                            $jumlah[$k] = 0;
                            $dis[$k] = $v->disposisi->where('tahun', date('Y'))->where('bulan', date('n'))->first();
                            if (count($dis[$k]) > 0) {
                                $jumlah[$k] = $dis[$k]->nilai;
                            }

                            $str .= "{name:'" . $v->nama . "',data:[" . $jumlah[$k] . "]},";
                        @endphp
                    @endif
                @endforeach

                @php
                    $str = trim($str, ',');
                    echo $str;
                @endphp
            ]
        });
    }
    @endif

</script>
@endsection
