@extends('author.layouts.author')
@section('content')

<div class="mb-8">
    <h1 class="text-2xl font-bold text-black">Dashboard Auteur</h1>
    <p class="text-sm text-black">Gérez vos articles et publications.</p>
</div>

@include('author.partials.stats')

<div class="grid grid-cols-1 gap-6">
    @include('author.partials.activityList')
</div>

@endsection

@push('scripts')
    <script>
        // Pass userId to the dashboard script
        window.authorUserId = {{ $userId }};
    </script>
@endpush
