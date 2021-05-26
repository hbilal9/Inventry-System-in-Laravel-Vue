<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="witchappy | Talk with a consultant" />
        <meta name="keywords" content="listing dashboard, directory panel, listing, responsive directory, , css3, html5" />
        <title>Inventory System</title>

        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}" />

        <link href="assets/images/logos/favicon.png" rel="icon" />
        <link rel="apple-touch-icon" href="assets/images/logos/touch-icon-iphone.png" />
        <link rel="apple-touch-icon" sizes="152x152" href="assets/images/logos/touch-icon-ipad.png" />
        <link rel="apple-touch-icon" sizes="180x180" href="assets/images/logos/touch-icon-iphone-retina.png" />
        <link rel="apple-touch-icon" sizes="167x167" href="assets/images/logos/touch-icon-ipad-retina.png" />
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&amp;display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&amp;display=swap" rel="stylesheet" />

        {{-- for dasboard --}}
        <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}" type="text/css" />
        {{-- <link rel="stylesheet" href="{{ asset('assets/css/tempusdominus-bootstrap-4.css') }}" type="text/css" /> --}}
        <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}" />

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        {{-- Custom Styles --}}
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body class="antialiased" id="body">
        <div id="app"></div>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        {{-- <script>
            Echo.channel('device-data')
            .listen('DeviceEvent', e => {
                console.log(e)
            });
        </script> --}}
        {{-- <script type="text/javascript">
            var i = 0;
            window.Echo.channel('device-data')
             .listen('.UserEvent', (data) => {
                i++;
                console,log
            });
        </script> --}}
    </body>
</html>
