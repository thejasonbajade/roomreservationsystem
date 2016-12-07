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
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/viewRooms') }}">View Rooms</a>
                    @endif
                </div>
            @endif
        </nav>
        @if (Auth::check())
        <div class="flex-center position-ref full-height container-fluid">

            <div class="col-md-12 col-xs-12 content">
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

            <div class="col-md-8 col-xs-12 content">
                <div class="title m-b-md">
                    UPV-CAS Room Reservation System
                </div>

                <div class="blurb">
                    A room reservation system for CAS faculty.
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading title-login">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="http://localhost/roomreservationsystem/public/">
                            <input type="hidden" name="_token" value="XPqk7IZ4JqiT6n3NQWSp7diEOwxyldHj7083cqyU">
                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> <b>Remember Me</b>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <b>Login</b><br />
                                    </button>

                                    <a class="btn btn-link" href="http://localhost/roomreservationsystem/public/password/reset">
                                    <b>Forgot Your Password?</b>
                                    </a>
                                </div>
                            </div>
                        </form>
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