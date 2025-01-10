@extends('template.__body')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"/>
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
                                        <li class="nav-item" role="presentation"><a data-bs-toggle="tab" href="#tab-eg7-0" class="active nav-link" aria-selected="true" role="tab">CR0</a></li>
                                        <li class="nav-item" role="presentation"><a data-bs-toggle="tab" href="#tab-eg7-1" class="nav-link" aria-selected="false" tabindex="-1" role="tab">CR1</a></li>
                                        <li class="nav-item" role="presentation"><a data-bs-toggle="tab" href="#tab-eg7-2" class="nav-link" aria-selected="false" tabindex="-1" role="tab">CR2</a></li>
                                        <li class="nav-item" role="presentation"><a data-bs-toggle="tab" href="#tab-eg7-2" class="nav-link" aria-selected="false" tabindex="-1" role="tab">PRESELL</a></li>
                                        <li class="nav-item" role="presentation"><a data-bs-toggle="tab" href="#tab-eg7-2" class="nav-link" aria-selected="false" tabindex="-1" role="tab">SMS</a></li>
                                        <li class="nav-item" role="presentation"><a data-bs-toggle="tab" href="#tab-eg7-2" class="nav-link" aria-selected="false" tabindex="-1" role="tab">MCS</a></li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" >
                                        <div class="tab-pane active" id="tab-eg7-0" role="tabpanel">
                                        <table class="table table-bordered align-center">
                                                <th>Status</th>
                                                <td>Confirmed</td>
                                                <th>Update Date</th>
                                                <td>{{ $product->updated_at }}</td>
                                                <th>L</th>
                                                <td>0</td>
                                                <th>R</th>
                                                <td>0</td>
                                            </tr>
                                        </table>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Part Name</th>
                                                            <th>Previous Stage Weight</th>
                                                            <th>Confirm Weight</th>
                                                            <th>Average Weight</th>
                                                            <th>Min Weight</th>
                                                            <th>Max Weight</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Brand Target</td>
                                                            <td>280.0</td>
                                                            <td>100.0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>2</td>
                                                            <td>Assembly (g)</td>
                                                            <td>50.0</td>
                                                            <td>50.0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Upper (g)</td>
                                                            <td>50.0</td>
                                                            <td>50.0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Stock Fit (g)</td>
                                                            <td>50.0</td>
                                                            <td>50.0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>5</td>
                                                            <td>Outsole (g)</td>
                                                            <td>50.0</td>
                                                            <td>50.0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>6</td>
                                                            <td>Mid Sole (g)</td>
                                                            <td>50.0</td>
                                                            <td>50.0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <tr>
                                                            <td>7</td>
                                                            <td>Sockliner (g)</td>
                                                            <td>50.0</td>
                                                            <td>50.0</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-4">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Part</th>
                                                            <th>L/R</th>
                                                            <th>Weight</th>
                                                            <th>Scan Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @for($i=0; $i<7; $i++)
                                                            <tr>
                                                                <td>&nbsp</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                            </tr>
                                                        @endfor
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <hr>
                                        
                                        <div class="row">
                                            <div class=" col-lg-2">
                                                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left pe-2 fsize-1">
                                                                    <img src="http://10.10.100.23/development/assets/foto_mcs/file_gambar_1_1727658445_66f9f9cd1aff6.jpg" alt="" width="125px">
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="widget-content-center fsize-1">
                                                                <div class="text-muted text-center">LATERAL</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-2">
                                                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left pe-2 fsize-1">
                                                                    <img src="http://10.10.100.23/development/assets/foto_mcs/file_gambar_1_1727658445_66f9f9cd1aff6.jpg" alt="" width="125px">
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="widget-content-center fsize-1">
                                                                <div class="text-muted text-center">HEEL</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-2">
                                                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left pe-2 fsize-1">
                                                                    <img src="http://10.10.100.23/development/assets/foto_mcs/file_gambar_1_1727658445_66f9f9cd1aff6.jpg" alt="" width="125px">
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="widget-content-center fsize-1">
                                                                <div class="text-muted text-center">MEDIAL</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-2">
                                                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left pe-2 fsize-1">
                                                                    <img src="http://10.10.100.23/development/assets/foto_mcs/file_gambar_1_1727658445_66f9f9cd1aff6.jpg" alt="" width="125px">
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="widget-content-center fsize-1">
                                                                <div class="text-muted text-center">TOP</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-2">
                                                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left pe-2 fsize-1">
                                                                    <img src="http://10.10.100.23/development/assets/foto_mcs/file_gambar_1_1727658445_66f9f9cd1aff6.jpg" alt="" width="125px">
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="widget-content-center fsize-1">
                                                                <div class="text-muted text-center">BOTTOM</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-lg-2">
                                                <div class="card-shadow-danger mb-3 widget-chart widget-chart2 text-start card">
                                                    <div class="widget-content">
                                                        <div class="widget-content-outer">
                                                            <div class="widget-content-wrapper">
                                                                <div class="widget-content-left pe-2 fsize-1">
                                                                    <img src="http://10.10.100.23/development/assets/foto_mcs/file_gambar_1_1727658445_66f9f9cd1aff6.jpg" alt="" width="125px">
                                                                </div>
                                                               
                                                            </div>
                                                            <div class="widget-content-center fsize-1">
                                                                <div class="text-muted text-center">TOE</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="tab-pane fade active show" id="tab-eg-55">
                                                <div class="widget-chart p-3">
                                                    <div style="height: 350px">
                                                        <canvas id="line-chart" width="583" height="350" style="display: block; box-sizing: border-box; height: 350px; width: 583px;"></canvas>
                                                    </div>
                                                    <div class="widget-chart-content text-center mt-5">
                                                        <div class="widget-description mt-0 text-warning">
                                                            <i class="fa fa-arrow-left"></i>
                                                            <span class="ps-1">175.5%</span>
                                                            <span class="text-muted opacity-8 ps-1">increased server resources</span>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        </div>
                                        
                                        
                                        </div>
                                        <div class="tab-pane" id="tab-eg7-1" role="tabpanel"><p>Like Aldus PageMaker including versions of Lorem. It has survived not only five centuries, but also the leap into electronic typesetting, remaining
                                            essentially unchanged. </p></div>
                                        <div class="tab-pane" id="tab-eg7-2" role="tabpanel"><p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a
                                            type specimen book. It has
                                            survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. </p></div>
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
    
    <script>
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