@extends('author.layouts.author')

@section('content')

    <div class="mb-5 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Mes Articles</h1>
        <a href="{{ route('author.articles.create') }}"
            class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Nouvel article
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white border border-gray-200 shadow-sm rounded-xl">
        <!-- Simple Header -->
        <div class="p-4 border-b border-gray-200 rounded-t-xl bg-gray-50">
            <h2 class="text-sm font-semibold text-gray-600">Liste de vos publications</h2>
        </div>

        <!-- Table Section Container -->
        <div id="articlesTableContainer">
            @include('author.articles.partials.table')
        </div>
    </div>

@endsection