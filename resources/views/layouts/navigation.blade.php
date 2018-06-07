<div class="container-fluid">
    <div class="text-center appName">
        <?php if(count($weblogo)){echo $weblogo->title;} ?>
    </div>
</div>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
            @if(count($weblogo))
                <img src="/part/logo/{{$weblogo->img}}" id="imgBrand">
            @else
                @if(Auth::check())
                    @if(Auth::user()->admin())
                        <a href="/admin/logo" class="btn btn-danger" style="margin-top: 8px;">Buat Logo</a>
                    @endif
                @endif
            @endif
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/">Home</a></li>
                @if($navmenus)
                    @foreach($navmenus as $menu)
                        <li class="dropdown">
                          <a href= 
                            <?php 
                                if ($menu->forum == 1){
                                    echo "'/all/".$menu->url."'";
                                }else {
                                  echo "'/".$menu->url."'";
                                }
                            ?> 
                          >{{$menu->menu}} 
                          </a>
                        </li>
                    @endforeach
                @endif
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    @if(Auth::check())
                        @if(Auth::user()->admin())
                            <li><a href="/admin/dashboard">Dashboard</a></li>
                        @endif
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="margin-top: -2px;">
                            {{ Auth::user()->name }} <span class="caret"></span>
                            <img src="<?php if (Auth::user()->img != null) { echo "/users/";} ?>{{Auth::user()->avatar()}}" class="img-circle" alt="user" style="height: 30px;">
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/user/{{Auth::user()->slug}}">Profil</a></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>