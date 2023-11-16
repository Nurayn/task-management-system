@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('User List') }}</div>

                <div class="card-body">
                    <div class="d-flex" style="flex-direction:column">
                        <strong>Task # :</strong> <h3>{{ $task->id }}</h3>
                        <strong>Title :</strong> <h5>{{ $task->title }}</h5>
                        <strong>Description :</strong> <h5>{{ $task->description }}</h5>
                        <strong>Due Date :</strong> <h5>{{ $task->due_date }}</h5>
                        <strong>Location :</strong> <h5>{{ $task->location }}</h5>
                        <strong>Priority :</strong> <h5>{{ ucfirst($task->priority) }}</h5>
                        @if (auth()->user()->getRoleNames()->first() == 'admin')
                        <strong>User :</strong> <h5>{{ $task->user->name }}</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
