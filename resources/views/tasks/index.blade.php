@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        {{ __('Task List') }}
                        @can('create tasks')
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTaskModal">
                                Create Task
                            </button>
                        @endcan
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Due Date</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Priority</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-update-task-modal/>
    <x-create-task-modal/>
    <x-delete-task-modal/>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            let url;
            @if (auth()->user()->getRoleNames()->first() == 'admin')
                url = '{!! route('tasks.data') !!}';
            @else
                url = '{!! route('tasks.get') !!}';
            @endif
            // Populate Tasks List
            var dataTable = $('.table').DataTable({
                ajax: url,
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'due_date',
                        name: 'due_date'
                    },
                    {
                        data: 'location',
                        name: 'location',
                    },
                    {
                        data: 'priority',
                        name: 'priority'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                processing: true,
                serverSide: false,
            });

            function reloadTable() {
                dataTable.ajax.reload();
            }
            $(document).on('click', '.update-btn', function() {
                $("#id").val($(this).data("task-id"));
                $("#title_update").val($(this).data("task-title"));
                $("#description_update").val($(this).data("task-description"));
                $("#due_date_update").val($(this).data("task-due_date"));
                $("#location_update").val($(this).data("task-location"));
                $("#priority_update").val($(this).data("task-priority"));
                $("#user_id_update").val($(this).data("task-user_id"));
            });
            $(document).on('click', '.delete-btn', function() {
                $("#delete-task-id").val($(this).data("task-id"));
            });
            // Create a Task
            $('#createTaskForm').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: '{!! route('tasks.store') !!}',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Task created successfully');
                            $('#createTaskModal').modal('hide');
                            reloadTable();
                        } else {
                            toastr.error('Task creation failed');
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            }
                        }
                    },
                    error: function(error) {
                        toastr.error('An error occurred while processing your request');
                    }
                });
            });

            // Update a Task
            $('#updateTaskForm').submit(function(event) {
                event.preventDefault();
                var taskId = $("#id").val();
                $.ajax({
                    type: 'PUT',
                    url: '/tasks/' + taskId,
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Task Updated successfully');
                            $('#updateTaskModal').modal('hide');
                            reloadTable();
                        } else {
                            toastr.error('Task updation failed');
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            }
                        }
                    },
                    error: function(error) {
                        toastr.error('An error occurred while processing your request');
                    }
                });
            });

            // Delete a Task
            $('#deleteTaskForm').click(function(event) {
                event.preventDefault();
                var taskId = $("#delete-task-id").val();
                $.ajax({
                    type: 'DELETE',
                    url: '/tasks/' + taskId,
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Task deleted successfully');
                            $('#deleteTaskModal').modal('hide');
                            reloadTable();
                        } else {
                            toastr.error('Task deletion failed');
                            if (response.errors) {
                                $.each(response.errors, function(key, value) {
                                    toastr.error(value[0]);
                                });
                            }
                        }
                    },
                    error: function(error) {
                        toastr.error('An error occurred while processing your request');
                    }
                });
            });
        });
    </script>
@endpush
