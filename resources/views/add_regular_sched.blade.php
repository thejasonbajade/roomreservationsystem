@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($rooms as $room)
                <a role="button" class="addSchedButton" id="{{$room->id}}" data-dismiss="modal" data-toggle="modal" data-target="#addScheule"> {{ $room->name }} </a>
            @endforeach

            <div id="addScheule" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content" style="text-align:left;">
                        <div class="modal-header" style="background-color:#e74c3c;color:white;">
                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                            <p class="modal-title"><strong>&nbsp; Add Regular Shedule </strong></p>
                        </div>
                        <div class="modal-body" >
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{url('/collegeSecretary/process_add_regular_schedule')}}" method="post" id="addRegularSched">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="{{$room->id}}" name="roomID" id="roomID">
                                            <div class="col-md-3" style="padding: 5px">
                                                <div class="form-group">
                                                    <label for="startTime">Start Time</label>
                                                    <input type="time" class="form-control" id="startTime1" name="startTime[]">
                                                </div>
                                            </div>
                                            <div class="col-md-3" style="padding: 5px">
                                                <div class="form-group">
                                                    <label for="EndTime">End Time</label>
                                                    <input type="time" class="form-control" id="endTime1" name="endTime[]">
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="padding: 5px">
                                                <div class="form-group">
                                                    {{--<label for="days">Days</label>--}}
                                                    <label class="checkbox-inline"><input type="checkbox" name="days1[0]" value="Monday"> M </label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="days1[1]" value="Tuesday"> T </label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="days1[2]" value="Wednesday"> W </label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="days1[3]" value="Thursday"> Th </label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="days1[4]" value="Friday"> F </label>
                                                    <label class="checkbox-inline"><input type="checkbox" name="days1[5]" value="Saturday"> S </label>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default" id="addSched" style="background-color:#e74c3c;color:white;width:100px;text-align:center;" form="addRegularSched"> Add </button>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('room'))
            <div class="modal modal-transparent fade" id="successModal">
                <div class="modal-dialog" style="width:300px;height:60px;">
                    <div class="modal-content">
                        <div class="modal-header" style="background-color:#e74c3c;padding:3px;margin-bottom:10px;">
                            <p style="color:white;font-size:18px;text-align:center;margin-top:3px;">Success!</p>
                        </div>
                        <div class="modal-body" style="padding:10px;display:inline;">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p>Schedule for Room {{session('room')->name}} successfully added.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="OK" data-placement="bottom" style="display:inline;margin:0px 0px 10px 10px;width:100px;" >OK</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <script>
        $(document).ready(function() {
            if($('#successModal')) {
                $('#successModal').modal('show');
            }

            $('.addSchedButton').click(function () {
                var id = $(this).attr('id');
                $('#roomID').val(id);
            })
        });
    </script>
@endsection