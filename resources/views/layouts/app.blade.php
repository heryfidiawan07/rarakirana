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
    
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '{251115105631051}',
          cookie     : true,
          xfbml      : true,
          version    : '{latest-api-version}'
        });
          
        FB.AppEvents.logPageView();   
          
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "https://connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
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
