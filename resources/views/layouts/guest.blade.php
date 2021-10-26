<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags Always Come First -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title> {{ env('APP_NAME')  }} | @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/portal/icon-pack/favicon.png')  }}">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/icon-set/style.css')  }}">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('/assets/css/theme.min.css')  }}">
</head>

<body style="background-color:#f9f9f9;">
<!-- ========== MAIN CONTENT ========== -->
<main id="content" role="main" class="main">

    <!-- Content -->
    <div class="container py-5 py-sm-7">

        <div class="row justify-content-center" style="margin-top:10rem;">
            <div class="col-md-7 col-lg-5">

                {{ $slot }}

            </div>
        </div>
    </div>
    <!-- End Content -->
</main>
<!-- ========== END MAIN CONTENT ========== -->

<!-- JS Global Compulsory  -->
<script src="{{ asset('/assets/vendor/jquery/dist/jquery.min.js')  }}"></script>
<script src="{{ asset('/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js')  }}"></script>
<script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')  }}"></script>

<!-- JS Front -->
<script src="{{ asset('/portal/js/theme.min.js')  }}"></script>

<!-- IE Support -->
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{ asset('/portal/vendor/babel-polyfill/polyfill.min.js')  }}"><\/script>');
</script>
</body>
</html>
