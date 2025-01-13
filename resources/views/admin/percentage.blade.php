@extends('template.__body')
@section('title', 'Set Percentage')

{{-- @push('styles') --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/apexcharts/3.45.1/apexcharts.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
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
        .container, table {
            font-size: 85%;
        }
        .modal-backdrop {
            z-index: 1040;
        }
        .modal {
            position: fixed !important;
            z-index: 1050;
        }
        .editable {
            background-color: #fff;
            border: 1px solid #ddd;
            padding: 2px 5px;
        }
    </style>
{{-- @endpush --}}

@section('content')
<div class="container">
    <br>
    <div class="card">
        <div class="card-header"><h3>Percentage of Weight Loss</h3></div>
        <div class="card-body">
            <div class="table-container">
                <table class="table table-bordered table-striped align-middle text-center" id="weightLossTable">
                    <thead class="text-center">
                        <tr>
                            <th>Value</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Manage</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($weightloss as $item)
                        <tr class="detail_percentage"
                             data-id="{{ $item->id }}"
                             data-value="{{ $item->perc_value }}">
                            <td class="value-cell">{{ $item->perc_value }} ({{ number_format($item->perc_value * 100, 2) }}%)</td>
                            <td>{{ $item->created_at->format('Y-m-d H:i:s') }}</td>
                            <td class="updated-at">{{ $item->updated_at->format('Y-m-d H:i:s') }}</td>
                            <td><button class="btn btn-primary btn-sm edit-btn">Edit</button></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @push('scripts') --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    // Initialize DataTable
    const table = $('#weightLossTable').DataTable({
        responsive: true,
        order: [[1, 'desc']]
    });

    // Handle Edit button click
    $(document).on('click', '.edit-btn', function(e) {
        e.stopPropagation();
        const row = $(this).closest('tr');
        const valueCell = row.find('.value-cell');
        const currentValue = row.data('value');
        
        if ($(this).text() === 'Edit') {
            // Switch to edit mode
            valueCell.html(`<input type="number" step="0.01" class="form-control form-control-sm" value="${currentValue}">`);
            $(this).text('Save').removeClass('btn-primary').addClass('btn-success');
        } else {
            // Save the changes
            const newValue = valueCell.find('input').val();
            const id = row.data('id');
            
            // AJAX call to update the value
            $.ajax({
                url: '/update-weightloss/' + id,  // Adjust this URL to match your route
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    value: newValue
                },
                success: function(response) {
                    // Update the display
                    const formattedValue = `${newValue} (${(newValue * 100).toFixed(2)}%)`;
                    valueCell.html(formattedValue);
                    row.data('value', newValue);
                    
                    // Update the updated_at timestamp
                    row.find('.updated-at').text(response.updated_at);
                    
                    // Reset the button
                    row.find('.edit-btn').text('Edit').removeClass('btn-success').addClass('btn-primary');
                    
                    // Show success message
                    Swal.fire({
                        title: "Data berhasil diupdate!",
                        icon: "success",
                        draggable: true
                        });
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Data Tidak Berhasil Diupdate!",
                        icon: "error",
                        draggable: true
                        });
                    // Revert to original value
                    valueCell.html(`${currentValue} (${(currentValue * 100).toFixed(2)}%)`);
                    row.find('.edit-btn').text('Edit').removeClass('btn-success').addClass('btn-primary');
                }
            });
        }
    });
});
</script>
{{-- @endpush --}}