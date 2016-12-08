@extends('layouts.app')

@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
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
										<input type="date" class="form-control" id="date1" name="date[]" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="startTime">Start Time:</label>
										<input type="time" class="form-control" id="checkTimeStart1" name="startTime[]" required>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
										<label for="EndTime">End Time:</label>
										<input type="time" class="form-control" id="checkTimeEnd1" name="endTime[]" required>
									</div>
									<p id="timeWarning1"></p>
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

		<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading"><b>Reservations</b></div>
					<table class="table table-hover tablesorter" id="reservationsTable">
						<thead>
						<tr>
							<th>Status</th>
							<th>Date</th>
							<th>Room</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Date Filed </th>
						</tr>
						</thead>
						<tbody>
						@foreach($reservations as $reservation)

							<tr id="reservationID{{$reservation->id}}">
								<td class="text-warning">{{ $reservation->status }}</td>
								<td>{{ date("M j, Y", strtotime($reservation->date)) }}</td>
								<td>{{ $reservation->room->name }}</td>
								<td>{{ date("h:i A", strtotime($reservation->start_time)) }}</td>
								<td>{{ date("h:i A", strtotime($reservation->end_time)) }}</td>
								<td>{{ $reservation->created_at->format('M d, Y h:i A') }}</td>
								<td><a class="reservationEdit" class="text-warning" id="{{$reservation->id}}" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color: green; cursor: pointer;"></i></a>
									<a id="cancelReservation" class="text-danger" data-id="{{$reservation->id}}" role="button" data-toggle="modal" data-target="#cancelReservationModal"><i class="fa fa-times" aria-hidden="true"></i></a>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
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
					<form role="form" action="{{url('/teacher/processEditReservation/'.$reservation->id)}}" method="GET" id="editURL">
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
									<div class="col-md-4">

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
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
					</div>
						</form>
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

			$('#reservationDiv').on('focusout', "[id^='checkTime']", function () {
				var number = $(this).parent('div').parent('div').parent('div').attr('number');
				console.log('hallo')
				if($('#checkTimeEnd'+number).val() && $('#checktTimeStart'+number).val()) {
					console.log('passoook')
					var t = new Date();
					d = t.getDate();
					m = t.getMonth() + 1;
					y = t.getFullYear();

					var endTime = new Date(m + "/" + d + "/" + y + " " + $('#checkTimeEnd'+number).val());
					var startTime = new Date(m + "/" + d + "/" + y + " " + $('#checkTimeStart'+number).val());
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

			$('.reservationEdit').click(function () {
				var id = $(this).attr('id');
				$.ajax({
					url: "{{url('/teacher/editReservation')}}"+"/"+id,
					type: 'GET',
					dataType: 'json',
					success: function (data) {
						console.log(data)
						$("#editURL").attr('action', "{{url('/teacher/processEditReservation')}}"+"/"+id);
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
				url: '{{url('/teacher/checkReservationConflict')}}',
				type: 'POST',
				data: {
					'roomID': $('#roomID'+number).val(),
					'date': $('#date'+number).val(),
					'startTime': $('#checkTimeStart'+number).val(),
					'endTime': $('#checkTimeEnd'+number).val()
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
			});});

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
						"<input type='date' class='form-control' id='date"+ reservationCount +"' name='date[]' required> " +
						"</div>" +
						"<p id='dateWarning" + reservationCount + "'></p>" +
						"</div> " +
						"<div class='col-md-3'> " +
						"<div class='form-group'> " +
						"<input type='time' class='form-control' id='checkTimeStart" + reservationCount + "' name='startTime[]' required> " +
						"</div> " +
						"</div> " +
						"<div class='col-md-3'> " +
						"<div class='form-group'> " +
						"<input type='time' class='form-control' id='checkTimeEnd" + reservationCount + "' name='endTime[]' required> " +
						"</div> " +
						"<p id='timeWarning"+ reservationCount + "'></p>" +
						"</div>" +
						"<div class='col-md-1'>" +
						"<p id='status" + reservationCount + "' class='text-success'></p>" +
						"<a href='#' class='remove text-danger'><b>x</b></a>" +
						"</div>" +
						"</div>"
				)
				reservationCount++;
			});
			$('#reservationFields').on('click', ".remove", function (e) {
				e.preventDefault();
				$(this).parent('div').parent('div').remove();
				reservationCount--
			});

			$('#submitReservation').submit(function (e) {
				if(isConflict == true) {
					e.preventDefault();
				}
			});

			$('#editURL').submit(function (e) {
				if(isConflict == true) {
					e.preventDefault();
				}
			});
			$('#cancelReservation').click(function () {
				$('.modal-body #cancelReservationURL').attr('number', $(this).data('id'));
			});

			$("#cancelReservationURL").click(function () {
				var id = $(this).attr('number')
				$.ajax({
					url : "{{url('/teacher/cancelReservation')}}" + "/" + id,
					success: function (data) {
						if (data.status == 'Success') {
							$('#reservationID'+id).remove();
						}
					}
				})
			});
			
			$("#reservationsTable").tablesorter({
				headers: {
					6: { sorter: false }
			}});
		});
	</script>
@endsection
