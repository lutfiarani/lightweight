<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
    <link rel="preload" href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css">
    {{-- <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="icon" href="{{ asset('images/lightweight_.png')}}">
    <script defer src="{{ asset('template/assets/scripts/main.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/demo.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/toastr.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/scrollbar.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/fullcalendar.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/maps.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/chart_js.js')}}"></script>
    
    <style>
                /* Mengatur tinggi container select2 */
        .select2-container .select2-selection--single {
            height: 35px !important; /* Sesuaikan dengan tinggi form input lainnya */
        }

        /* Mengatur posisi vertikal text di dalam select2 */
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 35px !important;
        }

        /* Mengatur posisi arrow/dropdown */
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }

        /* Mengatur border agar konsisten */
        .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da !important; /* Sesuaikan dengan border form input lainnya */
        }
    </style>
</head>
