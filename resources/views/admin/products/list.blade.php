@extends('admin.layouts.app')



@section('content')


<!DOCTYPE html>
<html lang="en">
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
    <div class="container mt-4">
        <h4>Products List</h4>
        
          <table class="table table-bordered" id="categoryTable">
            <thead>
              <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product discount Type</th>
                <th>Product discount</th>
                <th>Edit</th>
                <th>Delete</th>
                
              </tr>
            </thead>
            <tbody>

                @foreach ($data as $item)


                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->category->name}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->price_per_kg_inr}}</td>
                    <td>{{$item->discount_type}}</td>
                    <td>{{$item->discount}}</td>
                    <td><button class="btn btn-success btn-sm delete-btn" >Edit</button></td>
                    <td><button class="btn btn-danger btn-sm delete-btn" >Delete</button></td>
                </tr>
                    
                @endforeach
              
            </tbody>
        </table>
      </div>
</body>
</html>


@endsection