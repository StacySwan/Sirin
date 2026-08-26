@extends('layouts.app')

@section('meta_title', 'Клуб исторической реконструкции «Сирин»')
@section('meta_description', 'Мастер-классы, фестивали, доспехи и изделия ручной работы. Клуб исторической реконструкции «Сирин».')

@section('content')

    <h1>Клуб исторической реконструкции «Сирин»</h1>

    <p class="lead">
        Мы изучаем быт, ремёсла и воинскую культуру Древней Руси: шьём костюмы,
        куём доспехи, проводим мастер-классы и выступаем на фестивалях.
    </p>

    <p>
        <a class="button" href="{{ route('services.index') }}">Наши услуги</a>
        <a class="button button--ghost" href="{{ route('unity') }}">Игровой проект</a>
    </p>

    @if ($services->isNotEmpty())
        <h2>Услуги</h2>
        <div class="grid">
            @foreach ($services as $service)
                <div class="card">
                    <h3><a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a></h3>
                    <p class="muted">{{ Str::limit(strip_tags($service->content), 120) }}</p>
                </div>
            @endforeach
        </div>
    @endif

    @if ($products->isNotEmpty())
        <h2>Изделия</h2>
        <div class="grid">
            @foreach ($products as $product)
                <div class="card">
                    @if ($product->og_image)
                        <img class="photo" src="{{ asset('storage/' . $product->og_image) }}" alt="{{ $product->title }}">
                    @endif
                    <h3><a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a></h3>
                    @if ($product->price)
                        <p class="card__price">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if ($posts->isNotEmpty())
        <h2>Последние статьи</h2>
        <ul class="list">
            @foreach ($posts as $post)
                <li class="card">
                    <h3><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
                    <p class="muted">{{ $post->published_at?->format('d.m.Y') }}</p>
                    <p>{{ Str::limit(strip_tags($post->content), 180) }}</p>
                </li>
            @endforeach
        </ul>
    @endif

    @if ($reviews->isNotEmpty())
        <h2>Отзывы</h2>
        <ul class="list">
            @foreach ($reviews as $review)
                <li class="card">
                    <p class="review__rating">{{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}</p>
                    <p>{{ $review->text }}</p>
                    <p class="muted">
                        {{ $review->name_author }}@if ($review->source), {{ $review->source }}@endif
                    </p>
                </li>
            @endforeach
        </ul>
        <p><a href="{{ route('reviews.index') }}">Все отзывы →</a></p>
    @endif




@endsection
