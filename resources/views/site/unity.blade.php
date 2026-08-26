<?php
// Массив случайных сообщений
$messages = [
    "Ты сегодня прекрасен!",
    "Продолжай в том же духе!",
    "Удача на твоей стороне!",
    "Не бойся новизны!",
    "Ты справишься с любыми трудностями!"
];

// Выбираем случайное сообщение каждый раз при загрузке страницы
$randomMessage = $messages[array_rand($messages)];
?>

    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Случайное сообщение</title>
</head>
<body>
<h1>Игра мотиватор "Случайное сообщение!"</h1>
<p><strong><?php echo $randomMessage; ?></strong></p>
<p>Обновите страницу, чтобы получить новое сообщение!</p>
</body>
</html>
