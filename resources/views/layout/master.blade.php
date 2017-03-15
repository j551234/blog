{{-­‐-­‐resources/views/layouts/master.blade.php-­‐-­‐}}
<html>
<head>
<title>AppName-­‐@yield('title')</title>
</head>
<body>
@include('layouts.partials.navigation')
<div class="container">@yield('content')
</div>
</body>
</html>