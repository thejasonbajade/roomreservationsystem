@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
				<button class="btn btn-primary" id="addRoom">Add Room</button>
					<form role="form" action="{{url('/reserveRoom')}}" method="GET">
						{{ csrf_field() }}
						<div id="reservationFields">
							<div>
								<div class="col-md-2">
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
										<input type="date" class="form-control" id="date[]" name="date[]" placeholder="MTh">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="startTime">Start Time:</label>
										<input type="time" class="form-control" id="startTime[]" name="startTime[]" placeholder="7:30-8:00">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="EndTime">End Time:</label>
										<input type="time" class="form-control" id="endTime[]" name="endTime[]" placeholder="7:30-8:00">
									</div>
								</div>
                                <div class="col-md-1">
									<p id="status"></p>
                                </div>
							</div>
						</div>
                        <div class="col-md-3 col-md-offset-9">
						    <input type="submit" name="submit" class="btn btn-block btn-primary" style="margin-top:25px;" value="Add"/>
                        </div>
					</form>
					<table class="table table-hover">
						<tr>
							<th>Status</th>
							<th>Date</th>
							<th>Room</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Date Filed </th>
							<th></th>
						</tr>
					@foreach($reservations as $reservation)
						<tr>
							<td class="text-warning">{{ $reservation->status }}</td>
							<td>{{ date("M j, Y", strtotime($reservation->date)) }}</td>
							<td>{{ $reservation->room->name }}</td>
							<td>{{ date("h:i A", strtotime($reservation->start_time)) }}</td>
							<td>{{ date("h:i A", strtotime($reservation->end_time)) }}</td>
							<td>{{ $reservation->created_at->format('M d, Y h:i A') }}</td>
							<td><a href="{{url('/editReservation/'.$reservation->id)}}" class="text-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="{{url('/cancelReservation/'.$reservation->id)}}" class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
					@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript">
		$(document).ready(function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('[name="_token"]').val()
				}
			});
			$('#reservationFields').click(function () {
				{{--$.ajax({--}}
					{{--url: '{{url('/checkReservationConflict')}}',--}}
					{{--data: {--}}
						{{--'_token': $('[name="_token"]').val(),--}}
						{{--'roomID': 1--}}
{{--//						date: $('#date').val(),--}}
{{--//						startTime: $('#startTime').val(),--}}
{{--//						endTime: $('#endTime').val()--}}
					{{--},--}}
					{{--type: 'POST',--}}
					{{--success: function (data) {--}}
						{{--if(data.conflict == true) {--}}
							{{--$('#status').html("Conflict")--}}
						{{--}--}}
					{{--}--}}
				{{--})--}}

				$.post('{{url('/checkReservationConflict')}}', {'_token': $('[name="_token"]').val(),'roomID': 1}, function(response) {
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
	</script>
@endsection
