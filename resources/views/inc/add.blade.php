<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="addForm">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Name</label>
						<input type="text" id="eName" name="name" class="form-control" required>
						<span class="text-danger" id="nameError"></span>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" id="eEmail" name="email" class="form-control" required>
						<span class="text-danger" id="emailError"></span>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea id="eAddress" class="form-control" name="address" required></textarea>
						<span class="text-danger" id="addressError"></span>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" id="ePhone" name="phone" class="form-control" required>
						<span class="text-danger" id="phoneError"></span>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function clearData(){
		$('#eName').val('');
		$('#eEmail').val('');
		$('#eAddress').val('');
		$('#ePhone').val('');
		$("#nameError").text('');
		$("#emailError").text('');
		$("#addressError").text('');
		$("#phoneError").text('');
	}

	$('#addForm').submit(function(e){
		e.preventDefault();

		var name = $("input[name=name]").val();
		var email = $("input[name=email]").val();
		var address = $("#eAddress").val();
		var phone = $("input[name=phone]").val();
		var _token = $("input[name=_token]").val();

		$.ajax({
			url:"{{route('employee.add')}}",
			type:"POST",
			data:{
				name:name, 
				email:email,
				address:address,
				phone:phone,
				_token:_token
			},
			success:function(response){
				clearData();
				var data = "";
				data = data + '<tr><td><span class="custom-checkbox"><input type="checkbox" id="checkbox'+response.id+'" name="options[]" value=""><label for="checkbox'+response.id+'"></label></span></td>';

				data = data + '<td>'+name+'</td>';
				data = data + '<td>'+email+'</td>';
				data = data + '<td>'+address+'</td>';
				data = data + '<td>'+phone+'</td>';

				data = data + '<td><a href="#" class="edit" onclick="editEmployee('+response.id+')"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';

				data = data + '<a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></td><tr>'

				$('#employeeTable tbody').prepend(data);
				$('#addEmployeeModal').modal('toggle');
				$('#employeeForm')[0].reset();
			},
			error:function(error){
				if(typeof name === 'undefined'){
					$("#nameError").text('Name must be included!');
				}
				if(typeof address === 'undefined'){
					$("#addressError").text('Address must be included!');
				}
				$("#emailError").text('Email must be unique');
				$("#phoneError").text('Phone Number must be unique');
			}

		})
	})
</script>