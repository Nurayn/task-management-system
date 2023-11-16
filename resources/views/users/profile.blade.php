@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile Details') }}</div>

                <div class="card-body">
                    <div class="d-flex" style="flex-direction:column">
                        Name : <h3>{{ $user->name }}</h3>
                        Email : <h3>{{ $user->email }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection