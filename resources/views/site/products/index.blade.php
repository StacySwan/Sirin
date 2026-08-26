@extends('layouts.app')

@section('meta_title', 'Изделия клуба «Сирин»')
@section('meta_description', 'Доспехи, костюмы, украшения и предметы быта ручной работы.')

@section('content')

    <h1>Изделия</h1>

    <div class="grid">
        @forelse ($products as $product)
            <div class="card">
                @if ($product->og_image)
                    <img class="photo" src="{{ asset('storage/' . $product->og_image) }}" alt="{{ $product->title }}">
                @endif
                <h3><a href="{{ route('products.show', $product->slug) }}">{{ $product->title }}</a></h3>
                @if ($product->category)
                    <p class="muted">{{ $product->category->name }}</p>
                @endif
                @if ($product->price)
                    <p class="card__price">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
                @endif
            </div>
        @empty
            <p class="muted">Изделия пока не добавлены.</p>
        @endforelse
    </div>

    <div class="pagination">
        {{ $products->links() }}
    </div>

@endsection
