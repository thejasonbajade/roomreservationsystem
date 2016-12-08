<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Room Reservation System</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="bootstrap/css/style.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styleUI.css">

    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color: #636b6f">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="{{ url('/viewRooms') }}">View Rooms</a>
                    @else
                        <a href="{{ url('/viewRooms') }}">View Rooms</a>
                    @endif
                </div>
            @endif
        </nav>
        @if (Auth::check())
        <div class="flex-center position-ref full-height container-fluid">

            <div class="col-md-12 col-md-offset-1 content">
                <div class="title m-b-md">
                    UPV-CAS Room Reservation System
                </div>

                <div class="blurb">
                    A room reservation system for CAS faculty.
                </div>
            </div>
        </div>
        @else
        <div class="flex-center position-ref full-height container-fluid">

            <div class="col-md-7 col-md-offset-1 content">
                <div class="title m-b-md">
                    UPV-CAS Room Reservation System
                </div>

                <div class="blurb">
                    A room reservation system for CAS faculty.
                </div>
            </div>
            <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-head" style="color:#636b6f;background-color:white;"><b>Login</b></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label text-head">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label text-head">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" class="text-head" name="remember"> <b>Remember Me</b>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <b>Login</b>
                                </button>

                                <a class="btn btn-link text-head" href="{{ url('/password/reset') }}">
                                    <b>Forgot Password?</b>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        </div>
        @endif
        <div class="bg-success links" id="footer">
            <center>
                <a href="#">A project by Tripod Inc.</a> | <a href="#">Contact Us</a>&copy; 2016
            </center>
        </div>
    </body>
</html>