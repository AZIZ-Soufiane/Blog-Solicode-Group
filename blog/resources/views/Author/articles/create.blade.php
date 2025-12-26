@extends('author.layouts.author')

@section('content')

    <div class="mb-5 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-gray-800">Rédiger un nouvel article</h1>
        <a href="{{ route('author.articles.index') }}" class="text-sm text-blue-600 hover:underline">
            &larr; Retour
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('author.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Reusing Admin Form Partial for Consistency -->
        @include('admin.articles._form', ['buttonLabel' => 'Publier l\'article'])
    </form>

@endsection