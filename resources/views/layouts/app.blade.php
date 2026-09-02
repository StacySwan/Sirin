<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('meta_title', $title ?? 'Клуб исторической реконструкции «Сирин»')</title>
    <meta name="description" content="@yield('meta_description', $description ?? 'Клуб исторической реконструкции «Сирин»: мастер-классы, фестивали, изделия ручной работы.')">

    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('meta_title', $title ?? 'Клуб «Сирин»')">
    <meta property="og:description" content="@yield('meta_description', $description ?? '')">
    <meta property="og:url" content="{{ url()->current() }}">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @endif

    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body>

<header class="header">
    <div class="container header__inner">
       {{-- <a class="logo" href="{{ route('home') }}">Сирин</a>--}}

        <a class="logo" href="{{ route('home') }}" aria-label="Сирин">
            <img src="{{ asset('sirin.png') }}" alt="Логотип Сирин">
        </a>

        <nav class="nav">
            <a href="/page/meetmasters">Наши мастера</a>
            <a href="{{ route('services.index') }}">Услуги</a>
            <a href="{{ route('products.index') }}">Изделия</a>
            <a href="{{ route('blog.index') }}">Статьи</a>
            <a href="{{ route('reviews.index') }}">Отзывы</a>
            <a href="{{ route('unity') }}">Игра</a>
        </nav>
    </div>
</header>

<main class="container main">
    {{-- Сообщение об успешной отправке формы --}}
    @if (session('success'))
        <div class="alert alert--success">{{ session('success') }}</div>
    @endif

    @yield('content')
</main>

<footer class="footer">
    <div class="container footer__inner">
        <p>© {{ date('Y') }} Клуб исторической реконструкции «Сирин»</p>
        <p>
            <a href="{{ route('page.show', 'privacy') }}">Политика обработки персональных данных</a>
        </p>
    </div>
</footer>

</body>
</html>
