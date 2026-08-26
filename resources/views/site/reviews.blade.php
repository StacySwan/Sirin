@extends('layouts.app')

@section('meta_title', 'Отзывы о клубе «Сирин»')
@section('meta_description', 'Отзывы участников и заказчиков из 2ГИС и Яндекс Карт.')

@section('content')

    <h1>Отзывы</h1>
    <p class="lead">Отзывы перенесены из 2ГИС и Яндекс Карт. По ссылке можно посмотреть оригинал.</p>

    @forelse ($reviews as $review)
        <div class="card">
            <p class="review__rating">
                {{ str_repeat('★', $review->rating) }}{{ str_repeat('☆', 5 - $review->rating) }}
            </p>
            <p>{{ $review->text }}</p>
            <p class="muted">
                {{ $review->name_author }}
                @if ($review->published_at) · {{ $review->published_at->format('d.m.Y') }} @endif
                @if ($review->source_url)
                    · <a href="{{ $review->source_url }}" target="_blank" rel="nofollow noopener">
                        {{ $review->source ?: 'источник' }}
                    </a>
                @elseif ($review->source)
                    · {{ $review->source }}
                @endif
            </p>
        </div>
    @empty
        <p class="muted">Отзывов пока нет.</p>
    @endforelse

    <div class="pagination">
        {{ $reviews->links() }}
    </div>

@endsection
