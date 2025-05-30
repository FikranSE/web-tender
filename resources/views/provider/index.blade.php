@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Provider Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>Welcome, {{ Auth::user()->name }}!</p>
                    <p>You are logged in as a Provider.</p>
                    
                    <!-- Add provider-specific content here -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
