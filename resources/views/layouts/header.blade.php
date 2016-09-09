<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ elixir('css/app.css') }}">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<body>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
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
                    <?php $siteName = env('SITE_NAME'); ?>
                    @if (isset($siteName))
                        {{ env('SITE_NAME') }}
                    @else
                        <img src="{!! asset('/img/icons/plato-icon.png') !!}" style="width: 35px; float: left;margin-top: -8px;margin-right: 4px;"> Plato<span>LMS</span>
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
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->first }} {{ Auth::user()->last }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
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
                        <li>
                            <a href=""><i class="fa fa-cog"></i></a>
                        </li>
                        <li>
                            <a href=""><i class="fa fa-bell"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar secondary-navbar">
        <div class="container">
            <div class="row">

                <div class="{{ getColumns(6) }} half-nav collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-left">
                        <!-- Placeholder Links -->
                        <li><a href="{{ url('/login') }}"><i class="fa fa-book"></i> Wiki</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fa fa-line-chart"></i> Analytics</a></li>
                    </ul>
                </div>

                <div class="{{ getColumns(6) }} half-nav collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Placeholder Links -->
                        <li><a href="{{ url('/login') }}" style="margin-left:-10px;"><i class="fa fa-share-alt"></i> Integrations</a></li>
                        <li><a href="{{ url('/register') }}"><i class="fa fa-plug"></i> Plugins</a></li>
                        <li><a href="{{ url('/register') }}" class="pr0"><i class="fa fa-cubes"></i> Themes</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">

