@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Reservations</b></div>
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
								<td><a class="reservationEdit" class="text-warning" id="{{$reservation->id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: green; cursor: pointer;"></i></a>
									<a href="{{url('/teacher/cancelReservation/'.$reservation->id)}}" class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
								</td>
							</tr>
						@endforeach
						</table>
				</div>
			</div>
		<div class="col-md-8 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><b>Reserve Rooms</b></div>

				<div class="panel-body">
				<button class="btn btn-xs btn-primary" id="addRoom" style="margin-left: 4%;">Add Room</button>
					<form role="form" action="{{url('/teacher/reserveRoom')}}" method="GET" id="submitReservation">
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
								<div class="col-md-4">

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
				</div>
			</div>
		</div>


		<div class="modal fade" id="cancelReservationModal" role="dialog">
			<div class="modal-dialog" style="width:300px;height:50px;">
				<div class="modal-content" >
					<div class="modal-header" style="background-color:#e74c3c;padding:3px;margin-bottom:10px;">
						<p style="color:white;font-size:18px;text-align:center;margin-top:3px;">Delete</p>
					</div>
					<div class="modal-body" style="padding:10px;display:inline;">
						{{----}}
						<button type="button" id="cancelReservationURL" number="" data-dismiss="modal" class="btn btn-danger btn-ok" style="display:inline;margin:0px 10px 10px 30px;width:100px;">Yes</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Cancel" data-placement="bottom" style="display:inline;margin:0px 0px 10px 10px;width:100px;" >No</button>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Edit Request</h4>
					</div>
					<div class="modal-body">
						<label>Status:</label><p id="status"></p>
						<label>Date:</label><p id="filedDate"></p>
						<form role="form" method="GET" id="editURL">
							{{ csrf_field() }}
							<div>
								<div>
									<div class="col-md-2">
										<div class="form-group">
											<label for="room">Room</label>
											<select class="form-control" id="roomID" name="roomID">
												@foreach($rooms as $room)
													<option value="{{$room->id}}">{{$room->name}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="col-md-3">

										<div class="form-group">
											<label for="date">Date</label>
											<input type="date" class="form-control" id="date" name="date">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="startTime">Start Time:</label>
											<input type="time" class="form-control" id="startTime" name="startTime">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="EndTime">End Time:</label>
											<input type="time" class="form-control" id="endTime" name="endTime">
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
					</div>
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
