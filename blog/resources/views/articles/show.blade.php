@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="w-full max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

    {{-- Header --}}
    <div class="mb-8">
        <span class="inline-flex py-1.5 px-3 rounded-md text-xs font-medium bg-blue-100 text-blue-800">
            {{ $article->category->name }}
        </span>

        <h1 class="text-3xl font-bold text-gray-900 md:text-4xl lg:text-5xl my-4">
            {{ $article->title }}
        </h1>

        <div class="flex items-center gap-x-4 mt-6">
            <img class="h-10 w-10 rounded-full" src="{{ $article->author->avatar }}" alt="">
            <div>
                <div class="font-medium">{{ $article->author->name }}</div>
                <div class="text-xs text-gray-500">
                    Publié le {{ $article->created_at->format('d M Y') }}
                    · {{ $article->reading_time }} min
                </div>
            </div>
        </div>
    </div>

    {{-- Cover --}}
    <div class="text-xs text-red-500 mb-2">DEBUG Path: {{ $article->image }}</div>
    <img class="w-full h-96 object-cover rounded-xl mb-10"
         src="{{ $article->image ? asset('storage/' . $article->image) : 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" alt="{{ $article->title }}">

    {{-- Content --}}
    <div class="prose prose-lg prose-blue max-w-none">
        {!! $article->content !!}
    </div>

    {{-- Tags --}}
    <div class="mt-10 flex flex-wrap gap-2">
        @foreach($article->tags as $tag)
            <a class="py-2 px-3 text-sm rounded-lg border bg-white" href="#">
                #{{ $tag->name }}
            </a>
        @endforeach
    </div>

</div>
@endsection
