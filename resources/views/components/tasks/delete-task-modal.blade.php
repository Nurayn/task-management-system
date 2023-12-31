<div id="deleteTaskModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="deleteTaskModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-confirm">
		<div class="modal-content">
			<div class="modal-header flex-column">
				<div class="icon-box">
					<i class="material-icons">&#xE5CD;</i>
				</div>
				<h4 class="modal-title w-100">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
				<p>Do you really want to delete these records? This process cannot be undone.</p>
			</div>
			<div class="modal-footer justify-content-center">
                <form id="deleteTaskForm">
                    @csrf
                    <input type="hidden" name="id" id="delete-task-id">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
				<button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
		</div>
	</div>
</div>
