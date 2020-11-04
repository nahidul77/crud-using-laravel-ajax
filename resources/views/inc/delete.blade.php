<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="deleteForm">
				@csrf
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	function deleteEmployee(id){
		$('#deleteEmployeeModal').modal("toggle");
		$('#deleteForm').submit(function(e){
			e.preventDefault();
			var _token = $("input[name=_token]").val();

			$.ajax({
				url:'employee/'+id,
				type:'DELETE',
				data:{
					_token:_token
				},
				success:function(response){
					$('#sid'+id).remove();
					$('#deleteEmployeeModal').modal("toggle");
				}
			});
		});

	}

	function deleteAllSelected(){
		$('#deleteEmployeeModal').modal("toggle");
		$('#deleteForm').submit(function(e){
			e.preventDefault();
			var _token = $("input[name=_token]").val();
			var allids = [];
			$("input:checkbox[name=ids]:checked").each(function(){
				allids.push($(this).val());
			});

			$.ajax({
				url:'{{route('employee.deleteSelected')}}',
				type:'DELETE',
				data:{
					ids:allids,
					_token:_token,
				},
				success:function(response){
					$.each(allids, function(key, val){
						$('#sid'+val).remove(); 
						$('#deleteEmployeeModal').modal("toggle");
					})
				}
			});

		});
	}
</script>