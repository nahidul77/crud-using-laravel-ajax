<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Employees</b></h2>
					</div>
					<div class="col-sm-6">
						<button type="button" data-target="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></button>
						<button type="button" onclick="deleteAllSelected()"  class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Delete</span></button>					
					</div>
				</div>
			</div>
			<table id="employeeTable" class="table table-striped table-hover table-bordered">
				<thead>
					<tr>
						<th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						<th>Name</th>
						<th>Email</th>
						<th>Address</th>
						<th>Phone</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($employees as $employee)
					<tr id="sid{{$employee->id}}">
						<td>
							<span class="custom-checkbox">
							<input type="checkbox" id="checkbox{{$employee->id}}" name="ids" value="{{$employee->id}}">
								<label for="checkbox{{$employee->id}}"></label>
							</span>
						</td>
						<td>{{$employee->name}}</td>
						<td>{{$employee->email}}</td>
						<td>{{$employee->address}}</td>
						<td>{{$employee->phone}}</td>
						<td>
							<a href="javascript:void(0)" onclick="editEmployee({{$employee->id}})" class="edit"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
							<a href="javascript:void(0)" onclick="deleteEmployee({{$employee->id}})" class="delete"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                        </td>
                    </tr>
                    @endforeach
				</tbody>
			</table>
		</div>
	</div>        
</div>

<script>
    $(document).ready(function () {
  $('#dtBasicExample').DataTable();
  $('.dataTables_length').addClass('bs-select');
});

</script>