<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="icon" href="{{asset('image/')}}"> -->
        <title>CAS-Room Reservation</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <!-- Styles -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
        <style>
            html, body {
                background-color: #fff;
                color:#636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 500;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .margin-top{
                margin-top: 5%;
            }
            .room{
                 padding: 5% 0;
                 background: none;
            }
            .margin-right{
                margin-right:2% ;
            }
            .dark{
                font-weight: 500;
                /*color:grey;*/
            }
            .search-btn{
                background: transparent;
                /*border:none;
                outline: none;*/
            }
            th{
                text-align: center;
            }
            .td-time{
                width: 
            }
        </style>

    </head>
    <body>
        <div class="position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                    @endif
                </div>
            @endif
    

            <div class="container" style="display:;">

                <div class="col-md-4 col-md-offset-4 margin-top" >
                    <form role="form" action="{{url('/searchRoom')}}" method="GET">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="room" class="dark"> Search Room </label>
                            <div class="input-group">
                                <select class="form-control" id="roomID" name="room">
                                        <option value="null" selected></option>
                                    @foreach($rooms as $room)
                                        <option value="{{$room->id}}" class="dark"><span >{{$room->name}}</span></option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><i class="fa fa-search" aria-hidden="true"></i></i></button>
                                </span>
                            </div>
                        </div>
                    </form>     
                    
                                <div id="test"></div>
                </div>

                <div class="row">
                   <div class="col-md-8 col-md-offset-2">
                        <h1>2nd floor</h1>
                        <?php $column = 1; ?>
                        <div class="btn-group-justified">
                        @foreach($secondFloor as $room)
                            <a class="btn btn-default room margin-right" href="/schedule/{{$room->id}}">
                            {{$room->name}}
                            </a>
                        @endforeach
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <h1>1st floor</h1>
                        <?php $column = 1; ?>
                        <div class="btn-group-justified">
                        @foreach($firstFloor as $room)
                            <a class="btn btn-default room margin-right" href="/schedule/{{$room->id}}">
                            {{$room->name}}
                            </a>
                        @endforeach
                        </div>
                    </div>
                    <div class="col-md-8 col-md-offset-2">
                        <h1>Basement</h1>
                        <?php $column = 1; ?>
                        <div class="btn-group-justified">
                        @foreach($basement as $room)
                            <a class="btn btn-default room margin-right" href="/schedule/{{$room->id}}">
                            {{$room->name}}
                            </a>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div> <!-- end of container -->

            <div class="container" style="display:none;">

              <div class="col-md-8 col-md-offset-2 margin-top" >
                    <form role="form" action="{{url('/searchRoom')}}" method="GET">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <div class="col-md-4 col-md-offset-4">
                                <label for="date">Date</label>
                                <div class="input-group">                                    
                                    <input type="date" class="form-control" id="date" name="date">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default search-btn" type="submit"><i class="fa fa-search" aria-hidden="true"></i></i></button>
                                    </span>
                                </div>
                            </div>  
                        </div>

                    </form> 
                </div>
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 text-center">
                        <br/>
                        <a class="" href="#" id="dayView">
                           Day
                        </a>
                        &nbsp;&nbsp;&nbsp;
                        <a class="" href="#" id="weekView">
                           Week
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <br/>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th></th>
                              <th>Status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row" rowspan="2"> 06 : 00 </th>
                              <th></th>
                            </tr>
                            <tr>
                              <td></td>
                            </tr>
                            <tr>
                              <th scope="row" rowspan="2">07 : 00</th>
                              <th rowspan="3" style="vertical-align:middle;"> CLASS</th>
                            </tr>
                            <tr>
                              <!-- <td></td> -->
                            </tr>
                            <tr>
                              <th scope="row" rowspan="2">08 : 00</th>
                              <!-- <th></th> -->
                            </tr>
                            <tr>
                              <td></td>
                            </tr>
                            <tr>
                              <th scope="row" rowspan="2">09 : 00</th>
                              <th></th>
                            </tr>
                            <tr>
                              <td></td>
                            </tr>
                            <tr>
                              <th scope="row" rowspan="2">10 : 00</th>
                              <th></th>
                            </tr>
                            <tr>
                              <td></td>
                            </tr>
                          </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
        <!-- scripts -->
        <script src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('[name="_token"]').val()
                }
            });

            $('#roomID').change(function(){ 
                var room_id = $('#roomID').val();
                $('#test').text(room_id)
                // $.ajax({
                //     url:'{{url('/searchRoom')}}',
                //     type: 'get',
                //     data: {room_id:dest_id},
                //     dataType: 'json',
                //     success: function(data, status, xhr)
                //     {
                //        console.log(data);
                //        if (data != 'error') { 
                    
                //        }
                //        else{
                //        }
                //     }, 
                //     error:function(error){
                //         console.log(error);
                //     }
                // });
            });

        });
        </script>
    </body>
</html>
