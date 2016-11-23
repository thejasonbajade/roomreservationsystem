@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">

                <form role="form" action="{{url('/reserveRoom')}}" method="GET">
                    {{ csrf_field() }}
                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="room">Room</label>
                            <input type="room" class="form-control" id="room" name="room" placeholder="MTh">
                        </div>
                    </div>
                    <div class="col-md-3">

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" placeholder="MTh">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="startTime">Start Time:</label>
                            <input type="time" class="form-control" id="startTime" name="startTime" placeholder="7:30-8:00">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="EndTime">End Time:</label>
                            <input type="time" class="form-control" id="EndTime" name="EndTime" placeholder="7:30-8:00">
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" style="margin-top:25px;" value="Add"/>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
