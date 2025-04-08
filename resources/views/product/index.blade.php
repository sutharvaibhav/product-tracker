<!DOCTYPE html>
<html>
<head>
    <title>Product Tracker</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="container py-5">
    <h2>Product Tracker</h2>
    <form id="productForm">
        <input type="hidden" name="edit_id" id="edit_id">
        <div class="row g-2">
            <div class="col-md-4">
                <input type="text" name="product_name" class="form-control" placeholder="Product name" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" required>
            </div>
            <div class="col-md-3">
                <input type="number" name="price" step="0.01" class="form-control" placeholder="Price per item" required>
            </div>
            <div class="col-md-2">
                <button class="btn btn-primary w-100" id="submitBtn">Submit</button>
            </div>
        </div>
    </form>

    <hr class="my-4">

    <h3>Submitted Products</h3>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Submitted At</th>
                <th>Total Value</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="productTable"></tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Grand Total:</th>
                <th id="grandTotal">0</th>
                <th></th>
            </tr>
        </tfoot>
    </table>

    // Import jQuery for AJAX
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        fetchData();

        // Handle form submission
        $('#productForm').submit(function(e) {
            e.preventDefault();

            const id = $('#edit_id').val();
            const url = id ? `/update/${id}` : '/submit';
            const formData = {
                product_name: $('input[name="product_name"]').val(),
                quantity: $('input[name="quantity"]').val(),
                price: $('input[name="price"]').val(),
                _token: $('meta[name="csrf-token"]').attr('content')
            };

            // Use method override for edit 
            if (id) {
                formData._method = 'PUT';
            }

            // Send AJAX request to controller
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                success: function() {
                    $('#productForm')[0].reset();
                    $('#edit_id').val('');
                    $('#submitBtn').text('Submit');
                    fetchData();
                }
            });
        });

        // Fetch product list
        function fetchData() {
            $.get('/list', function(data) {
                let rows = '', total = 0;
                data.forEach(item => {
                    rows += `<tr>
                        <td>${item.product_name}</td>
                        <td>${item.quantity}</td>
                        <td>${item.price}</td>
                        <td>${item.datetime}</td>
                        <td>${item.total.toFixed(2)}</td>
                        <td>
                            <button class="btn btn-sm btn-warning" onclick="editItem(${item.id}, \`${item.product_name}\`, ${item.quantity}, ${item.price})">Edit</button>
                        </td>
                    </tr>`;
                    total += parseFloat(item.total);
                });
                $('#productTable').html(rows);
                $('#grandTotal').text(total.toFixed(2));
            });
        }

        // Use same form for product update
        function editItem(id, name, qty, price) {
            $('input[name="product_name"]').val(name);
            $('input[name="quantity"]').val(qty);
            $('input[name="price"]').val(price);
            $('#edit_id').val(id);
            $('#submitBtn').text('Update');
        }
    </script>
</body>
</html>