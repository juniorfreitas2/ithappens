<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('theme/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/dist/css/skins/skin-blue.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/dist/css/skins/skin-yellow.min.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    @yield('css')

</head>
<body class="skin-yellow">
    <div id="app">
        @include('master.includes.header')
        @include('master.includes.sidebar')
    </div>

        <div  class="content-wrapper" style="padding: 20px">
            @yield('content')
        </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{ asset('theme/dist/js/adminlte.min.js') }}"></script>

    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>

    <script type="text/javascript">
        @if(session('message'))
            toastr.success("{{session('message')}}", 'Sucesso!')
        @endif

        @if($errors->has('error'))
            toastr.warning("{{$errors->first('error')}}", 'Erro!')
        @endif

        @if($errors->has('exception'))
            toastr.error("{{$errors->first('exception')}}", 'Erro!')
        @endif

    </script>

    @yield('js')
</body>
</html>