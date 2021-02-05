<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>
    
    <link rel="stylesheet" href="{{ asset('css/frontend/app.css') }}">
</head>
<body>
    <div id="app">
        <app></app>
    </div>

    <script src="{{ asset('js/frontend/app.js') }}"></script>
</body>
</html>
