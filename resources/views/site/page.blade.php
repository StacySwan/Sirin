@extends('layouts.app')

@section('meta_title', $page->meta_title ?: $page->title)
@section('meta_description', $page->meta_description ?: '')

@section('content')

    <h1>{{ $page->title }}</h1>

    <div class="content">
        {!! $page->content !!}
    </div>

@endsection
