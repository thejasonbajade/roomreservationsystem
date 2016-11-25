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
							<th><i class="fa fa-calendar-plus-o" aria-hidden="true"></i>&nbsp;Date</th>
							<th>Room</th>
							<th>Start Time</th>
							<th>End Time</th>
							<th>Date Filed </th>
							<th>Action</th>
						</tr>
	  					@foreach ($requests as $request)
						<tr>
							<td class="text-warning">Pending</td>
							<td>Nov 1, 2016</td>
							<td>R101</td>
							<td>01:00 PM</td>
							<td>02:30 PM</td>
							<td>Nov 23, 2016 05:23 AM</td>
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
<script>
	$(document).ready(function() {

		$('[id^=decline_button]').click(function(){   
            $.ajax({
                  url: "{{url('/')}}/collegeSecretary/set_declined/"+this.value, 
                  success: function(result){
                      console.log(result);
                  }
              });
		 	console.log(this.value);
		});

		$('[id^=approve_button]').click(function(){   
            $.ajax({
                  url: "{{url('/')}}/collegeSecretary/set_approved/"+this.value, 
                  success: function(result){
                      console.log(result);
                  }
              });
		 	console.log(this.value);
		});
	});
</script>
@endsection
