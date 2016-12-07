@extends('layouts.app')

@section('content')
<div id="wrapper">
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
			<li><a href="#">
				<img src="images/UPVisayas.png" class="profile-picture" alt="icon"></img><span class="menu-title">{{ Auth::user()->name }}</span></a></li>
			<li><a href="#">Dashboard</a></li>
			<li><a href="#">View Requests</a></li>
			<li><a href="#">Add Teacher</a></li>
			<li><a href="{{ url('/logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a></li>
		</ul>
	</div>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

				<!-- Add button -->
				<div class="col-md-12" id="addBtn">
					<button type="button" class="btn btn-default btn-lg" id="add-button" data-backdrop="static" data-toggle="modal" data-target="#addEmp"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Add Teacher</button>
				</div>
				<!-- End of Add button -->

                <div class="panel-heading">Dashboard</div>
                <div class="col-xs-3">
                <input type="hidden" value="{{$activeSem->id}}" id="activeSem"/>
				<select id="ayID" name="ayID" class="form-control" disabled >
			
					<option value="{{$activeSem->start_year}},{{$activeSem->end_year}}" {{$activeSem->start_year}} - {{$activeSem->end_year}}>				
					{{$activeSem->start_year}} - {{$activeSem->end_year}}</option>
				
					<option value="{{$activeSem->start_year+1}},{{$activeSem->end_year+1}}">				
					{{$activeSem->start_year+1}} - {{$activeSem->end_year+1}}</option>

					<option value="{{$activeSem->start_year+1}},{{$activeSem->end_year+1}}">				
					{{$activeSem->start_year+2}} - {{$activeSem->end_year+2}}</option>				

					<option value="{{$activeSem->start_year+1}},{{$activeSem->end_year+1}}">				
					{{$activeSem->start_year+3}} - {{$activeSem->end_year+3}}</option>

					<option value="{{$activeSem->start_year+1}},{{$activeSem->end_year+1}}">				
					{{$activeSem->start_year+4}} - {{$activeSem->end_year+4}}</option>
				</select>

										<select id="semID" name="semID" class="form-control" disabled>
	
											<option value="First Semester"@if($activeSem->semester=='First Semester') {{'selected'}} @endif>First Semester</option>
										
											<option value="Second Semester"@if($activeSem->semester=='Second Semester') {{'selected'}} @endif>Second Semester</option>
										
											<option value="Summer">Summer</option>
										
											<option value="First Trimester">First Trimester</option>
										
											<option value="Second Trimester">Second Trimester</option>
										
											<option value="Third Trimester">Third Trimester</option>
										
											<option value="Midyear">Midyear</option>
									</select>
				<!-- Add button -->
				<div class="col-md-12">
					<button id="editButton" type="button" class="btn btn-default btn-md" >Edit</button>
				</div>
				<!-- End of Add button -->
	            </div>
                </div>

                <div class="panel-body">
					<table class="table table-hover">
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
							<td>{{$request->date}}</td>
							<td>{{$request->room_id}}</td>
							<td>{{$request->start_time}}</td>
							<td>{{$request->end_time}}</td>
							<td>{{$request->created_at}}</td>
							<td>
  							<div style="display:inline;text-align:center;">
  								<button  class="btn bg-primary btn-default button" data-toggle="modal" title="Approve" style="color:#2ecc71;" data-backdrop="static" data-target="{{ '#'.'approve'.$request->id }}"><i class="fa fa-check" aria-hidden="true"></i></button>
  								
  								<button { class="btn btn-default button" title="Decline" data-toggle="modal" data-backdrop="static" data-target="{{ '#'.'decline'.$request->id }}"  style="color:#e74c3c;font-size:15px;"><i class="fa fa-times" aria-hidden="true"></i></button>
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
					  					<div class="modal-header" style="background-color:#e74c3c;padding:3px;margin-bottom:10px;">
					  						<p style="color:white;font-size:18px;text-align:center;margin-top:3px;">Approve</p>
					  					</div>
					  					<div class="modal-body" style="padding:10px;display:inline;">
				  							<button type="button"  value="{{ $request->id }}" id="{{'approve_button'.$request->id }}" data-dismiss="modal" class="btn btn-danger btn-ok" style="display:inline;margin:0px 10px 10px 30px;width:100px;">Yes</button>
					  						<button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Cancel" data-placement="bottom" style="display:inline;margin:0px 0px 10px 10px;width:100px;" >No</button>
					  					</div>
					  				</div>
					  			</div>
					  		</div>

					  		<!-- Decline Modal -->
					  		<div class="modal modal-transparent fade" id="{{ 'decline'.$request->id }}" role="dialog">
					  			<div class="modal-dialog" style="width:300px;height:60px;">
					  				<div class="modal-content">
					  					<div class="modal-header" style="background-color:#e74c3c;padding:3px;margin-bottom:10px;">
					  						<p style="color:white;font-size:18px;text-align:center;margin-top:3px;">Decline</p>
					  					</div>
					  					<div class="modal-body" style="padding:10px;display:inline;">
				  							<button type="button"  value="{{ $request->id }}" id="{{'decline_button'.$request->id }}" data-dismiss="modal" class="btn btn-danger btn-ok" style="display:inline;margin:0px 10px 10px 30px;width:100px;">Yes</button>
					  						<button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="tooltip" title="Cancel" data-placement="bottom" style="display:inline;margin:0px 0px 10px 10px;width:100px;" >No</button>
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
</div>
		<!-- MODAL -->
		<div id="addEmp" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content" style="text-align:left;">
					<div class="modal-header" style="background-color:#e74c3c;color:white;">
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
							<button type="submit" class="btn btn-default" id="addEmp" style="background-color:#e74c3c;color:white;width:100px;text-align:center;" form="addTeacher"> Add </button>
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
					<div class="modal-header" style="background-color:#e74c3c;color:white;">
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

