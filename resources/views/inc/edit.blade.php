<div id="editEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="editForm">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Edit Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="id" name="id">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" id="name" class="form-control" required>
						<span class="text-danger" id="nameErr"></span>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" id="email" class="form-control" required>
						<span class="text-danger" id="emailErr"></span>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="address" id="address" required></textarea>
						<span class="text-danger" id="addressErr"></span>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" id="phone" class="form-control" required>
						<span class="text-danger" id="phoneErr"></span>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-info" value="Save">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function editEmployee(id){
		$.get('employee/'+id, function(employee){
			$("#id").val(employee.id);
			$("#name").val(employee.name);
			$("#email").val(employee.email);
			$("#address").val(employee.address);
			$("#phone").val(employee.phone);
			$("#editEmployeeModal").modal("toggle");
		})
	}

	$("#editForm").submit(function(e){
		e.preventDefault();
		var id = $("#id").val();
		var name = $("#name").val();
		var email = $("#email").val();
		var address = $("#address").val();
		var phone = $("#phone").val();
		var _token = $("input[name=_token]").val();

		$.ajax({
			url:"{{route('employee.edit')}}",
			type:"PUT",
			data:{
				id:id,
				name:name,
				email:email,
				address:address,
				phone:phone,
				_token:_token
			},
			success:function(response){
				$('#sid'+response.id+' td:nth-child(2)').text(response.name);
				$('#sid'+response.id+' td:nth-child(3)').text(response.email);
				$('#sid'+response.id+' td:nth-child(4)').text(response.address);
				$('#sid'+response.id+' td:nth-child(5)').text(response.phone);
				$('#editEmployeeModal').modal('toggle');
				$('#editForm')[0].reset();
			},
			error:function(error){
				if(typeof name === 'undefined'){
					$("#nameErr").text('Name must be included!');
				}
				if(typeof address === 'undefined'){
					$("#addressErr").text('Address must be included!');
				}
				$("#emailErr").text('Email must be unique');
				$("#phoneErr").text('Phone Number must be unique');
			}

		});

	});
</script>