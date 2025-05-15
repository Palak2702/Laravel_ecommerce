@extends('admin.layouts.app')


@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Category</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f6f9;
    }
    .form-container {
      max-width: 600px;
      margin: 50px auto;
      padding: 30px;
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }
  </style>
</head>
<body>

<div class="form-container">
  <h3 class="mb-4 text-center">Create New Category</h3>
  <form id="categoryForm" class="needs-validation" novalidate>
    @csrf
    <!-- Category Name -->
    <div class="mb-3">
      <label for="category_name" class="form-label">Category Name</label>
      <input type="text" class="form-control" id="category_name" name="category_name" required>
      <div class="invalid-feedback">
        Please enter a category name.
      </div>
    </div>
    <button type="submit" class="btn btn-primary w-100">Create Category</button>
  </form>
</div>


<div class="container mt-4">
  <h4>Category List</h4>
  
    <table class="table table-bordered" id="categoryTable">
      <thead>
        <tr>
          <th>#</th>
          <th>Category Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody></tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>

$(document).ready(function (){

  fetchCategories();


  $('#categoryForm').on('submit', function (e) {
        e.preventDefault();
        let name = $('#category_name').val();
        $.ajax({
            url: "{{ route('create.category') }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                category_name: name
            },
            success: function (response) {
                $('#categoryForm')[0].reset();
                fetchCategories();
            }
        });
    });

  function fetchCategories() {
    $.ajax({
      url:"{{ route('fetch.category')}}",
      method:'GET',
      success:function(data){
        let rows = '';
        $.each(data,function(index,cat){
          rows += `
            <tr>
              <td>${index+1}</td>
              <td>${cat.name}</td>
              <td><button class="btn btn-danger btn-sm delete-btn" data-id="${cat.id}">Delete</button></td>
              </tr>
               `;
               $('#categoryTable tbody').html(rows);

        });
      }
    });

  }


   // Delete Category

   $(document).on('click', '.delete-btn', function () {
        let id = $(this).data('id');
        if (confirm("Are you sure to delete?")) {
            $.ajax({
                url: "/admin/category/delete/" + id,
                method: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function () {
                    fetchCategories();
                }
            });
        }
    });


});


</script>

<script>
  // Bootstrap form validation
  (function () {
    'use strict'
    const forms = document.querySelectorAll('.needs-validation')
    Array.from(forms).forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
      }, false)
    })
  });
</script>

</body>
</html>

@endsection
