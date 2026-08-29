<!DOCTYPE html>
<html lang="ru">
<head><meta charset="utf-8"></head>
<body style="font-family: Arial, sans-serif; font-size: 15px; color: #222;">

<h2>Новая заявка с сайта «Сирин»</h2>

<p><b>Имя:</b> {{ $lead['name'] }}</p>
<p><b>Телефон:</b> {{ $lead['phone'] }}</p>

@if (!empty($lead['email']))
    <p><b>Email:</b> {{ $lead['email'] }}</p>
@endif

@if (!empty($lead['subject_title']))
    <p><b>Заказывают:</b> {{ $lead['subject_title'] }}</p>
@endif

@if (!empty($lead['message']))
    <p><b>Сообщение:</b><br>{{ $lead['message'] }}</p>
@endif

<p style="color: #777;">Заявка получена {{ now()->format('d.m.Y в H:i') }}</p>

</body>
</html>
