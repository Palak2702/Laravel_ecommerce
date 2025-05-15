@extends('admin.layouts.app')



@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .form-section {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.05);
            margin-top: 40px;
        }
    </style>
</head>

<body>



    <div class="container">
        <div class="form-section">
            <h4 class="mb-4 text-center">Create New Products</h4>

            <form method="POST" action="{{route('create.product')}}"    enctype="multipart/form-data">
                @csrf
                <!-- Category Dropdown -->
                <div class="mb-3">
                    <label for="category" class="form-label">Select Product Category</label>
                    <select name="category_id" id="category" class="form-select" required>
                        <option value="" selected disabled>Choose category</option>
                        @foreach ($categories as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Input Row -->
                <div class="table-responsive">
                    <table class="table table-bordered mt-3" id="product-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Discount Type</th>
                                <th>Discount</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" class="form-control" name="product_name[]" required></td>
                                <td><input type="number" class="form-control" name="price[]" required></td>
                                <td>
                                    <select class="form-select" name="discount_type[]" required>
                                        <option value="%">%</option>
                                        <option value="rs">₹</option>
                                    </select>
                                </td>
                                <td><input type="number" class="form-control" name="discount[]" required></td>
                                <td><input type="file" class="form-control" name="image[]" accept="image/*" required>
                                </td>
                                <td><button type="button" class="btn btn-danger remove-row">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" id="addMore" class="btn btn-success">Add More</button>

                </div>

                <button type="submit" class="btn btn-primary mt-3 w-100">Create Products</button>
            </form>
        </div>
    </div>

</body>

</html>


<script>
    document.getElementById('addMore').addEventListener('click', function() {
        const tableBody = document.querySelector('#product-table tbody');
        const firstRow = tableBody.querySelector('tr');
        const clone = firstRow.cloneNode(true);

        // Clear input values in the cloned row
        clone.querySelectorAll('input').forEach(input => {
            if (input.type !== 'file') input.value = '';
            else input.value = null;
        });

        // Append clone to table
        tableBody.appendChild(clone);
    });



    document.querySelector('#product-table tbody').addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-row')) {
            const row = e.target.closest('tr');
            const allRows = this.querySelectorAll('tr');
            if (allRows.length > 1) {
                row.remove();
            } else {
                alert("At least one product entry is required.");
            }
        }
    });
</script>


@endsection