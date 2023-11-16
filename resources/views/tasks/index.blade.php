@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    {{ __('User List') }}
                    @can('create tasks')
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTaskModal">
                            Create Task
                        </button>                        
                    @endcan
                </div>
                <div class="card-body">
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
                            @foreach ($tasks as $task)
                            <tr>
                                <th scope="row">{{ $task->id }}</th>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->due_date }}</td>
                                <td>{{ implode(',',$task->location) }}</td>
                                <td>{{ $task->priority }}</td>
                                <td>{{ $task->user->name }}</td>
                                <td>
                                    {{-- <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary">View</a> --}}
                                    @can('edit tasks')
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateTaskModal"
                                    data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}" data-task-description="{{ $task->description }}" data-task-due_date="{{ $task->due_date }}" data-task-location="{{ implode(',',$task->location) }}" data-task-priority="{{ $task->priority }}" data-task-user_id="{{ $task->user_id }}"
                                    onclick="$('#title_update').val($(this).data('task-title'));$('#description_update').val($(this).data('task-description'));$('#due_date_update').val($(this).data('task-due_date'));$('#location_update').val($(this).data('task-location'));$('#priority_update').val($(this).data('task-priority'));$('#user_id_update').val($(this).data('task-user_id'));"
                                    >
                                        Edit Task
                                    </button>
                                    {{-- <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning">Edit</a>                                         --}}
                                    @endcan
                                    @can('delete tasks')
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>                                                                            
                                    @endcan
                                </td>
                            </tr>                                    
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
<x-update-task-modal :users="$users"/>
<x-create-task-modal :users="$users"/>
@endsection
@push('scripts')
    <script>
        // Create a Task
        $('#createTaskForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/tasks',
                data: $(this).serialize(),
                success: function(response) {
                    // Handle success
                },
                error: function(error) {
                    // Handle error
                }
            });
        });

        // Update a Task
        $('#updateTaskForm').submit(function(event) {
            event.preventDefault();
            $.ajax({
                type: 'PUT',
                url: '/tasks/' + taskId,
                data: $(this).serialize(),
                success: function(response) {
                    // Handle success
                },
                error: function(error) {
                    // Handle error
                }
            });
        });

        // Delete a Task
        $('.deleteTaskBtn').click(function() {
            var taskId = $(this).data('task-id');
            $.ajax({
                type: 'DELETE',
                url: '/tasks/' + taskId,
                success: function(response) {
                    // Handle success
                },
                error: function(error) {
                    // Handle error
                }
            });
        });

    </script>
@endpush