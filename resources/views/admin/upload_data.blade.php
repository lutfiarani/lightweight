@extends('template.__body')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"/>
<style>
    .table-container {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
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
<div class="app-main__inner" style="width:175vh">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-upload icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Product Weight Management - Upload Data</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('master.import') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Upload Excel File</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".xlsx,.xls">
                            @error('file')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Import Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="mb-0 table table-bordered table-sm nowrap" id="myTable" style="font-size:80%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Development Center</th>
                                    <th>Season</th>
                                    <th>Model Name</th>
                                    <th>Model Number</th>
                                    <th>Article</th>
                                    <th>Development Type</th>
                                    <th>Weight Status</th>
                                    <th>Stage</th>
                                    <th>Target</th>
                                    <th>AS</th>
                                    <th>UP</th>
                                    <th>SF</th>
                                    <th>OS</th>
                                    <th>MS</th>
                                    <th>Sockliner</th>
                                    <th>Article Status</th>
                                    <th>Sports Category</th>
                                    <th>Business Segment</th>
                                    <th>Gender</th>
                                    <th>Age Group</th>
                                    <th>Sample Size</th>
                                    <th>Article Latest</th>
                                    <th>Article Master</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $index => $product)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $product->development_center }}</td>
                                        <td>{{ $product->season }}</td>
                                        <td>{{ $product->model_name }}</td>
                                        <td>{{ $product->model_number }}</td>
                                        <td>{{ $product->article }}</td>
                                        <td>{{ $product->development_type }}</td>
                                        <td>{{ $product->weight_status }}</td>
                                        <td>{{ $product->stage }}</td>
                                        <td>{{ $product->target }}</td>
                                        <td>{{ $product->AS }}</td>
                                        <td>{{ $product->UP }}</td>
                                        <td>{{ $product->SF }}</td>
                                        <td>{{ $product->OS }}</td>
                                        <td>{{ $product->MS }}</td>
                                        <td>{{ $product->sockliner }}</td>
                                        <td>{{ $product->article_status }}</td>
                                        <td>{{ $product->sports_category }}</td>
                                        <td>{{ $product->business_segment }}</td>
                                        <td>{{ $product->gender }}</td>
                                        <td>{{ $product->age_group }}</td>
                                        <td>{{ $product->sample_size }}</td>
                                        <td>{{ $product->article_latest }}</td>
                                        <td>{{ $product->article_master }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
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
            new DataTable('#myTable', {
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