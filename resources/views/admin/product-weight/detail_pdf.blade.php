<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Product Weight Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        
        .table th,
        .table td {
            border: 1px solid #dee2e6;
            padding: 0.5rem;
        }
        
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        
        .bg-danger {
            background-color: #dc3545;
            color: white;
        }

        .bg-secondary {
            background-color: #333131;
            color: white;
        }
        
        .col-md-12 {
            width: 100%;
        }
        
        .col-sm-8 {
            width: 66.666667%;
        }
        
        .col-sm-4 {
            width: 33.333333%;
        }
        
        .mb-3 {
            margin-bottom: 1rem;
        }
        
        .row {
            display: block;
            width: 100%;
            clear: both;
        }
        
        .text-center {
            text-align: center;
        }
        
        hr {
            margin: 1rem 0;
            border: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .page-break {
            page-break-after: always;
        }
       
    .image-row {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
        margin: 5px 0;
    }

    .image-container {
        /* width: 25%; Slightly less than 25% to account for spacing */
        text-align: center;
    }

    .image-card {
        border: 1px solid #ddd;
        padding: 10px;
        margin: 5px;
        background-color: white;
    }

    .image-wrapper img {
        width: 150px;  /* Adjusted size to fit PDF width */
        height: 150px;
        object-fit: cover;
    }

    .image-label {
        margin-top: 8px;
        color: #666;
        font-size: 12px;
    }
</style>
    </style>
</head>
<body>
    <h1>Product Weight Management - Detail</h1>
    
    <!-- Product Information Table -->
    <table class="table table-bordered">
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
    
    {{-- <div class="page-break"></div> --}}
    
    <!-- Weight Data Tables -->
    @foreach($availableStages as $index => $stage)
        <h2>{{ substr($stage, 0, -1) }}</h2>
        
        <!-- Status Table -->
        <div class="col-sm-12">
            <table class="table table-bordered align-center">
                <tr>
                    <th class="bg-secondary">Status</th>
                    <td>{{ $product->weight_status}}</td>
                    <th class="bg-secondary">Update Date</th>
                    <td> {{ $product->updated_at}} </td>
                    <th class="bg-secondary">L</th>
                    <td>{{ $countLeftRight[0][0] }}</td>
                    <th class="bg-secondary">R</th>
                    <td>{{ $countLeftRight[0][1] }}</td>
                </tr>
            </table>
            
            <div class="row">
                <div class="col">
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
                            @php
                                $currentStageData = $weightData[$stage] ?? null;    
                            @endphp
                            <tr>
                                <td>1</td>
                                <td class="bg-danger">Brand Target</td>
                                <td class="bg-danger">{{ $currentStageData['brand_target']['previous'] ?? '' }}</td>
                                <td class="bg-danger">{{ $currentStageData['brand_target']['confirm'] ?? '' }}</td>
                                <td class="bg-danger">{{ $currentStageData['brand_target']['average'] ? number_format($currentStageData['brand_target']['average'], 2) : '' }}</td>
                                <td class="bg-danger">{{ $currentStageData['brand_target']['min'] ? number_format($currentStageData['brand_target']['min'], 2) : '' }}</td>
                                <td class="bg-danger">{{ $currentStageData['brand_target']['max'] ? number_format($currentStageData['brand_target']['max'], 2) : '' }}</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Assembly (g)</td>
                                <td>{{ $currentStageData['assembly']['previous'] ?? '' }}</td>
                                <td>{{ $currentStageData['assembly']['confirm'] ?? '' }}</td>
                                <td>{{ $currentStageData['assembly']['average'] ? number_format($currentStageData['assembly']['average'], 2) : '' }}</td>
                                <td>{{ $currentStageData['assembly']['min'] ? number_format($currentStageData['assembly']['min'], 2) : '' }}</td>
                                <td>{{ $currentStageData['assembly']['max'] ? number_format($currentStageData['assembly']['max'], 2) : '' }}</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Upper (g)</td>
                                <td>{{ $currentStageData['upper']['previous'] ?? '' }}</td>
                                <td>{{ $currentStageData['upper']['confirm'] ?? '' }}</td>
                                <td>{{ $currentStageData['upper']['average'] ? number_format($currentStageData['upper']['average'], 2) : '' }}</td>
                                <td>{{ $currentStageData['upper']['min'] ? number_format($currentStageData['upper']['min'], 2) : '' }}</td>
                                <td>{{ $currentStageData['upper']['max'] ? number_format($currentStageData['upper']['max'], 2) : '' }}</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Stock Fit (g)</td>
                                <td>{{ $currentStageData['stockfit']['previous'] ?? '' }}</td>
                                <td>{{ $currentStageData['stockfit']['confirm'] ?? '' }}</td>
                                <td>{{ $currentStageData['stockfit']['average'] ? number_format($currentStageData['stockfit']['average'], 2) : '' }}</td>
                                <td>{{ $currentStageData['stockfit']['min'] ? number_format($currentStageData['stockfit']['min'], 2) : '' }}</td>
                                <td>{{ $currentStageData['stockfit']['max'] ? number_format($currentStageData['stockfit']['max'], 2) : '' }}</td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Outsole (g)</td>
                                <td>{{ $currentStageData['outsole']['previous'] ?? '' }}</td>
                                <td>{{ $currentStageData['outsole']['confirm'] ?? '' }}</td>
                                <td>{{ $currentStageData['outsole']['average'] ? number_format($currentStageData['outsole']['average'], 2) : '' }}</td>
                                <td>{{ $currentStageData['outsole']['min'] ? number_format($currentStageData['outsole']['min'], 2) : '' }}</td>
                                <td>{{ $currentStageData['outsole']['max'] ? number_format($currentStageData['outsole']['max'], 2) : '' }}</td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Mid Sole (g)</td>
                                <td>{{ $currentStageData['midsole']['previous'] ?? '' }}</td>
                                <td>{{ $currentStageData['midsole']['confirm'] ?? '' }}</td>
                                <td>{{ $currentStageData['midsole']['average'] ? number_format($currentStageData['midsole']['average'], 2) : '' }}</td>
                                <td>{{ $currentStageData['midsole']['min'] ? number_format($currentStageData['midsole']['min'], 2) : '' }}</td>
                                <td>{{ $currentStageData['midsole']['max'] ? number_format($currentStageData['midsole']['max'], 2) : '' }}</td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Sockliner (g)</td>
                                <td>{{ $currentStageData['sockliner']['previous'] ?? '' }}</td>
                                <td>{{ $currentStageData['sockliner']['confirm'] ?? '' }}</td>
                                <td>{{ $currentStageData['sockliner']['average'] ? number_format($currentStageData['sockliner']['average'], 2) : '' }}</td>
                                <td>{{ $currentStageData['sockliner']['min'] ? number_format($currentStageData['sockliner']['min'], 2) : '' }}</td>
                                <td>{{ $currentStageData['sockliner']['max'] ? number_format($currentStageData['sockliner']['max'], 2) : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="page-break"></div>
                <div class="col">
                    <table class="table table-bordered">
                        <thead class='table-dark'>
                            <tr>
                                <th class='bg-secondary text-white'>No</th>
                                <th class='bg-secondary text-white'>Part</th>
                                <th class='bg-secondary text-white'>L/R</th>
                                <th class='bg-secondary text-white'>Weight</th>
                                <th class='bg-secondary text-white'>Scan Date</th>
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
        
        {{-- <div class="image-row"> --}}
            <table style="width:100%" class="table table-bordered">
                <tr>
                    @foreach(['IMAGE_1', 'IMAGE_2', 'IMAGE_3', 'IMAGE_4'] as $view)
                    <td>
                        <div class="image-container">
                            <div class="image-card">
                                <div class="image-wrapper">
                                    <img src="{{ $images[$view] }}" 
                                        alt="{{ $view }}">
                                </div>
                                <div class="image-label">
                                    {{ $view }}
                                </div>
                            </div>
                        </div>
                    </td>
                        
                    
                        @endforeach
                </tr>
            </table>
               
            
            
        {{-- </div> --}}
    @endforeach
</body>
</html>