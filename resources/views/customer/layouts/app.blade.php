<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Shopsphere - @yield('title', 'Home')</title>
    <link href="{{asset('assets/admin/css/styles.css')}}" rel="stylesheet" />
</head>
<body>
    
    @include('customer.shared.header')
    @include('customer.shared.navbar')
   
    @yield('content')

    @include('customer.shared.footer')

    <script src="{{ asset('assets/customer/js/main.js') }}"></script>
</body>
</html>