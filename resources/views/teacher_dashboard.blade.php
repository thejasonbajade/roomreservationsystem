@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Dashboard</div>

				<div class="panel-body">
				<button class="btn btn-primary" id="addRoom">Add Room</button>
					<form role="form" action="{{url('/reserveRoom')}}" method="GET" id="submitReservation">
						{{ csrf_field() }}
						<div id="reservationDiv">
							<div id="reservationField1" number="1" class="col-md-12">
								<div class="col-md-2">
									<div class="form-group">
										<label for="room">Room</label>
										<select class="form-control" id="roomID1" name="roomID[]">
											@foreach($rooms as $room)
												<option value="{{$room->id}}">{{$room->name}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-md-3">

									<div class="form-group">
										<label for="date">Date</label>
										<input type="date" class="form-control" id="date1" name="date[]" placeholder="MTh">
									</div>
									<p id="dateWarning1"></p>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="startTime">Start Time:</label>
										<input type="time" class="form-control" id="startTime1" name="startTime[]" placeholder="7:30-8:00">
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="EndTime">End Time:</label>
										<input type="time" class="form-control" id="endTime1" name="endTime[]" placeholder="7:30-8:00">
									</div>
								</div>
								<div class="col-md-1">
									<p id="status1" class="text-success"></p>
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
							<td><a class="reservationEdit" class="text-warning" id="{{$reservation->id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								<a href="{{url('/cancelReservation/'.$reservation->id)}}" class="text-danger"><i class="fa fa-times" aria-hidden="true"></i></a>
							</td>
						</tr>
					@endforeach
					</table>
				</div>
			</div>
		</div>

		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					</div>
					<div class="modal-body">
						Status:<p id="status"></p>
						Date:<p id="filedDate"></p>
						<form role="form" method="GET" id="editURL">
							{{ csrf_field() }}
							<div>
								<div>
									<div class="col-md-3">
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
							<input type="submit" name="submit" class="btn btn-primary" style="margin-top:25px;" value="Edit"/>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
	<script type="text/javascript">
		$(document).ready(function() {
			var isConflict = false;

			$('#reservationDiv').on('focusout', "[id^='date']", function () {
				var number = $(this).parent('div').parent('div').parent('div').attr('number');
				var dateApplied = new Date($(this).val());
				var currentDate = new Date();
				dateApplied.setDate(dateApplied.getDate()-3);
				console.log(dateApplied);
				if(!(dateApplied >= currentDate)) {
					console.log('Reserved 3 days before');
					$('#dateWarning'+number).html('Reservation must be filed at least 3 days before.');
					var isConflict = true;
				} else {
					console.log('Late');
					$('#dateWarning'+number).html('Date OK');
					var isConflict = false;
				}
			});

			$('.reservationEdit').click(function () {
				var id = $(this).attr('id');
				$.ajax({
					url: "{{url('/editReservation')}}"+"/"+id,
					type: 'GET',
					dataType: 'json',
					success: function (data) {
						console.log(data)
						$("#editURL").attr('action', "{{url('/processditReservation')}}"+"/"+id);
						$("#status").html(data.reservation.status);
						$("#filedDate").html(new Date(data.reservation.created_at));
						$("#roomID").val(data.reservation.room_id);
						$("#date").val(data.reservation.date);
						$("#startTime").val(data.reservation.start_time);
						$("#endTime").val(data.reservation.end_time);
					},
					error: function (xhr, textStatus, thrownError) {
						console.log("ERROR:",  thrownError);
					}
				});
			});

			$('#reservationDiv').on("focusout", "[id^='reservationField']", function () {
					var number = $(this).attr('number');
					console.log('Number: ', number);
					$.ajax({
					url: '{{url('/checkReservationConflict')}}',
					type: 'POST',
					data: {
						'roomID': $('#roomID'+number).val(),
						'date': $('#date'+number).val(),
						'startTime': $('#startTime'+number).val(),
						'endTime': $('#endTime'+number).val()
					},
					dataType: 'json',
					success: function (data) {
						if(data.conflict == true
								&& $('#startTime'+number).val() != ''
								&& $('#endTime'+number).val() != ''
								&& $('#date'+number).val() != '') {
							$('#status'+number).html("Conflict")
							$('#status'+number).removeClass().addClass('text-danger');
							isConflict = true;
						} else {
							$('#status'+number).html("No Conflict")
							$('#status'+number).removeClass().addClass('text-sucess');
							isConflict = false;
						}
						console.log("Success");
					},
					error: function (xhr, textStatus, thrownError) {
						console.log("ERROR:",  thrownError);
					}
				});
		});

			var reservationCount = 2;
			$("#addRoom").click(function () {
				$("#reservationDiv").append(
						"<div id='reservationField" + reservationCount + "' number='" + reservationCount + "' class='col-md-12'>" +
						"<div class='col-md-2'> " +
						"<div class='form-group'> " +
						"<select class='form-control' id='roomID"+ reservationCount + "' name='roomID[]'> " +
						"@foreach($rooms as $room)" +
						"<option value='{{$room->id}}'>{{$room->name}}</option>" +
						"@endforeach" +
						"</select>" +
						"</div> " +
						"</div> " +
						"<div class='col-md-3'> " +
						"<div class='form-group'> " +
						"<input type='date' class='form-control' id='date"+ reservationCount +"' name='date[]' placeholder='MTh'> " +
						"</div>" +
						"<p id='dateWarning" + reservationCount + "'></p>" +
						"</div> " +
						"<div class='col-md-3'> " +
						"<div class='form-group'> " +
						"<input type='time' class='form-control' id='startTime" + reservationCount + "' name='startTime[]' placeholder='7:30-8:00'> " +
						"</div> " +
						"</div> " +
						"<div class='col-md-3'> " +
						"<div class='form-group'> " +
						"<input type='time' class='form-control' id='endTime" + reservationCount + "' name='endTime[]' placeholder='7:30-8:00'> " +
						"</div> " +
						"</div>" +
						"<div class='col-md-1'>" +
						"<p id='status" + reservationCount + "' class='text-success'></p>" +
						"<a href='#' class='remove text-danger'><b>x</b></a>" +
						"</div>" +
						"</div>"
				)
				reservationCount++;
			});

			$('#reservationDiv').on('click', ".remove", function (e) {
				e.preventDefault();
				$(this).parent('div').parent('div').remove();
				reservationCount--
			});

			$('#submitReservation').submit(function (e) {
				if(isConflict == true) {
					e.preventDefault();
				}
			});
		});
	</script>
@endsection