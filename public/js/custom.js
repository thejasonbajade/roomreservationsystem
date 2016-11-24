$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name="_token"]').val()
        }
    });
    $('#reservationFields').click(function () {
        // {{--$.ajax({--}}
        //     {{--url: '{{url('/checkReservationConflict')}}',--}}
        //     {{--data: {--}}
        //         {{--'_token': $('[name="_token"]').val(),--}}
        //         {{--'roomID': 1--}}
        //         {{--//						date: $('#date').val(),--}}
        //         {{--//						startTime: $('#startTime').val(),--}}
        //         {{--//						endTime: $('#endTime').val()--}}
        //         {{--},--}}
        //             {{--type: 'POST',--}}
        //             {{--success: function (data) {--}}
        //                 {{--if(data.conflict == true) {--}}
        //                     {{--$('#status').html("Conflict")--}}
        //                     {{--}--}}
        //                 {{--}--}}
        //             {{--})--}}
            var token = $('[name="_token"]').val();
            $.post('{{url('/checkReservationConflict')}}', {'_token': token, 'roomID': 1}, function(response) {
                console.log("Response:", response);
            });
        });

var reservationCount = 1;
$("#addRoom").click(function () {
    $("#reservationFields").append(
        "<div>" +
        "<div class='col-md-2'> " +
        "<div class='form-group'> " +
        "<select class='form-control' id='roomID[]' name='roomID[]'> " +
        "@foreach($rooms as $room)" +
        "<option value='{{$room->id}}'>{{$room->name}}</option>" +
        "@endforeach" +
        "</select>" +
        "</div> " +
        "</div> " +
        "<div class='col-md-3'> " +
        "<div class='form-group'> " +
        "<input type='date' class='form-control' id='date[]' name='date[]' placeholder='MTh'> " +
        "</div> " +
        "</div> " +
        "<div class='col-md-3'> " +
        "<div class='form-group'> " +
        "<input type='time' class='form-control' id='startTime[]' name='startTime[]' placeholder='7:30-8:00'> " +
        "</div> " +
        "</div> " +
        "<div class='col-md-3'> " +
        "<div class='form-group'> " +
        "<input type='time' class='form-control' id='endTime[]' name='endTime[]' placeholder='7:30-8:00'> " +
        "</div> " +
        "</div>" +
        "<div class='col-md-1'>" +
        "<a href='#' class='remove text-danger'><b>x</b></a>" +
        "</div>" +
        "</div>"
    )
    reservationCount++;
});
$('#reservationFields').on('click', ".remove", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
})
});