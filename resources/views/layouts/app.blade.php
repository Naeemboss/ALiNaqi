<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nasir </title>

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Your custom app CSS file (if you have one) -->
    <link href="{{mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        @yield('content')  <!-- This will render the content from other views -->
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Your custom app JS file (if you have one) -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
