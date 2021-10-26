<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title> {{ env('APP_NAME')  }} | @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/portal/icon-pack/favicon.png')  }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">


    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('/assets/css/theme.min.css')  }}">
    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/icon-set/style.css')  }}">
    <style type="text/css">
        .ck-content {
            height: 200px !important;
        }
    </style>

    @yield('styles')
</head>

<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl footer-offset">

<script src="{{ asset('/portal/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside-mini-cache.js') }}"></script>

<x-header/>

<x-sidebar/>

<main id="content" role="main" class="main pointer-event">
    <!-- Content -->
    <div class="content container-fluid" id="app">

        {{ $slot  }}

    </div>
    <!-- End Content -->
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- JS Global Compulsory  -->
<script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')  }}"></script>
<script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')  }}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('/assets/vendor/hs-navbar-vertical-aside/hs-navbar-vertical-aside.min.js')  }}"></script>
<script src="{{ asset('/assets/vendor/hs-unfold/dist/hs-unfold.min.js')  }}"></script>
<script src="{{ asset('/assets/vendor/clipboard/dist/clipboard.min.js')  }}"></script>


<!-- JS Front -->
<script src="{{ asset('/assets/js/theme.min.js')  }}"></script>

<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('.js-navbar-vertical-aside-toggle-invoker').click(function () {
            $('.js-navbar-vertical-aside-toggle-invoker i').tooltip('hide');
        });


        // initialization of navbar vertical navigation
        var sidebar = $('.js-navbar-vertical-aside').hsSideNav();

        // initialization of unfold
        $('.js-hs-unfold-invoker').each(function () {
            var unfold = new HSUnfold($(this)).init();
        });

        // initialization of form search

        // initialization of clipboard
        $('.js-clipboard').each(function () {
            var clipboard = $.HSCore.components.HSClipboard.init(this);
        });
    });
</script>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{ asset('/portal/vendor/babel-polyfill/polyfill.min.js')  }}"><\/script>');
</script>

@yield('scripts')

</body>
</html>
