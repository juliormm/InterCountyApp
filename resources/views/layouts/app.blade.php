<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Inter County Appliance Group') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha256-k2WSCIexGzOj3Euiig+TlR8gA0EmPjuc79OEeY5L45g=" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbar-inverse">
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
                        {{ config('app.name', 'Intercounty Web App') }}
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    
                    {{-- <p class="navbar-text">Stores:</p> --}}
    
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <li class="{{ Request::is('stores') ? 'active' : '' }}">
                            <a href="{{ url('/stores') }}">Store List</a>
                        </li>
                        <li class="{{ Request::is('stores/create') ? 'active' : '' }}">
                            <a href="{{ url('/stores/create') }}">Add Store</a>
                        </li>
                        {{-- <li class="divider-vertical"></li> --}}

                    </ul>
                     {{-- <p class="navbar-text">Campaigns:</p> --}}
                    <ul class="nav navbar-nav">
                       {{--     <li class="{{ Request::is('campaign/create') ? 'active' : '' }}">
                            <a href="{{ url('/campaigns/create') }}">Add Campaign</a>
                        </li> --}}

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   Add Campaign <span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <form class="navbar-form navbar-left" id="add-campaign-form" action="/campaigns/create" method="POST">
                                         {{ csrf_field() }}
                                          <div class="form-group">
                                            <input type="text" class="form-control" name="name" placeholder="Campaign Name">
                                          </div>
                                      <button type="submit" class="btn btn-default">Add</button>
                                    </form>
                                </li>  
                                                        
                            </ul>
                        </li>


                        


                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                   Select Campaign <span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu" role="menu">
                                @foreach ($campaignsList as $campaign)
                                <li>
                                    <a href="{{ url('/campaigns/'.$campaign->id.'/edit') }}">{{ $campaign->name }}</a>
                                </li>
                                @endforeach  
                                                        
                            </ul>
                        </li>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        {{--
                        <li><a href="{{ route('register') }}">Register</a></li> --}} @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('tab-nav') @yield('content')
    </div>
    @include ('footer')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>