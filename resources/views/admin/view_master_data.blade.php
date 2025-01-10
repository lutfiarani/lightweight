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
<div class="app-main__inner"  style="width:175vh">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-box2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>Product Weight Management
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
                    <th colspan="2"><select name="dc" class="form-select" id="development-center"><option>Pilih option..</option></select></th>
                    <th>Season</th>
                    <th><select name="season" class="form-select" id="season"><option>Pilih option..</option></select></th>
                    {{-- <th>1st ex Factory Date(A)</th>
                    <th><input type="date" class="form-control-sm form-control"  name="" id=""/></th>
                    <th> <input type="date" class="mb-2 form-control-sm form-control"  name="" id="" /></th> --}}
                </tr>
                <tr>
                    <th>Development Type (A)</th>
                    <th><select name="development_type" class="form-select" id="development-type"><option>Pilih option..</option></select></th>
                    <th>Model Name</th>
                    <th colspan="2"> <select name="model-name" id="model-name" class="form-select"></select></th>
                    {{-- <th>Leading Buy Ready</th>
                    <th><input type="date" class="form-control-sm form-control"  name="" id=""/></th>
                    <th><input type="date" class="form-control-sm form-control"  name="" id="" /></th> --}}
                </tr>
                <tr>
                    <th>Stage</th>
                    <th><select name="stage" class="form-select" id="stage"><option>Pilih option..</option></select></th>
                    <th>Model Number (M)</th>
                    <th colspan="2"><select name="model_number" class="form-select" id="model-number"><option>Pilih option..</option></select></th>
                    {{-- <th>Actual Buy Ready</th>
                    <th><input type="date" class="form-control-sm form-control"  name="" id=""/></th>
                    <th> <input type="date" class="mb-2 form-control-sm form-control"  name="" id=""/></th> --}}
                </tr>
                <tr>
                    <th>Article Status(A)</th>
                    <th><select name="article_status" class="form-select" id="article-status"><option>Pilih option..</option></select></th>
                    <th>Article Number(A)</th>
                    <th colspan="2"><select name="article_number" class="form-select" id="article-number"><option>Pilih option..</option></select></th>
                    {{-- <th>Article Number (A)</th>
                    <th colspan="2"> <input type="text" class="form-control-sm form-control" name="" id=""></th> --}}
                    
                </tr>
                <tr>
                    <th colspan="8"><button class="btn btn-primary" id="searchData">Search</button></th>
                </tr>                
            </table>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3 card">
                <div class="card-body">
                    <div class="table-responsive" id="search-results">
                    
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
    <script src="{{asset('js/lightweight.js')}}" type="text/javascript"></script>
    
    <script>
        function searchData(){
            const token = $('meta[name="csrf-token"]').attr('content');
            const searchData = {
                development_center: $('#development-center').val(),
                season: $('#season').val(),
                development_type: $('#development-type').val(),
                model_name: $('#model-name').val(),
                model_number: $('#model-number').val(),
                article_status: $('#article-status').val(),
                article_number: $('#article-number').val(),
                stage: $('#stage').val(),
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            const searchButton = $('#searchData'); // Assuming you have a search button
            const originalButtonText = searchButton.text();
            searchButton.prop('disabled', true).text('Searching...');

            $.ajax({
                url: '{{ route("searchData") }}', // URL to send the request to
                method : "POST",
                data: searchData,
                dataType: 'json',
                success: function(response){
                    console.log(response);
                    // console_log(searchData);
                    if(response.status == 'success'){
                        displaySearchResults(response.data)
                    }else{
                        alert('Error');
                    }
                },
                error: function(xhr, status, error){
                    console.error('Error performing search:', error);
                    alert('An error occured while seaching');
                }

            })
            searchButton.prop('disabled', false).text(originalButtonText);
        }

        function displaySearchResults(results){
            const resultsContainer = $('#search-results');
            resultsContainer.empty();

            if(results.length === 0){
                resultsContainer.append('No results found');
                return;
            }

            let html = `
                        <table class="mb-0 table table-bordered table-sm nowrap" id="viewTable" style="font-size:80%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Development center</th>
                                    <th>Season</th>
                                    <th>Model name</th>
                                    <th>Model Number</th>
                                    <th>Article Number</th>
                                    <th>developmentr type</th>
                                    <th>weight status</th>
                                    <th>Stage</th>
                                    <th>target</th>
                                    <th>AS</th>
                                    <th>UP</th>
                                    <th>SF</th>
                                    <th>OS</th>
                                    <th>MS</th>
                                    <th>Sockliner</th>
                                    <th>AS Actual</th>
                                    <th>UP Actual</th>
                                    <th>SF Actual</th>
                                    <th>OS Actual</th>
                                    <th>MS Actual</th>
                                    <th>Article Status</th>
                                    <th>Sports Category</th>
                                    <th>Business Segment</th>
                                    <th>Gender</th>
                                    <th>Age Group</th>
                                    <th>Sample Size</th>
                                    <th>Prod Factory</th>
                                    <th>Article Lastest Key</th>
                                    <th>Article Master No</th>
                                </tr>
                            </thead>
                        <tbody>
            `;

            results.forEach((product, index)=>{
                html += `
                     <tr class="data_master" data-id="${product.article}" style="cursor: pointer;">
                        <td>${index + 1}</td>
                        <td>${product.development_center || ''}</td>
                        <td>${product.season || ''}</td>
                        <td>${product.model_name || ''}</td>
                        <td>${product.model_number || ''}</td>
                        <td>${product.article || ''}</td>
                        <td>${product.development_type || ''}</td>
                        <td>${product.weight_status || ''}</td>
                        <td>${product.stage || ''}</td>
                        <td>${product.target || ''}</td>
                        <td>${product.AS || ''}</td>
                        <td>${product.UP || ''}</td>
                        <td>${product.SF || ''}</td>
                        <td>${product.OS || ''}</td>
                        <td>${product.MS || ''}</td>
                        <td>${product.sockliner || ''}</td>
                        <td>0.01</td>
                        <td>0.01</td>
                        <td>0.01</td>
                        <td>0.01</td>
                        <td>0.01</td>
                        <td>${product.article_status || ''}</td>
                        <td>${product.sports_category || ''}</td>
                        <td>${product.business_segment || ''}</td>
                        <td>${product.gender || ''}</td>
                        <td>${product.age_group || ''}</td>
                        <td>${product.sample_size || ''}</td>
                        <td>HWI</td>
                        <td>${product.article_latest || ''}</td>
                        <td>${product.article_master || ''}</td>
                    </tr> `;
            });
            html += `</tbody></table>`;

            resultsContainer.html(html);

            if($.fn.DataTable){
                $('#viewTable').DataTable({
                    scrollX : true,
                    scrollY: '50vh',
                    scrollCollapse: true,
                    paging: true, 
                    searching: true, 
                    ordering: true
                })
            }
        }

        function formatValue(value){
            return value || '';
        }

        $(document).ready(function() {
            list_search()
            searchData()
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

            $(document).on('click', '.data_master', function(){
                const id = $(this).data('id');
                window.location.href = "{{ route('product.detail', ':id') }}".replace(':id', id);
            });

            $(document).on('click', '#searchData', function(){
                searchData()
            })
        });
    </script>
@endsection