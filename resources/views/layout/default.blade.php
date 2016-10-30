<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Twitter Cty</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" media="screen" title="no title">

        <script>
            window.app_settings = {
                csrfToken: "{{ csrf_token() }}"
            }
        </script>
    </head>
    <body>
        @yield('content')

        <script src="{{ asset('js/vendor/modernizr.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ config('services.gmapapi.key') }}&callback=initMap"></script>
        <script type="text/javascript">

        </script>
        @yield('footer')
    </body>
</html>
