@extends('layouts.app')

@section('meta_title', $post->meta_title ?: $post->title)
@section('meta_description', $post->meta_description ?: Str::limit(strip_tags($post->content), 160))
@if ($post->og_image)
    @section('og_image', asset('storage/' . $post->og_image))
@endif

@section('content')

    <p class="muted"><a href="{{ route('blog.index') }}">← Все статьи</a></p>

    <h1>{{ $post->title }}</h1>

    <p class="muted">
        {{ $post->published_at?->format('d.m.Y') }}
        @if ($post->category) · {{ $post->category->name }} @endif
        @if ($post->author_name) · {{ $post->author_name }} @endif
    </p>

    @if ($post->og_image)
        <img class="photo" src="{{ asset('storage/' . $post->og_image) }}" alt="{{ $post->title }}">
    @endif

    <div class="content">
        {!! $post->content !!}
    </div>

@endsection
