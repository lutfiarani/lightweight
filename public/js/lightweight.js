 
// let url = new URL('http://127.0.0.1:8000');

let url = new URL('http://10.10.40.42:8080/');

function list_search(){
    $.ajax({
        url : url+"listSearch",
        dataType : "json",
        success: function(response) {
            if (response.status === 'success') {
                const data = response.data;
                
                // Update semua select elements
                $("#development-center").html(data.dc);
                $("#season").html(data.season);
                $("#model-name").html(data.model_name);
                $("#model-number").html(data.model_number);
                $("#article-number").html(data.article);
                $("#development-type").html(data.development_type);
                $("#article-status").html(data.article_status);
                $("#stage").html(data.stage);
            } else {
                console.error('Failed to load selection lists');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading selection lists:', error);
        }
    })
}

function factory(){
    $.ajax({
        url: url+"listFactory",
        dataType : 'json',
        success: function(data) {
            $('#factory').html(data)
        }
    })
}

function cell(id){
    $.ajax({
        url: url+"listCell/"+id,
        dataType: 'json',
        success: function(data){
            $('#cell').html(data)
        }
    })
}

function listModel(){
    $.ajax({
        url : url+"listModel",
        dataType : "json",
        success: function(data){
            $('#model').html(data)
        }
    })
}

function article(id){
    $.ajax({
        url: url+"listArticle/"+id,
        dataType: 'json',
        success: function(data){
            $('#article').html(data)
        }
    })
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize CSRF token for Ajax requests
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Event listeners for filter inputs
    document.getElementById('search').addEventListener('click', fetchData);
    document.getElementById('export').addEventListener('click', exportExcel);

    function fetchData() {
        const filters = {
            start_date: document.getElementById('start_date').value,
            end_date: document.getElementById('end_date').value,
            factory: document.getElementById('factory').value,
            line: document.getElementById('cell').value,
            po_no: document.getElementById('po_no').value,
            model: document.getElementById('model').value,
            article: document.getElementById('article').value,
            group_po: document.getElementById('group_po').checked
        };

        fetch('/weight-list/data', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(filters)
        })
        .then(response => response.json())
        .then(data => renderTable(data))
        .catch(error => console.error('Error:', error));
        
    }

    function renderTable(data) {
        const tbody = document.getElementById('weight-list-body');
        tbody.innerHTML = '';

        Object.entries(data).forEach(([poNo, items]) => {
            // Add PO group header
            const groupRow = document.createElement('tr');
            groupRow.className = 'po-group';
            groupRow.innerHTML = `
                <td colspan="15">
                    <span class="expand-button" data-po="${poNo}">▶</span>
                    ${poNo} (${items.length} items)
                </td>
            `;
            tbody.appendChild(groupRow);

            // Add items for this PO
            items.forEach(item => {
                const row = document.createElement('tr');
                row.className = `po-items po-${poNo} collapsed`;
                row.innerHTML = `
                    <td>${item.factory || ''}</td>
                    <td>${item.line || ''}</td>
                    <td>${item.season || ''}</td>
                    <td>${item.po_no}</td>
                    <td>${item.model_name}</td>
                    <td>${item.article}</td>
                    <td>${item.size}</td>
                    <td>${item.size_qty}</td>
                    <td>${item.type || ''}</td>
                    <td>${item.target_qty}</td>
                    <td>${item.metric_value}</td>
                    <td class="weight-value ${isWeightWarning(item.weight, item.metric_value)}">${item.weight}</td>
                    <td>${formatDateTime(item.created_at)}</td>
                    <td>${item.fullname}</td>
                   
                `;
                tbody.appendChild(row);
            });
        });

        // Add click handlers for expand/collapse
        document.querySelectorAll('.expand-button').forEach(button => {
            button.addEventListener('click', function() {
                const poNo = this.dataset.po;
                const items = document.querySelectorAll(`.po-${poNo}`);
                const isExpanded = this.textContent === '▼';
                
                this.textContent = isExpanded ? '▶' : '▼';
                items.forEach(item => item.classList.toggle('collapsed'));
            });
        });
    }

    function isWeightWarning(actual, target) {
        const base = $('#percentage').val()
        actual = parseFloat(actual);
        target = parseFloat(target);
        const lowerBound = target - (target * parseFloat(base)); // 5% di bawah target
        const upperBound = target + (target * parseFloat(base)); // 5% di atas target
        return actual < lowerBound || actual > upperBound ? 'warning' : '';
    }

    function formatDateTime(dateString) {
        const date = new Date(dateString);

        if (isNaN(date)) {
            throw new Error('Invalid date string');
        }

        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0'); // Tambahkan 1 karena bulan dimulai dari 0
        const day = String(date.getDate()).padStart(2, '0');

        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        const seconds = String(date.getSeconds()).padStart(2, '0');

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function exportExcel() {
        const filters = {
            start_date: document.getElementById('start_date').value,
            end_date: document.getElementById('end_date').value,
            factory: document.getElementById('factory').value,
            line: document.getElementById('line').value,
            po_no: document.getElementById('po_no').value,
            model: document.getElementById('model').value,
            article: document.getElementById('article').value
        };

        const queryString = new URLSearchParams(filters).toString();
        window.location.href = `/weight-list/export?${queryString}`;
    }

    // Initial load
    fetchData();
});


