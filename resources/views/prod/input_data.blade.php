@extends('template.__body')

@section('content')
<div class="app-main__inner">
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
        <div class="col-xl-2" style="padding:0px; ">
            <!-- <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Model<h5 class="card-title">VL COURT 3.0</h5></div> -->
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">PO No<h5 class="card-title"><input type="text" class="form-control " id="po_no" ></h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Model<h5 class="card-title" ><input type="text" class="form-control form-control-xs" id="model_name" readonly> </h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Article<input type="text" class="form-control h-25" id="article" readonly></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">PO Qty<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="po_qty" readonly></h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Destination<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="destination" readonly></h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">CRD<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="crd" readonly></h5></div>
            <div class="card-shadow-primary border mb-1 card card-body border-primary" style="padding:10px">Season<h5 class="card-title"><input type="text" class="form-control form-control-sm" id="season" readonly></h5></div>
        </div>
        <div class="col-xl-6">
            <div class="row" style="margin:0px">
                <div class="col-md-6" style="padding:2px">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="exampleEmail11" class="form-label"><b>Size</b></label>
                                <input name="size" id="size" id="exampleEmail11" placeholder="Size" type="text" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mb-3">
                                <label for="exampleEmail11" class="form-label"><b>qty</b></label>
                                <input name="size_qty" id="size_qty" id="exampleEmail11" placeholder="Size Qty" type="text" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="position-relative ">
                        <label for="exampleEmail11" class="form-label"><b>Basic Define</b></label>
                    </div>
                    <div class="card mb-1 widget-content bg-midnight-bloom" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>MIDSOLE</h5></div>
                                <div class="widget-heading"><i class="fa-light fa-boot fa-3x"></i></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span id="min_max_midsole">0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span id="standard_midsole">0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-midnight-bloom" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>OUTSOLE</h5></div>
                                <div class="widget-heading"><i class="fa-light fa-boot fa-3x"></i></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span id="min_max_outsole">0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span id="standard_outsole">0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-midnight-bloom" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>STOCKFIT</h5></div>
                                <div class="widget-heading"><i class="fa-light fa-boot fa-3x"></i></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span id="min_max_stockfit">0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span id="standard_stockfit">0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-midnight-bloom" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>UPPER</h5></div>
                                <div class="widget-heading"><i class="fa-light fa-boot fa-3x"></i></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span id="min_max_upper">0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span id="standard_upper">0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-midnight-bloom" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>ASSEMBLY</h5></div>
                                <div class="widget-heading"><i class="fa-light fa-boot fa-3x"></i></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span id="min_max_assembly">0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span id="standard_assembly">0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-midnight-bloom" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading"><h5>SOCKLINER</h5></div>
                                <div class="widget-heading"><i class="fa-light fa-boot fa-3x"></i></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span id="min_max_sockliner">0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span id="standard_sockliner">0.00g</span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6" style="padding:2px">
                    <div class="position-relative mb-3">
                        <label for="exampleEmail11" class="form-label"><b>Target Quantity </b></label>
                        <input name="target_qty"  id="target_qty" placeholder="Target Qty" type="number" class="form-control">
                    </div>
                    <div class="position-relative ">
                        <label for="exampleEmail11" class="form-label"><b>Production Weight Result</b></label>
                    </div>
                    <div class="card mb-1 widget-content bg-success" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading text-white"><h5>Target : 37pcs</h5></div>
                                <div class="widget-numbers text-white" style="float:left"><span>5</span></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span>0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span>0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-success" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading text-white"><h5>Target : 37pcs</h5></div>
                                <div class="widget-numbers text-white" style="float:left"><span>5</span></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span>0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span>0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-success" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading text-white"><h5>Target : 37pcs</h5></div>
                                <div class="widget-numbers text-white" style="float:left"><span>5</span></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span>0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span>0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-success" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading text-white"><h5>Target : 37pcs</h5></div>
                                <div class="widget-numbers text-white" style="float:left"><span>5</span></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span>0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span>0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-success" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading text-white"><h5>Target : 37pcs</h5></div>
                                <div class="widget-numbers text-white" style="float:left"><span>5</span></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span>0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span>0.00g</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-1 widget-content bg-success" style="padding:0.5rem">
                        <div class="widget-content-wrapper text-white">
                            <div class="widget-content-left">
                                <div class="widget-heading text-white"><h5>Target : 37pcs</h5></div>
                                <div class="widget-numbers text-white" style="float:left"><span>5</span></div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-white" style="font-size:1.3rem"><span>0.00 - 0.00</span></div>
                                <div class="widget-numbers text-white" style="float:right"><span>0.00g</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4"  style="padding:2px">
            <form class="row">
                <div class="col-auto">
                    <label  style="font-size:1rem; font-weight:800" >Assembly </label>
                </div>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="haha" readonly>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Save Weight</button>
                </div>
            </form>
            <table class="mb-0 table table-striped">
                <thead>
                <tr>
                    <th>Seq</th>
                    <th>Weight</th>
                    <th>Time</th>
                    <th>Name</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    <td>@mdo</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    
    
</div>
@endsection


@section('js')
    <!-- <script src="http://maps.google.com/maps/api/js?sensor=true"></script> -->
    <script>
        $(document).ready(function() {
            $('#po_no').keyup(function (event) {
                if (event.key === 'Enter' || event.keyCode === 13) {
                    const po_no = $(this).val();
                    get_data_po(po_no)

                }
            });


            function get_data_po(po_no){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type:"get",
                    url:"{{ url('/prod/get_po') }}"+"/"+po_no,
                    success: function(hasil){
                        console.log(hasil)
                        // if(hasil.midas_information)
                        if(hasil.midas_information.length == 0){
                            alert('Standard information not found, please contact Development')
                        }else if(hasil.po_information.length == 0){
                            alert('PO information not found')
                        }else if(hasil.size_information.length == 0){
                            alert('Size information not found')
                        }else{
                            var tampil_po = hasil.po_information[0]
                            var tampil_midas = hasil.midas_information[0]
                            var tampil_size = hasil.size_information[0]

                            // console.log(tampil_po)
                            $('#model_name').val(tampil_po.MODEL_NAME)
                            $('#article').val(tampil_po.ART_NO)
                            $('#po_qty').val(tampil_po.TOTAL_QTY)
                            $('#destination').val(tampil_po.COUNTRY)
                            const date = tampil_po.CRD;
                            const datePart = date.substring(0, 10);
                            $('#crd').val(datePart)
                            $('#season').val(tampil_midas.season)

                            $('#size').val(tampil_midas.sample_size)
                            $('#size_qty').val(tampil_size.jumlah_qty)

                            // perkalian
                            var min_max_perkalian = 5

                            var min_midsole = parseFloat(tampil_midas.MS) - parseFloat(tampil_midas.MS * min_max_perkalian / 100)
                            var max_midsole = parseFloat(tampil_midas.MS) + parseFloat(tampil_midas.MS * min_max_perkalian / 100)
                            var min_max_midsole = min_midsole.toFixed(2) +' - '+max_midsole.toFixed(2)

                            var min_outsole = parseFloat(tampil_midas.OS) - parseFloat(tampil_midas.OS * min_max_perkalian / 100)
                            var max_outsole = parseFloat(tampil_midas.OS) + parseFloat(tampil_midas.OS * min_max_perkalian / 100)
                            var min_max_outsole = min_outsole.toFixed(2) +' - '+max_outsole.toFixed(2)

                            var min_stockfit = parseFloat(tampil_midas.SF) - parseFloat(tampil_midas.SF * min_max_perkalian / 100)
                            var max_stockfit = parseFloat(tampil_midas.SF) + parseFloat(tampil_midas.SF * min_max_perkalian / 100)
                            var min_max_stockfit = min_stockfit.toFixed(2) +' - '+max_stockfit.toFixed(2)
                            
                            var min_upper = parseFloat(tampil_midas.UP) - parseFloat(tampil_midas.UP * min_max_perkalian / 100)
                            var max_upper = parseFloat(tampil_midas.UP) + parseFloat(tampil_midas.UP * min_max_perkalian / 100)
                            var min_max_upper = min_upper.toFixed(2) +' - '+max_upper.toFixed(2)

                            var min_assembly = parseFloat(tampil_midas.AS) - parseFloat(tampil_midas.AS * min_max_perkalian / 100)
                            var max_assembly = parseFloat(tampil_midas.AS) + parseFloat(tampil_midas.AS * min_max_perkalian / 100)
                            var min_max_assembly = min_assembly.toFixed(2) +' - '+max_assembly.toFixed(2)

                            var min_sockliner = parseFloat(tampil_midas.sockliner) - parseFloat(tampil_midas.sockliner * min_max_perkalian / 100)
                            var max_sockliner = parseFloat(tampil_midas.sockliner) + parseFloat(tampil_midas.sockliner * min_max_perkalian / 100)
                            var min_max_sockliner = min_sockliner.toFixed(2) +' - '+max_sockliner.toFixed(2)


                            $('#standard_midsole').text(tampil_midas.MS)
                            $('#min_max_midsole').text(min_max_midsole)

                            $('#standard_outsole').text(tampil_midas.OS)
                            $('#min_max_outsole').text(min_max_outsole)

                            $('#standard_stockfit').text(tampil_midas.SF)
                            $('#min_max_stockfit').text(min_max_stockfit)

                            $('#standard_upper').text(tampil_midas.UP)
                            $('#min_max_upper').text(min_max_upper)

                            $('#standard_assembly').text(tampil_midas.AS)
                            $('#min_max_assembly').text(min_max_assembly)

                            $('#standard_sockliner').text(tampil_midas.sockliner)
                            $('#min_max_sockliner').text(min_max_sockliner)

                            
                        }
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