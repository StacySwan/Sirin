@extends('layouts.app')

@section('meta_title', 'Услуги клуба «Сирин»')
@section('meta_description', 'Мастер-классы, выступления, аренда костюмов и другие услуги клуба исторической реконструкции.')

@section('content')

    <h1>Услуги</h1>

    <div class="grid">
        @forelse ($services as $service)
            <div class="card">
                <h3><a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a></h3>
                <p class="muted">{{ Str::limit(strip_tags($service->content), 150) }}</p>
                <p><a class="button" href="{{ route('services.show', $service->slug) }}">Подробнее</a></p>
            </div>
        @empty
            <p class="muted">Услуги пока не добавлены.</p>
        @endforelse
    </div>

@endsection
