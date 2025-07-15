<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Pemantauan Sumber Mata Air</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{asset('/')}}back/img/kaiadmin/favicon.ico"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{asset('/')}}back/js/plugin/webfont/webfont.min.js"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{asset('/')}}back/css/fonts.min.css"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{asset('/')}}back/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{asset('/')}}back/css/plugins.min.css" />
    <link rel="stylesheet" href="{{asset('/')}}back/css/kaiadmin.min.css" />
    
    <link rel="stylesheet" href="{{asset('/')}}back/js/plugin/sweetalert/sweetalert2.min.css" />
    @yield('content-css')
  </head>
  <body>
    <div class="wrapper">