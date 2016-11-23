@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <p>Status: {{$reservation->status}}</p>
                        <p>Date: {{ $reservation->created_at->format('M d, Y h:i A') }}</p>
                        <form role="form" action="{{url('/processEditReservation/'.$reservation->id)}}" method="GET">
                            {{ csrf_field() }}
                            <div id="reservationFields">
                                    <div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="room">Room</label>
                                                <select class="form-control" id="roomID[]" name="roomID[]">
                                                    @foreach($rooms as $room)
                                                        <option value="{{$room->id}}">{{$room->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">

                                            <div class="form-group">
                                                <label for="date">Date</label>
                                                <input type="date" class="form-control" id="date[]" name="date[]" value="{{$reservation->date}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="startTime">Start Time:</label>
                                                <input type="time" class="form-control" id="startTime[]" name="startTime[]" value="{{$reservation->start_time}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="EndTime">End Time:</label>
                                                <input type="time" class="form-control" id="endTime[]" name="endTime[]" value="{{$reservation->end_time}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <input type="submit" name="submit" class="btn btn-primary" style="margin-top:25px;" value="Edit"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
