@extends('layouts.app')

@section('meta_title', $product->meta_title ?: $product->name)
@section('meta_description', $product->meta_description ?: Str::limit(strip_tags($product->description), 160))
@if ($product->og_image)
    @section('og_image', asset('storage/' . $product->og_image))
@endif

@section('content')

    <p class="muted"><a href="{{ route('products.index') }}">← Все изделия</a></p>

    <h1>{{ $product->name }}</h1>

    @if ($product->category)
        <p class="muted">{{ $product->category->name }}</p>
    @endif

    @if ($product->og_image)
        <img class="photo" src="{{ asset('storage/' . $product->og_image) }}" alt="{{ $product->name }}" style="width: 600px; height: auto;">
    @endif

    @if ($product->price)
        <p class="card__price">{{ number_format($product->price, 0, ',', ' ') }} ₽</p>
    @endif

    <div class="content">
        {!! $product->description !!}
    </div>

    <details class="order" @if ($errors->any()) open @endif>
        <summary class="button">Заказать изделие</summary>

        <x-lead-form type="product" :title="$product->name" />
    </details>

@endsection
