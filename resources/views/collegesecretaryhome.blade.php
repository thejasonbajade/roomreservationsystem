@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
					<table class="table table-hover">
						<tbody><tr>
							<th>Status</th>
							<th>Date</th>
							<th>Room</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Date Filed </th>
							<th>Action</th>
						</tr>
						<tr>
							<td class="text-warning">Pending</td>
							<td>Nov 1, 2016</td>
							<td>R101</td>
							<td>01:00 PM</td>
							<td>02:30 PM</td>
							<td>Nov 23, 2016 05:23 AM</td>
							<td><a href="#" class="reservationEdit" id="1"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
						</tr>
						</tbody>
					</table>

				</div>
            </div>
        </div>
    </div>
</div>
@endsection
