@extends('layouts.app')

@section('content')
<div class="container">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold mb-0 text-dark">
            <i class="fas fa-chart-line text-gold me-2"></i> لوحة تحكم المنظومة
        </h3>
        <div>
            <span class="text-muted fw-bold">مرحباً بك، {{ Auth::user()->name }}</span>
        </div>
    </div>

    @include('home.partials.apps_grid')

    @include('home.partials.stats_cards')

    <div class="row">
        <div class="col-md-8">
            @include('home.partials.recent_tasks')
        </div>

        <div class="col-md-4">
            @include('home.partials.tasks_summary')
        </div>
    </div>

</div>
@endsection
