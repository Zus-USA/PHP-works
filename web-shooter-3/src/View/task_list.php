<?php

$tasks = $this->getTasks();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список задач</title>
    <style><?= file_get_contents(__DIR__ . '/../../resources/css/app.css') ?></style>
</head>
<body>
    <h1>Менеджер задач</h1>
    
    <h2>Мои задачи</h2>
    
    <p><a href="?route=task/add">Добавить задачу</a></p>
    
    <?php if (empty($tasks)): ?>
        <p>Задач пока нет.</p>
        <p><a href="?route=task/add">Добавить первую задачу</a></p>
    <?php else: ?>
        <table>
            <tr>
                <td><strong>Название</strong></td>
            </tr>
            <?php foreach ($tasks as $task): ?>
                <tr>
                    <td><?= htmlspecialchars($task->getTitle()) ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        
        <p><strong>Всего задач: <?= count($tasks) ?></strong></p>
        <p><strong>В работе: <?= count(array_filter($tasks, fn($t) => !$t->isCompleted())) ?></strong></p>
    <?php endif; ?>
    
    <hr>
    <p>© <?= date('Y') ?></p>
</body>
</html>
