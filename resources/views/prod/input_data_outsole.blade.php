@extends('template.__body')
@section('title', 'Outsole')

@section('content')
<style>
    /* Gaya untuk dropdown hasil */
    #suggestions {
      border: 1px solid #ccc;
      max-height: 150px;
      overflow-y: auto;
      position: absolute;
      background: #fff;
      z-index: 1000;
      display: none;
      width: 300px;
    }

    #suggestions div {
      padding: 8px;
      cursor: pointer;
    }

    #suggestions div:hover {
      background: #f0f0f0;
    }
  </style>

<div class="app-main__inner">
    <div class="app-page-title" style="margin-bottom: 0.5rem; padding-left:1.5rem; padding-top:0.5rem; padding-bottom:0.5rem">
        <div class="page-title-wrapper">
            <label  style="font-size:1rem; font-weight:800" id="fullname">{{ mb_convert_case(Auth::user()->fullname, MB_CASE_TITLE, "UTF-8"); }} </label>
        </div>
    </div>
    <!-- <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="metismenu-icon pe-7s-eyedropper">
                    </i>
                </div>
                <div>{{ $judul }}
                    <div class="page-title-subheading">{{ $subJudul }}
                    </div>
                </div>
            </div>    
        </div>
    </div> -->
    
    <div class="row" style="margin:2px; background-color:white; border-radius:0.375rem; padding-top :10px; padding-left:10px; padding-right:10px" >
        <!-- <div class="col-xl-2" style="padding:0px; ">
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">PO No
                <select id="po_no" style="width:100%">

                </select>
            </div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Model<h5 class="card-title" ><input type="text" class="form-control form-control-xs" id="model_name" readonly> </h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Article<input type="text" class="form-control h-25" id="article" readonly></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">PO Qty<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="po_qty" readonly></h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Destination<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="destination" readonly></h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">CRD<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="crd" readonly></h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Season<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="season" readonly></h5></div>
        </div> -->
        <div class="col-xl-6">
            <div class="row" style="margin:0px">
                <div class="col-md-6" style="padding:2px">
                    <div class="row" style="margin-bottom:7px">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="exampleEmail11" class="form-label"><b>Model Name</b></label>
                                <select name="model_name" id="model_name" placeholder="Model Name" type="text" class="form-control" style="width:100%"></select>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative ">
                        <label for="exampleEmail11" class="form-label"><b>Basic Define</b></label>
                    </div>
                    
                    <div id="midas_data"></div>
                    
                </div>
                <div class="col-md-6" style="padding:2px">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="position-relative mb-3">
                                <label for="exampleEmail11" class="form-label"><b>Size</b></label>
                                <input name="size" id="size"  placeholder="Size" type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative ">
                        <label for="exampleEmail11" class="form-label"><b>Production Weight Result</b></label>
                    </div>
                    <div id="tampil_data_result"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6"  style="padding:2px">
            <form class="row">
                <div class="col-sm-4">
                    <div class="position-relative mb-3">
                        <label for="exampleEmail11" class="form-label"><b>Position </b></label>
                        <select class="form-control" name="posisi" id="posisi">
                            <option value="L">Left</option>
                            <option value="R">Right</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="position-relative mb-3">
                        <label for="exampleEmail11" class="form-label"><b>Weight </b></label>
                        <input type="text" class="form-control" id="haha" readonly>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="position-relative mb-3">
                        <button type="button" class="btn btn-primary mb-3" style="margin-top:1.5rem" name="button_save" id="button_save">Save Data</button>
                    </div>
                </div>
            </form>
            <table class="table table-bordered data-table" style="font-size:11px">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Model Name</th>
                        <th>Weight</th>
                        <th>Position</th>
                        <th>Time</th>
                        <th>Name</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection


@section('js')
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script defer src="{{ asset('template/assets/scripts/main.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/demo.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/toastr.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/scrollbar.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/fullcalendar.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/maps.js')}}"></script>
    <script defer src="{{ asset('template/assets/scripts/chart_js.js')}}"></script>

    <!-- <script defer src="{{ asset('template/assets/scripts/toastr.js')}}"></script> -->

    
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {


            // $('#mySelect').select2();
            $('#model_name').select2({
                placeholder: 'Search Model Name...',
                minimumInputLength: 4, // Mulai pencarian setelah mengetik 1 karakter
                ajax: {
                    url: "{{ route('search_model_name') }}", // Ganti dengan URL endpoint API Anda
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                        term: params.term // Kirim input pengguna ke server
                        };
                    },
                    processResults: function (data) {
                        return {
                        results: data // Data yang diterima dari server
                        };
                    },
                    cache: true
                }
                
            });


            $(document).on("click",".delete_log",function() {
                if (confirm("Are you sure?")) {
                    var id_log = $(this).attr('data-id')
                    delete_log(id_log)
                }
                return false;
                
            })

            function delete_log(id_log){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"post",
                    url:"{{ url('/prod/delete_data_log') }}",
                    data:{id_log:id_log},
                    success: function(hasil){
                        alert(hasil.message)
                        destroy_tampil_data()
                        get_datatables()
                        var model_name = $('#model_name').val()
                        get_data_result_outsole(model_name)
                    }
                })
            }


            function get_datatables(){
                var table = $('.data-table').DataTable({
                    createdRow: function (row, data, dataIndex) {
                        $(row).css('font-size', '11px'); // Change font size of rows
                    },
                    dom: 't',
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('get_data_log') }}",
                    columns: [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                        {data: 'model_name', name: 'model_name' , orderable: false, searchable: false},
                        {data: 'weight', name: 'weight' , orderable: false, searchable: false},
                        {data: 'position', name: 'position', orderable: false, searchable: false},
                        {data: 'timetime', name: 'timetime', orderable: false, searchable: false},
                        {data: 'fullname', name: 'fullname' , orderable: false, searchable: false},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });
            }

            function destroy_tampil_data(){
                $(".data-table").dataTable().fnDestroy();
            }

            // load awal

            var model_name = $('#model_name').val()
            get_datatables()
            get_data_result_outsole(model_name)
            cek_posisi()


            function get_data_result_outsole(model_name){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"post",
                    url:"{{ url('/prod/view_data_result_outsole') }}",
                    data:{model_name:model_name},
                    success: function(hasil){
                        console.log(hasil)
                        // var target_qty = $('#target_qty').val()

                        var midas_data = ''
                        for (let index = 0; index < hasil.length; index++) {
                            midas_data += '<div class="card mb-1 widget-content bg-midnight-bloom" style="padding-left:0.7rem; padding-right:0.7rem; padding-top:0.3rem; padding-bottom:0.3rem">'
                            midas_data += '    <div class="widget-content-wrapper text-white">'
                            midas_data += '        <div class="widget-content-left">'
                            midas_data += '            <div class="widget-heading text-white"><h5>'+hasil[index].full_process_name+'</h5></div>'
                            midas_data += '            <div class="widget-numbers text-white" style="float:left" ><i class="fa-light fa-boot fa-1x"></i></div>'
                            midas_data += '        </div>'
                            midas_data += '        <div class="widget-content-right">'
                            midas_data += '            <div class="widget-numbers text-white" style="font-size:1.2rem" ><span >'+(hasil[index].min_standard == ".00" ? "0.00" : hasil[index].min_standard)+' - '+ (hasil[index].max_standard == ".00" ? "0.00" :hasil[index].max_standard)+'</span></div>'
                            midas_data += '            <div class="widget-numbers text-white" style="float:right" ><span >'+(hasil[index].standard == ".00" ? "0.00" : hasil[index].standard)+'g</span></div>'
                            midas_data += '        </div>'
                            midas_data += '    </div>'
                            midas_data += '</div>'
                        }

                        var tampil_data = ''
                        for (let index = 0; index < hasil.length; index++) {
                            tampil_data += '<div class="card mb-1 widget-content bg-success" style="padding-left:0.7rem; padding-right:0.7rem; padding-top:0.3rem; padding-bottom:0.3rem">'
                            tampil_data += '    <div class="widget-content-wrapper text-white">'
                            tampil_data += '        <div class="widget-content-left">'
                            // tampil_data += '            <div class="widget-heading text-white"><h6>Target : <span class="target_qty"></span>pcs</h6></div>'
                            tampil_data += '            <div class="widget-numbers text-white" style="float:left" ><span >'+hasil[index].jumlah_qty+'</span><span> Pcs</span></div>'
                            tampil_data += '        </div>'
                            tampil_data += '        <div class="widget-content-right">'
                            tampil_data += '            <div class="widget-numbers text-white" style="font-size:1.2rem" ><span >'+(hasil[index].min_rata_rata == ".00" ? "0.00" : hasil[index].min_rata_rata)+' - '+ (hasil[index].max_rata_rata == ".00" ? "0.00" :hasil[index].max_rata_rata)+'</span></div>'
                            tampil_data += '            <div class="widget-numbers text-white" style="float:right" ><span >'+(hasil[index].rata_rata == ".00" ? "0.00" : hasil[index].rata_rata)+'g</span></div>'
                            tampil_data += '        </div>'
                            tampil_data += '    </div>'
                            tampil_data += '</div>'
                        }
                        $('#midas_data').html(midas_data)
                        $('#tampil_data_result').html(tampil_data)
                    }
                });
            }


            

            $('#model_name').change(function (event) {
                // if (event.key === 'Enter' || event.keyCode === 13) {
                    const model_name = $(this).val();
                    get_data_model_name(model_name)
                    get_data_result_outsole(model_name)
                    sessionStorage.setItem('model_model', model_name)
                    // console.log('okeokoe')
                    
                // }
            });

            // button untuk menyimpan data
            $('#button_save').click(function(){
                var model_name  = $('#model_name').val()
                var size        = $('#size').val()
                var posisi      = $('#posisi').val()

                var weight      = $('#haha').val()

                if(
                    model_name == null ||
                    model_name == '' ||
                    size == null ||
                    size == '' ||
                    posisi == null ||
                    posisi == '' ||
                    weight == null ||
                    weight == ''
                ){
                    alert('Please Fill All Form')
                }else{
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type:"POST",
                        url:"{{ route('saving_data_outsole') }}",
                        data    : {
                            model_name:model_name,
                            size:size,
                            posisi:posisi,
                            weight:weight,
                        },
                        success: function(hasil){
                            alert(hasil.message)
                            destroy_tampil_data()
                            get_datatables()
                            localStorage.setItem('posisi', hasil.next_posisi);
                            cek_posisi()
                            var model_name = sessionStorage.getItem('model_model')
                            get_data_result_outsole(model_name)
                            $('#haha').val('')
                        }
                    });
                }
            })


            function cek_posisi(){
                var posisi = localStorage.getItem('posisi');
                if(posisi == null || posisi == ''){
                    var posisi_baru = 'L';
                }else{
                    var posisi_baru = posisi;
                }
                // console.log(posisi)
                $('#posisi').val(posisi_baru)
            }


            function get_data_model_name(model_name){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"post",
                    url:"{{ route('get_model_name') }}",
                    data:{model_name:model_name},
                    success: function(hasil){
                        // console.log(hasil)
                        $('#size').val(hasil.sample_size)
                    }
                });
            }


            const outputDiv = document.getElementById('output');
            const connectedValue = outputDiv.textContent.trim();
            console.log(localStorage.getItem('preferredPort')); 
            
            if(localStorage.getItem('preferredPort') == null){
                disconnect_button()
            }else{
                connect_button()
            }
            
            function connect_button(){
                $('#disconnectButton').show();
                $('#connectButton').hide();
            }

            function disconnect_button(){
                $('#disconnectButton').hide();
                $('#connectButton').show();
            }
            
            let port, reader, isReading = false;

            $('#connectButton').click(async function () {
                try {
                    if (!port) {
                        port = await navigator.serial.requestPort();
                        const portInfo = port.getInfo();
                        localStorage.setItem('preferredPort', JSON.stringify(portInfo));
                    }
                    await port.open({ baudRate: 9600 });
                    console.log('Connected:', localStorage.getItem('preferredPort'));

                    $('#output').html('<span class="btn btn-success">Connected</span>');
                    
                    $('#disconnectButton').show();
                    $('#connectButton').hide();

                    const textDecoder = new TextDecoderStream();
                    const readableStreamClosed = port.readable.pipeTo(textDecoder.writable);
                    reader = textDecoder.readable.getReader();

                    // Mulai membaca data
                    startReading();
                } catch (error) {
                    console.error('Connection error:', error);
                    $('#output').html(`<span class="btn btn-danger">${error.message}</span>`);
                }
            });

            $('#disconnectButton').click(async function () {
                try {
                    // Step 1: Stop reading if the reader is active
                    if (isReading) {
                        isReading = false; // Stop the reading loop
                        await reader.cancel(); // Stop the reader from reading
                        reader.releaseLock();  // Release the lock on the readable stream
                        reader = null; // Nullify the reader to avoid using it again
                    }

                    // Step 2: Cancel the readable stream if it's still active
                    if (port) {
                        if (port.readable) {
                            try {
                                await new Promise(resolve => setTimeout(resolve, 50));
                                await port.readable.cancel(); // Cancel the readable stream if active
                                
                                console.log('oke')
                            } catch (error) {
                                console.warn('Stream cancellation error:', error);
                            }
                        }

                        // Step 3: Now that the stream is canceled and lock is released, close the port
                        await port.close(); // Close the port
                        port = null; // Nullify the port to avoid using it again
                        // Step 4: Remove the saved preferred port info from localStorage
                        
                        
                    }

                    localStorage.removeItem('preferredPort');
                    console.log(localStorage.getItem('preferredPort')); // Should log null after removal

                    // Update the UI
                    $('#output').html('<span class="btn btn-danger">Not Connected</span>');
                    $('#disconnectButton').hide();
                    $('#connectButton').show();
                } catch (error) {
                    console.error('Disconnection error:', error);
                    $('#output').append(`<p>Error: ${error.message}</p>`);
                }

            });

            async function startReading() {
                try {
                    isReading = true; // Tandai pembacaan dimulai
                    while (isReading) {
                        const { value, done } = await reader.read();
                        if (done || !isReading) break; // Hentikan jika stream selesai atau dihentikan
                        const match = value.match(/[\d.]+(?=g)/);
                        $('#haha').val(match);
                    }
                } catch (error) {
                    console.error('Error while reading:', error);
                }
            }

        })
    </script>
    
    <script>
        $(document).ready(async function () {
            let port, reader;

            async function connectToPreferredPort() {
                try {
                    const savedPortInfo = JSON.parse(localStorage.getItem('preferredPort'));
                    console.log(savedPortInfo);

                    if (savedPortInfo) {
                        const ports = await navigator.serial.getPorts();
                        port = ports.find(p => {
                            const info = p.getInfo();
                            return info.usbVendorId === savedPortInfo.usbVendorId && info.usbProductId === savedPortInfo.usbProductId;
                        });
                    }

                    if (port) {
                        // Cek apakah port dalam keadaan terbuka
                        if (port.readable) {
                            console.warn('Port is already open. Closing it before reopening...');
                            await port.close();
                        }

                        // Buka port dengan retry mechanism
                        await tryOpenPort(port);

                        $('#output').html('<span class="btn btn-success">Connected</span>');
                        $('#disconnectButton').show();
                        $('#connectButton').hide();

                        const textDecoder = new TextDecoderStream();
                        const readableStreamClosed = port.readable.pipeTo(textDecoder.writable);
                        reader = textDecoder.readable.getReader();

                        while (true) {
                            const { value, done } = await reader.read();
                            if (done) break;
                            const match = value.match(/[\d.]+(?=g)/);
                            $('#haha').val(match);
                        }
                    } else {
                        $('#output').html('<span class="btn btn-danger">Not Connected</span>');
                    }
                } catch (error) {
                    console.error('Error connecting to preferred port:', error);
                }
            }

            // Menutup port saat halaman dimuat ulang
            window.addEventListener('beforeunload', async () => {
                if (port) {
                    try {
                        if (reader) {
                            reader.releaseLock();
                        }
                        await port.close();
                        console.log('Port closed before page unload.');
                    } catch (error) {
                        console.error('Error closing port on unload:', error);
                    }
                }
            });

            await connectToPreferredPort();
        });

        async function tryOpenPort(port, retries = 3, delay = 500) {
            for (let i = 0; i < retries; i++) {
                try {
                    await port.open({ baudRate: 9600 });
                    console.log('Port successfully opened.');
                    return;
                } catch (error) {
                    console.warn(`Attempt ${i + 1} to open port failed. Retrying...`);
                    await new Promise(resolve => setTimeout(resolve, delay));
                }
            }
            throw new Error('Failed to open port after multiple retries.');
        }


    </script>
@endsection