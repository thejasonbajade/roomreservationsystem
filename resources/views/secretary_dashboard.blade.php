@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
   <div class="col-md-12">
                <input type="hidden" value="{{$activeSem->id}}" id="activeSem"/>

                <div class='panel-heading col-md-3 pull-right'>
				<select id="ayID" name="ayID" class="form-control" disabled >
			
					<option value="{{$activeSem->start_year}},{{$activeSem->end_year}}" {{$activeSem->start_year}} - {{$activeSem->end_year}}>				
					{{$activeSem->start_year}} - {{$activeSem->end_year}}</option>
				
					<option value="{{$activeSem->start_year+1}},{{$activeSem->end_year+1}}">				
					{{$activeSem->start_year+1}} - {{$activeSem->end_year+1}}</option>

				</select>

										<select id="semID" name="semID" class="form-control" disabled>
	
											<option value="First Semester"@if($activeSem->semester=='First Semester') {{'selected'}} @endif>First Semester</option>
										
											<option value="Second Semester"@if($activeSem->semester=='Second Semester') {{'selected'}} @endif>Second Semester</option>
										
										<!-- 	<option value="Summer">Summer</option>
										
											<option value="First Trimester">First Trimester</option>
										
											<option value="Second Trimester">Second Trimester</option>
										
											<option value="Third Trimester">Third Trimester</option>
										
											<option value="Midyear">Midyear</option> -->
									</select>
				<!-- Add button -->
					<button id="editButton" type="button" class="btn btn-default btn-md pull-right" >Edit</button>
				<!-- End of Add button -->

						</div>
	            </div>
        <div class="col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading"><b>Pending Requests</b></div>

             
                </div>


                <div class="panel-body">
					<table class="table table-hover tablesorter" id="reserveTable">
						<tbody><tr>
							<th>Status</th>
							<th><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;Date</th>
							<th>Room</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Date Filed </th>
							<th>Action</th>
						</tr>
	  					@foreach ($requests as $request)
						<tr>
							<td id="{{ 'status'.$request->id }}" class="text-warning">{{$request->status}}</td>
							<td>{{ date("M j, Y", strtotime($request->date)) }}</td>
							<td>{{$request->room_id}}</td>
							<td>{{ date("h:i A", strtotime($request->start_time)) }}</td>
							<td>{{ date("h:i A", strtotime($request->end_time)) }}</td>
							<td>{{ $request->created_at->format('M d, Y h:i A') }}</td>
							<td>
  							<div style="display:inline;text-align:center;">
  								<button type='button' @if($request->status!='Pending') {{'disabled'}} @endif class="btn bg-primary btn-default button" data-toggle="modal" title="Approve" style="color:#2ecc71;" data-backdrop="static" data-target="{{ '#'.'approve'.$request->id }}"><i class="fa fa-check" aria-hidden="true"></i></button>
  								
  								<button type='button' @if($request->status!='Pending') {{'disabled'}} @endif class="btn btn-default button" title="Decline" data-toggle="modal" data-backdrop="static" data-target="{{ '#'.'decline'.$request->id }}"  style="color:#e74c3c;font-size:15px;"><i class="fa fa-times" aria-hidden="true" ></i></button>
  							</div>
							</td>
						</tr>
						@endforeach
						</tbody>
					</table>


					  		<!--Approve Modal -->
					  		@if($requests != "")
					  		<?php $x = 0; ?>
					  		@foreach($requests as $request)
					  		<div class="modal fade" id="{{ 'approve'.$request->id }}" role="dialog">
					  			<div class="modal-dialog" style="width:300px;height:50px;">
					  				<div class="modal-content" >
					  					<div class="modal-header" style="background-color:#636b6f;padding:3px;margin-bottom:10px;">
					  						<p style="color:white;font-size:18px;text-align:center;margin-top:3px;">Approve</p>
					  					</div>
					  					<div class="modal-body" style="padding:10px;display:inline;">
				  							<button type="button"  value="{{ $request->id }}" id="{{'approve_button'.$request->id }}" data-dismiss="modal" class="btn btn-success btn-ok" style="display:inline;margin:0px 10px 10px 30px;width:100px;">Yes</button>
					  						<button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="tooltip" title="Cancel" data-placement="bottom" style="display:inline;margin:0px 0px 10px 10px;width:100px;" >No</button>
					  					</div>
					  				</div>
					  			</div>
					  		</div>

					  		<!-- Decline Modal -->
					  		<div class="modal modal-transparent fade" id="{{ 'decline'.$request->id }}" role="dialog">
					  			<div class="modal-dialog" style="width:300px;height:60px;">
					  				<div class="modal-content">
					  					<div class="modal-header" style="background-color:#636b6f;padding:3px;margin-bottom:10px;">
					  						<p style="color:white;font-size:18px;text-align:center;margin-top:3px;">Decline</p>
					  					</div>
					  					<div class="modal-body" style="padding:10px;display:inline;">
				  							<button type="button"  value="{{ $request->id }}" id="{{'decline_button'.$request->id }}" data-dismiss="modal" class="btn btn-danger btn-ok" style="display:inline;margin:0px 10px 10px 30px;width:100px;">Yes</button>
					  						<button type="button" class="btn btn-warning" data-dismiss="modal" data-toggle="tooltip" title="Cancel" data-placement="bottom" style="display:inline;margin:0px 0px 10px 10px;width:100px;" >No</button>
					  					</div>
					  				</div>
					  			</div>
					  		</div>
					  	@endforeach
					  	@endif

				</div>
            </div>
        </div>
    </div>
</div>
		<!-- MODAL -->
		<div id="addEmp" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content" style="text-align:left;">
					<div class="modal-header" style="background-color:#636b6f;color:white;">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
						<p class="modal-title"><strong><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Add Teacher Account</strong></p>
					</div>
					<div class="modal-body" >
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">

								<form class="form-horizontal" role="form" method="POST" action="{{url('/')}}/collegeSecretary/add_teacher" id="addTeacher">
									{{ csrf_field() }}

									<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
										<label for="name" class="col-md-4 control-label">Name</label>

										<div class="col-md-6">
											<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

											@if ($errors->has('name'))
												<span class="help-block">
													<strong>{{ $errors->first('name') }}</strong>
												</span>
											@endif
										</div>
									</div>

									<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
										<label for="email" class="col-md-4 control-label">E-Mail Address</label>

										<div class="col-md-6">
											<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

											@if ($errors->has('email'))
												<span class="help-block">
													<strong>{{ $errors->first('email') }}</strong>
												</span>
											@endif
										</div>
									</div>

									<div class="form-group">
										<label for="email" class="col-md-4 control-label">Division</label>

										<div class="col-md-6">
											<select class="form-control" name="divisionID" id="divisionID">
												@foreach($divisions as $division)
													<option value="{{$division->id}}">{{$division->name}}</option>
												@endforeach
											</select>

										</div>
									</div>

									<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" style="display: none">
										<label for="password" class="col-md-4 control-label">Password</label>

										<div class="col-md-6">
											<input id="password" type="password" class="form-control" name="password" required>

											@if ($errors->has('password'))
												<span class="help-block">
													<strong>{{ $errors->first('password') }}</strong>
												</span>
											@endif
										</div>
									</div>

									<div class="form-group" style="display: none">
										<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

										<div class="col-md-6">
											<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
										</div>
									</div>
								</form>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" id="addEmp" form="addTeacher"> Add </button>
						</div>
					</div>
				</div>
			</div>
			</div>
		</div>

		<!-- END OF MODAL -->

		<!-- MODAL -->
		@if(session('teacher'))
		<div id="teacherProfile" class="modal fade" role="document" >
			<div class="modal-dialog">
				<div class="modal-content" style="text-align:left;">
					<div class="modal-header" style="background-color:#636b6f;color:white;">
						<button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
						<p class="modal-title"><strong><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp; Teacher Profile </strong></p>
					</div>
					<div class="modal-body" >
						<div class="container-fluid">
							<div class="row">
								<div class="col-md-12">
									<p>Name: {{session('teacher')->name}}</p>
									<p>Division: {{session('teacher')->division->name}}</p>
									<p>Email: {{session('teacher')->email}}</p>
									<p>Temporary Password: {{session('teacher')->password}}</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		@endif
				<!-- END OF MODAL -->
<script>
	$(document).ready(function() {
		if($('#teacherProfile')) {
			$('#teacherProfile').modal('show');
		}


	  	// $("#reserveTable").tablesorter({ 
    //     // pass the headers argument and assing a object 
    //     headers: { 
    //         // assign the secound column (we start counting zero) 
    //         } 
    //       }); 

		$('[id^=decline_button]').click(function(){
			var id = this.value;
            $.ajax({
                  url: "{{url('/')}}/collegeSecretary/set_declined/"+this.value, 
                  success: function(result){
                      console.log(result);
					  $("#status"+id).text($.parseJSON(result));
                  }
              });
		 	console.log(this.value);
		});

		$('[id^=approve_button]').click(function(){
			var id = this.value;
            $.ajax({
                  url: "{{url('/')}}/collegeSecretary/set_approved/"+this.value, 
                  success: function(result){
                      console.log(result);
                 	  $("#status"+id).text($.parseJSON(result));
                  }
              });
		 	console.log(this.value);
		});

			$("#editButton").on('click', editSem)

			function editSem(){
				$("#ayID").prop('disabled', false);
				$("#semID").prop('disabled', false);
				$("#editButton").text('Save');
			    $("#editButton").off('click').on('click', saveSem)
				console.log('kek');
			}

			function saveSem() {
				$("#ayID").prop('disabled', true);
				$("#semID").prop('disabled', true);
				$("#editButton").text('Edit');
				var year = $('#ayID').find(":selected").val();
				var semester = $('#semID').find(":selected").val();
				var activeSem = $('#activeSem').val();
	            $.ajax({
	                  url: "{{url('/')}}/collegeSecretary/set_semester", 
	                  data: {'semester':semester, 'year':year, 'activeSem':activeSem, "_token": "{{ csrf_token() }}" },
	                  type: "POST",
	                  dataType:'json',
	                  success: function(result){
	                      console.log(result);
	                      location.reload();
	                  }
	              });
			    $("#editButton").off('click').on('click', editSem);
			}

		$('#divisionID').focusout(function(){
			chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"
			var result = '';
			for (var i = 8; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
			$('#password').val(result);
			$('#password-confirm').val(result);
			console.log(result);
		});
	});
</script>
@endsection

