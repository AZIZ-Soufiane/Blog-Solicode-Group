@extends('admin.layouts.admin')

@section('content')

    <div class="mb-5 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Liste des articles</h1>
        <a href="{{ route('admin.articles.create') }}" 
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

    <div class="bg-white border border-gray-200 shadow-sm rounded-xl p-6">
        <p class="text-gray-600">✅ L'article a été créé avec succès !</p>
        <p class="text-sm text-gray-500 mt-2">La liste complète des articles sera implémentée.</p>
    </div>

    

@endsection
