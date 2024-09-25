<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Portfolio</title>


    @vite(['resources/js/app.js'])
</head>

<body>

    @include('admin.partials.header')

    <div class="d-flex wrapper">
        @auth
            @include('admin.partials.aside')

        @endauth

        <div class="content p-3">

            @yield('content')
        </div>

    </div>


</body>

</html>
