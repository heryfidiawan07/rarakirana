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
    <link rel="stylesheet" type="text/css" href="/css/promoSlide.css">
    <link rel="stylesheet" type="text/css" href="/css/error.css">
    @yield('css')
    <link href='<?php if(count($webtitle)){ echo '/part/'.$webtitle->img; } ?>' rel='shortcut icon'>
    <style type="text/css">
        #app {
            background-color: #ffffff;
        }
        .appName {
            line-height: 50px; font-size: 16px;
            color: #b300b3; font-weight: bold;
        }
        .sub {
            color: #e64d00;
        }
        .navbar-fixed-top {
            border-bottom: 3px solid #cc99ff;
            position: sticky; margin-bottom: 0;
        }
        #app-navbar-collapse a {
            color: #000;
        }
        #app-navbar-collapse a:hover {
            background-color: #cc99ff;
        }
        #imgBrand {
            max-width: 100%; height: 40px; position: absolute; margin-top: -9px;
        }
        .content {
            min-height: 90vh;
        }
        .menusFot {
            width: 70%;
            margin: 0 auto;
        }
        .a-foot {
            display: inline-block;
        }
        .a-foot:hover {
            color: #aa00ff;
        }
        .navbar-bottom {
            border-bottom: unset; border-top: 2px solid #e64d00; 
            margin-bottom: 0px; padding-top: 20px;
        }
        @media screen and (min-width: 350px){
            .menusFot {
                width: 100%;
                margin: 0 auto;
            }
            .a-foot {
                color: unset;
                display: inline-block;
                margin: 5px;
            }   
        }
        @media screen and (min-width: 800px){
            .menusFot {
                width: 70%;
                margin: 0 auto;
            }
            .a-foot {
                color: unset;
                display: inline-block;
            }
        }
    </style>
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
            <h1 data-title="Error 404">Not Found !</h1>
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
