@extends('layouts.admin.app', ['title' => 'Notification Detail'])

@section('title', 'Notification Detail')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h4 text-gray-800">Notification Detail</h1>
        <a href="{{ url()->previous() }}" class="btn btn-sm btn-secondary">
            ← Back
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex align-items-center mb-3">
                <div class="icon-circle bg-primary mr-3">
                    <i class="fas fa-{{ $notification->data['icon'] ?? 'bell' }} text-white"></i>
                </div>
                <div>
                    <h5 class="mb-0">
                        {{ $notification->data['title'] ?? 'Notification' }}
                    </h5>
                    <small class="text-muted">
                        {{ $notification->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>

            <hr>

            <p class="mb-4">
                {{ $notification->data['message'] ?? '-' }}
            </p>

            @if($actionUrl)
                <a href="{{ $actionUrl }}" class="btn btn-primary mt-3">
                    Lihat Detail
                </a>
            @endif

        </div>
    </div>

</div>
@endsection
