    <div class="modal fade" id="updateTaskModal" tabindex="-1" role="dialog" aria-labelledby="updateTaskModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateTaskModalLabel">Update Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateTaskForm">
                    @csrf
                    <div class="modal-body">
                        @csrf
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title_update" name="title" required>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description_update" name="description" rows="3" required></textarea>
                        </div>

                        <!-- Due Date -->
                        <div class="form-group">
                            <label for="due_date">Due Date</label>
                            <input type="date" class="form-control" id="due_date_update" name="due_date" required>
                        </div>

                        <!-- Location (Latitude, Longitude) -->
                        <div class="form-group">
                            <label for="location">Location (Latitude, Longitude)</label>
                            <input type="text" class="form-control" id="location_update" name="location" pattern="-?\d+(\.\d+)?,-?\d+(\.\d+)?" placeholder="e.g., 40.7128,-74.0060" required>
                            <small class="form-text text-muted">Please enter latitude and longitude separated by comma (e.g., 40.7128,-74.0060).</small>
                        </div>

                        <!-- Priority (Select Box) -->
                        <div class="form-group">
                            <label for="priority">Priority</label>
                            <select class="form-control" id="priority_update" name="priority" required>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>

                        <!-- User (Select Box) -->
                        <div class="form-group">
                            <label for="user">Assign User</label>
                            <select class="form-control" id="user_id_update" name="user_id" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
