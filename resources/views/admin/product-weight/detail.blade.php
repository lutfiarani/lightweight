@extends('template.__body')
@section('title', 'View Detail')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css" rel="stylesheet">
<style>
    .table-container {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
    }

    table{
        font-size: 80%;
    }
    
    #myTable {
        width: 2400px !important; /* Lebar total tabel */
        margin: 0 !important;
    }
    
    .dataTables_wrapper {
        width: 100%;
        overflow-x: auto;
    }
    
    /* Mengatur lebar kolom */
    #myTable th:first-child,
    #myTable td:first-child {
        width: 50px !important;  /* Kolom No */
    }
    
    #myTable th,
    #myTable td {
        white-space: nowrap;
    }
</style>
@section('content')
<div class="app-main__inner"  style="width:175vh">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Product Weight Management - Detail
                    {{-- <div class="page-title-subheading">This is an example dashboard created using build-in elements and components.
                    </div> --}}
                </div>
            </div>
             
        </div>
    </div>            
    <div class="row">
        <div class="col-md-12">
            <table class="mb-0 table table-bordered" style="width:100%; font-size:85%">
                <tr>
                   <th>Development Center</th>
                   <td>{{$product->development_center}}</td>
                   <th>Model Name</th>
                   <td>{{ $product->model_name }}</td>
                   <th>Gender</th>
                   <td>{{ $product->gender }}</td>
                   <th>Sports Category</th>
                   <td>{{ $product->sports_category }}</td>
                </tr>
                <tr>
                  <th>Season</th>
                  <td>{{ $product->season}}</td>
                  <th>Model Number</th>
                  <td>{{ $product->model_number }}</td>
                  <th>Gender Age</th>
                  <td>{{ $product->age_group }}</td>
                  <th>Business Segment</th>
                  <td>{{ $product->business_segment }}</td>
                </tr>
                <tr>
                    <th>Development Type</th>
                    <td>{{ $product->development_type }}</td>
                    <th>Article Number</th>
                    <td>{{ $product->article }}</td>
                    <th>Age Group</th>
                    <td>{{ $product->age_group }}</td>
                    <th>Intended Use</th>
                    <td>PERFORMANCE</td>
                </tr>
                <tr>
                    <th>Current Stage</th>
                    <td>MCS</td>
                    <th>Article Status</th>
                    <td>{{ $product->article_status }}</td>
                    <th>SAP Gender</th>
                    <td>ME</td>
                    <th>Sample Size</th>
                    <td>{{ $product->sample_size }}</td>
                </tr>
            </table>
        </div>
    </div>
    <br>

    <a href="{{ route('product-weight.export-pdf', $product->article) }}" class="btn btn-danger">
        <i class="pe-7s-file"></i>Export to PDF
    </a>
    <a href="{{ route('product-weight.preview-pdf', $product->article) }}" 
        class="btn btn-info" 
        target="_blank">
        <i class="pe-7s-search"></i>
         Preview PDF
     </a>
     
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="col-md-12">
                            <div class="mb-3 card">
                                <div class="card-header">
                                    <ul class="nav nav-justified" role="tablist">
                                        @foreach($availableStages as $index=>$stage)
                                        <li class="nav-item" role="presentation">
                                            <a data-bs-toggle="tab" href="#tab-{{ $index }}"
                                                class="nav-link {{ $index === count($availableStages) - 1 ? 'active' : '' }}"
                                                aria-selected="{{ $index === count($availableStages) -1 ? 'true' : 'false' }}"
                                                tabindex="{{ $index === count($availableStages) -1 ? '0' : '-1' }}"
                                                role="tab">
                                                {{ substr($stage, 0, -1) }}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>

                                {{-- tab content  --}}
                                <div class="card-body">
                                    <div class="tab-content">
                                        @foreach($availableStages as $index=> $stage)
                                            <div class="tab-pane {{ $index === count($availableStages) -1 ? 'active' : '' }}"
                                                id="tab-{{ $index }}"
                                                role="tabpanel">
                                            {{-- Status Table --}}
                                            <table class="table table-bordered align-center">
                                                <tr>
                                                    <th class="table-dark">Status</th>
                                                    <td>{{ $product->weight_status}}</td>
                                                    <th class="table-dark">Update Date</th>
                                                    <td> {{ $product->updated_at}} </td>
                                                    <th class="table-dark">L</th>
                                                    <td>{{ $countLeftRight[0][0] }}</td>
                                                    <th class="table-dark">R</th>
                                                    <td>{{ $countLeftRight[0][1] }}</td>
                                                </tr>
                                            </table>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-8">
                                                    <table class="table table-bordered">
                                                        <thead class="table-dark">
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Part Name</th>
                                                                {{-- <th>Previous Stage Weight</th> --}}
                                                                <th>Confirm Weight</th>
                                                                <th>Average Weight</th>
                                                                <th>Min Weight</th>
                                                                <th>Max Weight</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php
                                                                $currentStageData = $weightData[$stage] ?? null;    
                                                            @endphp
                                                            <tr>
                                                                <td>1</td>
                                                                <td class="bg-danger">Brand Target</td>
                                                                {{-- <td class="bg-danger">{{ $currentStageData['brand_target']['previous'] ?? '' }}</td> --}}
                                                                <td class="bg-danger">{{ $currentStageData['brand_target']['confirm'] ?? '' }}</td>
                                                                <td class="bg-danger">{{ $currentStageData['brand_target']['average'] ? number_format($currentStageData['brand_target']['average'], 2) : '' }}</td>
                                                                <td class="bg-danger">{{ $currentStageData['brand_target']['min'] ? number_format($currentStageData['brand_target']['min'], 2) : '' }}</td>
                                                                <td class="bg-danger">{{ $currentStageData['brand_target']['max'] ? number_format($currentStageData['brand_target']['max'], 2) : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>2</td>
                                                                <td>Assembly (g)</td>
                                                                {{-- <td>{{ $currentStageData['assembly']['previous'] ?? '' }}</td> --}}
                                                                <td>{{ $currentStageData['assembly']['confirm'] ?? '' }}</td>
                                                                <td>{{ $currentStageData['assembly']['average'] ? number_format($currentStageData['assembly']['average'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['assembly']['min'] ? number_format($currentStageData['assembly']['min'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['assembly']['max'] ? number_format($currentStageData['assembly']['max'], 2) : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>3</td>
                                                                <td>Upper (g)</td>
                                                                {{-- <td>{{ $currentStageData['upper']['previous'] ?? '' }}</td> --}}
                                                                <td>{{ $currentStageData['upper']['confirm'] ?? '' }}</td>
                                                                <td>{{ $currentStageData['upper']['average'] ? number_format($currentStageData['upper']['average'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['upper']['min'] ? number_format($currentStageData['upper']['min'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['upper']['max'] ? number_format($currentStageData['upper']['max'], 2) : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>4</td>
                                                                <td>Stock Fit (g)</td>
                                                                {{-- <td>{{ $currentStageData['stockfit']['previous'] ?? '' }}</td> --}}
                                                                <td>{{ $currentStageData['stockfit']['confirm'] ?? '' }}</td>
                                                                <td>{{ $currentStageData['stockfit']['average'] ? number_format($currentStageData['stockfit']['average'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['stockfit']['min'] ? number_format($currentStageData['stockfit']['min'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['stockfit']['max'] ? number_format($currentStageData['stockfit']['max'], 2) : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>5</td>
                                                                <td>Outsole (g)</td>
                                                                {{-- <td>{{ $currentStageData['outsole']['previous'] ?? '' }}</td> --}}
                                                                <td>{{ $currentStageData['outsole']['confirm'] ?? '' }}</td>
                                                                <td>{{ $currentStageData['outsole']['average'] ? number_format($currentStageData['outsole']['average'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['outsole']['min'] ? number_format($currentStageData['outsole']['min'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['outsole']['max'] ? number_format($currentStageData['outsole']['max'], 2) : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>6</td>
                                                                <td>Mid Sole (g)</td>
                                                                {{-- <td>{{ $currentStageData['midsole']['previous'] ?? '' }}</td> --}}
                                                                <td>{{ $currentStageData['midsole']['confirm'] ?? '' }}</td>
                                                                <td>{{ $currentStageData['midsole']['average'] ? number_format($currentStageData['midsole']['average'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['midsole']['min'] ? number_format($currentStageData['midsole']['min'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['midsole']['max'] ? number_format($currentStageData['midsole']['max'], 2) : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>7</td>
                                                                <td>Sockliner (g)</td>
                                                                {{-- <td>{{ $currentStageData['sockliner']['previous'] ?? '' }}</td> --}}
                                                                <td>{{ $currentStageData['sockliner']['confirm'] ?? '' }}</td>
                                                                <td>{{ $currentStageData['sockliner']['average'] ? number_format($currentStageData['sockliner']['average'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['sockliner']['min'] ? number_format($currentStageData['sockliner']['min'], 2) : '' }}</td>
                                                                <td>{{ $currentStageData['sockliner']['max'] ? number_format($currentStageData['sockliner']['max'], 2) : '' }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-4">
                                                    <table class="table table-bordered">
                                                        <thead class='table-dark'>
                                                            <tr>
                                                                <th>No</th>
                                                                <th>Part</th>
                                                                <th>L/R</th>
                                                                <th>Weight</th>
                                                                <th>Scan Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $i = 0 @endphp
                                                            @foreach($listLeftRight as $l)
                                                            @php $i++ @endphp
                                                                <tr>
                                                                    <td>{{($i)}}</td>
                                                                    <td>{{ $l->fullname }}</td>
                                                                    <td>{{ $l->position }}</td>
                                                                    <td>{{ $l->weight }}</td>
                                                                    <td>{{ $l->created_at }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            </div>
                                        
    
                                                {{-- Weight Tables --}}
                                               
                                                <hr>
    
                                                {{-- Image Section --}}
                                                <div class="row">
                                                    @foreach(['IMAGE_1', 'IMAGE_2', 'IMAGE_3', 'IMAGE_4'] as $view)
                                                        <div class="col-lg-3">
                                                            <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">
                                                                <div class="widget-content">
                                                                    <div class="widget-content-outer">
                                                                        <div class="widget-content-wrapper">
                                                                            <div class="widget-content-left pe-2 fsize-1">
                                                                                <img src="http://10.10.100.23/development/assets/foto_mcs/{{ empty($imagenya->$view) ? 'no_image_available.jpg' : $imagenya->$view }}" 
                                                                                alt="{{ $view }}" style="width: 220px; height: 220px; object-fit: cover;">
                                                                            </div>
                                                                        </div>
                                                                        <div class="widget-content-center fsize-1">
                                                                            <div class="text-muted text-center">{{ $view }}</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <hr>
    
                                                {{-- Chart Section --}}
                                                <div class="row">
                                                    <div class="tab-pane fade active show" id="tab-eg-55">
                                                        {{-- <div class="widget-chart p-3">
                                                            <div style="height: 350px">
                                                                <canvas id="line-chart-{{ $index }}" width="583" height="350"></canvas>
                                                            </div>
                                                        </div> --}}
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h3 class="card-title">Product Weight Trend</h3>
                                                            </div>
                                                            <div class="card-body">
                                                                <div id="weightTrendChart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('js')
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const weightData = @json($weightData);
            const stages = @json($availableStages);
            
            // Prepare series data
            const series = [
                {
                    name: 'Target',
                    data: stages.map(stage => weightData[stage]['brand_target']['previous'])
                },
                {
                    name: 'Assembly',
                    data: stages.map(stage => weightData[stage]['assembly']['previous'])
                },
                {
                    name: 'Upper',
                    data: stages.map(stage => weightData[stage]['upper']['previous'])
                },
                {
                    name: 'Sockliner',
                    data: stages.map(stage => weightData[stage]['sockliner']['previous'])
                },
                {
                    name: 'Stock Fit',
                    data: stages.map(stage => weightData[stage]['stockfit']['previous'])
                },
                {
                    name: 'Outsole',
                    data: stages.map(stage => weightData[stage]['outsole']['previous'])
                },
                {
                    name: 'Midsole',
                    data: stages.map(stage => weightData[stage]['midsole']['previous'])
                }
            ];

            const options = {
                series: series,
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: 2,
                    curve: 'straight'
                },
                colors: ['#2196F3', '#4CAF50', '#3F51B5', '#9C27B0', '#E91E63', '#FF9800', '#795548'],
                xaxis: {
                    categories: stages,
                    title: {
                        text: 'Stages'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Weight'
                    },
                    min: 0,
                    max: Math.max(...series.flatMap(s => s.data)) + 50,
                    tickAmount: 7
                },
                grid: {
                    borderColor: '#e7e7e7',
                    row: {
                        colors: ['#f3f3f3', 'transparent'],
                        opacity: 0.5
                    }
                },
                legend: {
                    show: true,
                    position: 'top',
                    horizontalAlign: 'center',
                    floating: false,
                    fontSize: '14px',
                    fontFamily: 'Helvetica, Arial',
                    offsetY: 0,
                    itemMargin: {
                        horizontal: 10,
                        vertical: 0
                    },
                    markers: {
                        width: 8,
                        height: 8,
                        radius: 12
                    }
                },
                markers: {
                    size: 4
                },
                // Menambahkan padding di bagian atas chart untuk memberi ruang pada legend
                chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    },
                    parentHeightOffset: 0,
                    marginTop: 20
                }
            };

            const chart = new ApexCharts(document.querySelector("#weightTrendChart"), options);
            chart.render();
        });
        $(document).ready(function() {
            new DataTable('#viewTable', {
                // destroy: true,
                retrieve: true,
                search: {
                        return: true
                    },  
                paging: true,
                processing: true,
                layout: {
                topStart: {
                        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                    }
                }
            });
        });
    </script>
@endsection