@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @foreach($rooms as $room)
            <a role="button" class="addSchedButton" id="{{$room->id}}" data-dismiss="modal" data-toggle="modal" data-target="#addScheule"> {{ $room->name }} </a>
        @endforeach
        <div id="addScheule" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content" style="text-align:left;">
                    <div class="modal-header" style="background-color:#636b6f;color:white;">
                        <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                        <p class="modal-title"><strong>&nbsp; Add Regular Shedule </strong></p>
                    </div>
                    <div class="modal-body" >
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-xs btn-primary" id="addSchedule" style="margin-left: 4%;">Add Schedule</button>
                                    <form action="{{url('/collegeSecretary/process_add_regular_schedule')}}" method="post" id="addRegularSched">
                                        {{ csrf_field() }}
                                        <input type="hidden" value="{{$room->id}}" name="roomID" id="roomID">
                                        <div id="scheduleDiv">
                                            <div id="scheduleFields" class="col-md-12" number="1">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="startTime">Start Time</label>
                                                        <input type="time" class="form-control" id="checkStartTime1" name="startTime[]">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="EndTime">End Time</label>
                                                        <input type="time" class="form-control" id="checkEndTime1" name="endTime[]">
                                                    </div>
                                                    <p id="timeWarning1"></p>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group">
                                                        <label for="days1">Days</label><br/>
                                                        <label class="checkbox-inline"><input type="checkbox" name="days1[0]" value="Monday"> M </label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="days1[1]" value="Tuesday"> T </label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="days1[2]" value="Wednesday"> W </label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="days1[3]" value="Thursday"> Th </label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="days1[4]" value="Friday"> F </label>
                                                        <label class="checkbox-inline"><input type="checkbox" name="days1[5]" value="Saturday"> S </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="addSched" style="color:white;width:100px;text-align:center;" form="addRegularSched"> Add </button>
                    </div>
                </div>
            </div>
        </div>

        @if (session('room'))
        <div class="modal modal-transparent fade" id="successModal">
            <div class="modal-dialog" style="width:300px;height:60px;">
                <div class="modal-content">
                    <div class="modal-header" style="background-color:#636b6f;padding:3px;margin-bottom:10px;">
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
        var count = 2;
        var isConflict = false;

        if($('#successModal')) {
            $('#successModal').modal('show');
        }

        $('#scheduleDiv').on('focusout', "[id^='check']", function () {
            var number = $(this).parent('div').parent('div').parent('div').attr('number');
            if($('#checkEndTime'+number).val() && $('#checkStartTime'+number).val()) {
                var t = new Date();
                d = t.getDate();
                m = t.getMonth() + 1;
                y = t.getFullYear();

                var endTime = new Date(m + "/" + d + "/" + y + " " + $('#checkEndTime'+number).val());
                var startTime = new Date(m + "/" + d + "/" + y + " " + $('#checkStartTime'+number).val());
                if(endTime.getTime() <= startTime.getTime()) {
                    console.log('conflict');
                    $('#timeWarning'+number).html('Invalid time.');
                    isConflict = true;
                } else {
                    $('#timeWarning'+number).html('');
                    isConflict = false;
                }
            }
        });

        $('.addSchedButton').click(function () {
            var id = $(this).attr('id');
            $('#roomID').val(id);
        })

        $('#addSchedule').click(function () {

            $('#scheduleDiv').append(
                "<div id='scheduleFields' class='col-md-12' number='" + count+ "'> " +
                "<div class='col-md-3'>" +
                "<div class='form-group'>" +
                "<input type='time' class='form-control' id='startTime" + count + "' name='startTime[]'> " +
                "</div> " +
                "</div> " +
                "<div class='col-md-3'> " +
                "<div class='form-group'> " +
                "<input type='time' class='form-control' id='endTime" + count + "' name='endTime[]'> " +
                "</div> " +
                "<p id='timeWarning" + count + "'></p>" +
                "</div> " +
                "<div class='col-md-5'> " +
                "<div class='form-group'> " +
                "<label class='checkbox-inline'><input type='checkbox' name='days" + count + "[0]' value='Monday'> M </label> " +
                "<label class='checkbox-inline'><input type='checkbox' name='days" + count + "[1]' value='Tuesday'> T </label> " +
                "<label class='checkbox-inline'><input type='checkbox' name='days" + count + "[2]' value='Wednesday'> W </label> " +
                "<label class='checkbox-inline'><input type='checkbox' name='days" + count + "[3]' value='Thursday'> Th </label> " +
                "<label class='checkbox-inline'><input type='checkbox' name='days" + count + "[4]' value='Friday'> F </label> " +
                "<label class='checkbox-inline'><input type='checkbox' name='days" + count + "[5]' value='Saturday'> S </label> " +
                "</div> " +
                "</div> " +
                "<div class='col-md-1'>" +
                "<a href='#' class='remove text-danger'><b>x</b></a>" +
                "</div> " +
                "</div>"
            );
            count++;
        });

        $('#scheduleDiv').on('click', ".remove", function (e) {
            e.preventDefault();
            $(this).parent('div').parent('div').remove();
            count--
        });

        $('#addRegularSched').submit(function (e) {
            if(isConflict == true) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection