@extends('admin.layouts.admin')
@section('content')



    @include('admin.partials.stats')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
        @include('admin.partials.recentArticles')
        @include('admin.partials.activityList')
    </div>


@endsection