
@props(['type' => 'service', 'title' => ''])

<form class="form" method="POST" action="{{ route('lead.store') }}">
    @csrf

    <h3>Оставить заявку</h3>
    <p class="muted">Заполните форму — мы перезвоним и всё обсудим.</p>

    @if ($errors->any())
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <input type="hidden" name="subject_type" value="{{ $type }}">
    <input type="hidden" name="subject_title" value="{{ $title }}">

    <div class="hp">
        <label>
            <span>Компания</span>
            <input type="text" name="company" tabindex="-1" autocomplete="off">
        </label>
    </div>

    <label>
        <span>Как вас зовут *</span>
        <input type="text" name="name" value="{{ old('name') }}" required>
    </label>

    <label>
        <span>Телефон *</span>
        <input type="tel" name="phone" value="{{ old('phone') }}" required>
    </label>

    <label>
        <span>Email</span>
        <input type="email" name="email" value="{{ old('email') }}">
    </label>

    <label>
        <span>Комментарий</span>
        <textarea name="message">{{ old('message') }}</textarea>
    </label>

    <label class="checkbox">
        <input type="checkbox" name="agree" value="1" {{ old('agree') ? 'checked' : '' }} required>
        <span>
            Согласен(на) с
            <a href="{{ route('page.show', 'privacy') }}" target="_blank">политикой обработки персональных данных</a>
        </span>
    </label>

    <button class="button" type="submit">Отправить заявку</button>
</form>
