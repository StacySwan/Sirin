@extends('layouts.app')

@section('meta_title', 'Клуб исторической реконструкции «Сирин»')
@section('meta_description', 'Мастер-классы, фестивали, доспехи и изделия ручной работы. Клуб исторической реконструкции «Сирин».')

@section('content')

    <h1>Клуб исторической реконструкции «Сирин»</h1>

    <p class="lead">
        Добро пожаловай на сайт нашего клуба!
        Мы изучаем быт, ремёсла и воинскую культуру Древней Руси: шьём костюмы,
        куём доспехи, проводим мастер-классы и выступаем на фестивалях.
    </p>
    <img src="/club.jpg" style="max-width: 100%; height: auto;">


    <p>
        <a class="button" href="{{ route('services.index') }}">Наши услуги</a>
    {{-- <a class="button button--ghost" href="{{ route('unity') }}">Игровой проект</a> --}}
 </p>

 {{--
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
--}}

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
         <p><a href="{{ route('products.index') }}">Все изделия →</a></p>
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
         <p><a href="{{ route('blog.index') }}">Все статьи →</a></p>
     @endif


        @if ($reviews->isNotEmpty())
            <h2>Отзывы</h2>
            <p class="lead">
                Вы тоже можете оставить отзыв на Яндекс и 2ГИС
            </p>
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
            <p class="lead">
                Вы тоже можете оставить отзыв на Яндекс и 2ГИС.
            </p>
        @endif


        <p class="lead">
        <h2>Наш адрес:</h2>
        <p>Костромская область, Костромской район, пос. Губачёво, Петровская улица, 13</p>
        <p> Свяжитесь с нами:</p>
        <p>+7‒910‒805‒12‒31</p>
        <p>+7‒953‒669‒10‒88</p>
        <p>+7‒961‒008‒44‒90</p>
        <p> <a href="https://vk.ru/club.sirin" target="_blank">https://vk.ru/club.sirin</a></p>
        </p>

    <div id="map" style="width: 100%; height: 400px;"></div>

    <script src="https://api-maps.yandex.ru/2.1/?apikey=c0f4d18e-9c97-428d-af3d-29676da3fab8&lang=ru_RU" type="text/javascript"></script>
    <script>
        ymaps.ready(init);

        function init() {
            // Координаты места (широта, долгота) — замени на нужные
            const coords = [57.769210, 41.073451]; // пример: Кострома

            const myMap = new ymaps.Map('map', {
                center: coords,
                zoom: 15,
                controls: ['zoomControl', 'fullscreenControl']
            });

            const myPlacemark = new ymaps.Placemark(coords, {
                hintContent: 'Наш клуб',
                balloonContent: 'Здесь мы проводим мастер‑классы и репетиции'
            }, {
                preset: 'islands#redIcon'
            });

            myMap.geoObjects.add(myPlacemark);
        }
    </script>


    @endsection
