@extends('layouts.app')

@section('meta_title', $service->meta_title ?: $service->name)
@section('meta_description', $service->meta_description ?: Str::limit(strip_tags($service->content), 160))
@if ($service->og_image)
    @section('og_image', asset('storage/' . $service->og_image))
@endif

@section('content')

    <p class="muted"><a href="{{ route('services.index') }}">← Все услуги</a></p>

    <h1>{{ $service->name }}</h1>

    @if ($service->og_image)
        {{--
        <img class="photo" src="{{ asset('storage/' . $service->og_image) }}" alt="{{ $service->name }}">
        --}}
        <img class="photo" src="{{ asset('storage/' . $service->og_image) }}" alt="{{ $service->name }}" style="width: 600px; height: auto;">
    @endif

    <div class="content">
        {!! $service->content !!}
    </div>

    <details class="order" @if ($errors->any()) open @endif>
        <summary class="button">Заказать услугу</summary>

        <x-lead-form type="service" :title="$service->name" />
    </details>

@endsection
