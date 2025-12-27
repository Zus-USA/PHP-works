<?php
$title = 'Список задач';
ob_start();
?>

<?php if (!empty($success)): ?>
    <p style="color: green;"><?= htmlspecialchars($success) ?></p>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<h2>Мои задачи</h2>

<p><a href="<?= route('task.add') ?>">Добавить задачу</a></p>

<?php if (empty($tasks)): ?>
    <p>Задач пока нет.</p>
    <p><a href="<?= route('task.add') ?>">Добавить первую задачу</a></p>
<?php else: ?>
    <table>
        <tr>
            <td><strong>Название</strong></td>
        </tr>
        <?php foreach ($tasks as $task): ?>
            <tr>
                
                <td><?= htmlspecialchars($task->title) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <p><strong>Всего задач: <?= count($tasks) ?></strong></p>
   
    <p><strong>В работе: <?= count(array_filter($tasks, fn($t) => !$t->completed)) ?></strong></p>
<?php endif; ?>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
