<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Задачи' ?></title>
    <style><?= file_get_contents(dirname(__DIR__, 2) . '/css/app.css') ?></style>
</head>
<body>
    <h1>Менеджер задач</h1>
    
    <?= $content ?? '' ?>
    
    <hr>
    <p>© <?= date('Y') ?></p>
</body>
</html>
