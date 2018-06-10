<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    
    <!-- Share -->
    <meta name="url"           content="@yield('url')" />
    <meta name="title"         content="@yield('title')" />
    <meta name="description"   content="@yield('description')" />
    <meta name="image"         content="@yield('image')" />

    <meta name="google-signin-client_id" content="524555026329-duc32e6en3f62mhdak03hi5scguviu9f.apps.googleusercontent.com">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/css/emoji.css">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <link rel="stylesheet" type="text/css" href="/css/product.css">
    <link rel="stylesheet" type="text/css" href="/css/forum.css">
    <link rel="stylesheet" type="text/css" href="/css/thumbSlide.css">
    <link rel="stylesheet" type="text/css" href="/css/promoSlide.css">
    <link rel="stylesheet" type="text/css" href="/css/modal.css">
    <link rel="stylesheet" type="text/css" href="/css/headerandfooter.css">
    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
    @yield('css')
    <link href='<?php if(count($webtitle)){ echo '/part/'.$webtitle->img; } ?>' rel='shortcut icon'>
    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120528530-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-120528530-1');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.5.0/js/md5.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
    
    <div id="app">
        @include('layouts.navigation')
        <div class="content">
            @yield('content')
        </div>
        @include('footer.index')
    </div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/share.js"></script>
    <script src="/js/style.js"></script>
    @yield('js')
</body>
</html>
