<?php
/**
 * Форма добавления новой задачи
 */
$error = $error ?? null;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Добавить задачу</title>
    <style><?= file_get_contents(__DIR__ . '/../../resources/css/app.css') ?></style>
</head>
<body>
    <h1>Менеджер задач</h1>
    
    <h2>Добавить задачу</h2>
    
    <p><a href="?route=task/list">Назад к списку</a></p>
    
    <?php if ($error): ?>
        <p style="color: red;"><strong>Ошибка:</strong> <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    
    <form method="POST" action="?route=task/add">
        <p>
            <label>Название задачи: *</label><br>
            <input 
                type="text" 
                name="title" 
                value="<?= htmlspecialchars($_POST['title'] ?? '') ?>"
                required
            >
        </p>
        
        <p>
            <button type="submit">Добавить</button>
            <a href="?route=task/list">Отмена</a>
        </p>
    </form>
    
    <hr>
    <p>© <?= date('Y') ?></p>
</body>
</html>
