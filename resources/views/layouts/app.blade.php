<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CAS - Room Reservation</title>

    <!-- Styles -->
    <link href="{{asset('/css/app.css')}}" rel="stylesheet">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/styleUI.css">
    <!-- Scripts -->
    <script src="{{asset('/js/jquery-3.1.1.min.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('[name="_token"]').val()
            }
        });
        window.Laravel = <?php echo json_encode([
                'csrfToken' => csrf_token(),
        ]); ?>
    </script>


    <link rel="stylesheet" href="font/font-awesome-4.7.0/font-awesome-4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-fixed-top" style="background-color: #636b6f; clear:both;">
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
                    <a class="navbar-brand" href="{{ url('/') }}"  style="color: #fff;">
                        CAS - Room Reservation
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse" style="background-color: #636b6f; height:50px;">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                        @else
                            <li class="dropdown" style="background-color: #636b6f">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="background-color: #636b6f; color: #fff; text-align: right;padding-top: 0">
                                    <img src="images/UPVisayas.png" class="profile-picture" alt="icon" style="width: 10%;"></img>{{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu" style="background-color: #636b6f; text-align: right;">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"  style="background-color: #636b6f; color: #fff;">
                                            Logout
                                        </a>

                                        <a href="#menu-toggle" id="menu-toggle"  style="background-color: #636b6f; color: #fff;">Toggle Menu</a>

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
        @if (Auth::check())
        <div id="wrapper">
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li><img src="images/UPVisayas.png" class="profile-picture" alt="icon"></img><span class="user-name">{{ Auth::user()->name }}</span></li>
                    @if (Auth::user()->user_type == "Teacher")
                    <li><a href="{{ url('/viewRooms') }}">View Rooms</a></li>
                    @elseif (Auth::user()->user_type == "College Secretary")
                    <li><a href="" data-backdrop="static" data-toggle="modal" data-target="#addEmp">Add Teacher</a></li>
                    <li><a href="#">Add Schedule</a></li>
                    @elseif (Auth::user()->user_type == "Dean")
                    <li><a href="#">Add Teacher</a></li>
                    <li><a href="#">Add Schedule</a></li>
                    @endif
                    <li><a href="{{ url('/logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Logout</a></li>
                </ul>
            </div>
            @endif
        @yield('content')
        @if (Auth::check())
        </div>
        @endif
    </div> 
    <!-- Scripts -->
    <script src="{{asset('/js/app.js')}}"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>
</html>