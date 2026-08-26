@extends('layouts.app')

@section('meta_title', 'Статьи — клуб «Сирин»')
@section('meta_description', 'Статьи об исторической реконструкции, ремёслах и фестивалях.')

@section('content')

    <h1>Статьи</h1>

    @forelse ($posts as $post)
        <article class="card">
            <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
            <p class="muted">
                {{ $post->published_at?->format('d.m.Y') }}
                @if ($post->category) · {{ $post->category->name }} @endif
                @if ($post->author_name) · {{ $post->author_name }} @endif
            </p>
            <p>{{ Str::limit(strip_tags($post->content), 220) }}</p>
        </article>
    @empty
        <p class="muted">Статей пока нет.</p>
    @endforelse

    <div class="pagination">
        {{ $posts->links() }}
    </div>

@endsection
