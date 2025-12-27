<?php
$title = 'Добавить задачу';
ob_start();
?>

<h2>Добавить задачу</h2>

<p><a href="<?= route('task.list') ?>">Назад к списку</a></p>

<?php if (!empty($errors)): ?>
    <p style="color: red;"><strong>Ошибки:</strong></p>
    <ul>
        <?php 
        $allErrors = [];
        foreach ($errors as $fieldErrors) {
            if (is_array($fieldErrors)) {
                $allErrors = array_merge($allErrors, $fieldErrors);
            } else {
                $allErrors[] = $fieldErrors;
            }
        }
        foreach ($allErrors as $error): 
        ?>
            <li style="color: red;"><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="<?= route('task.add') ?>">
    <input type="hidden" name="_token" value="<?= csrf_token() ?>">
    
    <p>
        <label>Название задачи: *</label><br>
        <input 
            type="text" 
            name="title" 
            value="<?= htmlspecialchars($old['title'] ?? '') ?>"
            required
        >
    </p>
    
    <p>
        <button type="submit">Добавить</button>
        <a href="<?= route('task.list') ?>">Отмена</a>
    </p>
</form>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
