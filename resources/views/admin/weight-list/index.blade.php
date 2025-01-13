@extends('template.__body')
@section('title', 'Weight List Detail')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"/>
<link href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css" rel="stylesheet">
<style>
    .table-container {
        overflow-x: auto;
    }
    .collapsed {
        display: none;
    }
    .expand-button {
        cursor: pointer;
    }
    .weight-value {
        color: blue;
    }
    .weight-value.warning {
        color: red;
    }

    .container{
        font-size: 85%;
    }

    table{
        font-size: 85%;
        
    }
    .collapsed {
        display: none;
    }

    .po-group {
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .expand-button {
        margin-right: 10px;
        cursor: pointer;
    }

    .warning {
        background-color: #ffeb3b;
    }
</style>

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header"><h3>Weight List Detail</h3></div>
        <div class="card-body">
            <div class="filters">
                <div class="row">
                    <input type="text" name="percentage" id="percentage" value="{{ $getPercentage->perc_value }}" hidden>
                    <div class="col">
                        <label>Date:</label>
                        <input type="date" id="start_date" class="form-control">
                    </div>
                    <div class="col">
                        <label>&nbsp</label>
                        <input type="date" id="end_date" class="form-control">
                    </div>
                    <div class="col">
                        <label>Factory:</label>
                        <select id="factory" name="factory" class="form-select">
                        </select>
                    </div>
                    <div class="col">
                        <label>Cell:</label>
                        <select name="cell" id="cell" class="form-select"></select>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <label>PO:</label>
                        <input type="text" id="po_no" class="form-control">
                    </div>
                    <div class="col">
                        <label>Model:</label>
                        <select name="model" id="model" class="form-select select2"></select>
                        
                    </div>
                    <div class="col">
                        <label>Article:</label>
                        <select name="article" id="article" class="form-select"></select>
                    </div>
                    <div class="col">
                        <br>
                        <input type="checkbox" id="group_po" checked>
                        <label>Group PO & Size</label>
                    </div>
                    <div class="col">
                        <br>
                        <button id="search" class="btn btn-primary">Search</button>
                        <button id="export" class="btn btn-success">Export Excel</button>
                    </div>
                </div>
                <div class="row mt-2">
                   
                </div>
            </div>
        </div>
    
    
    
    <div class="card-body">
        <div class="table-container mt-4">
            <table class="table table-bordered table-sm" style="font-size:90%" id="table_detail">
                <thead>
                    <tr>
                        <th>Factory</th>
                        <th>Line</th>
                        <th>Season</th>
                        <th>PO</th>
                        <th>Model</th>
                        <th>Article</th>
                        <th>Size</th>
                        <th>Size Qty</th>
                        <th>Process</th>
                        <th>Target Count</th>
                        <th>Target Weight</th>
                        <th>Actual Weight</th>
                        <th>Weight Time</th>
                        <th>Weight By</th>
                       
                    </tr>
                </thead>
                <tbody id="weight-list-body" style="white-space:nowrap;">
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
@endsection

<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js"></script>
<script src="{{asset('js/lightweight.js')}}" type="text/javascript"></script>

<script>
     $(document).ready(function() {
        const fac   = $('#factory').val()
        const model = $('#model').val()
        
        factory()
        cell(fac)
        listModel()
        article(model)
        new DataTable('#table_detail', {
            // destroy: true,
            retrieve: true,
            search: {
                    return: true
                },  
            paging: false,
            processing: true,
            layout: {
            topStart: {
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
                }
            }
        });

        $(document).on('change', '#factory', function(){
            const fac = $(this).val()
            cell(fac)
        })

        $(document).on('change', '#model', function(){
            const model = $(this).val()
            article(model)
        })
    })


</script>