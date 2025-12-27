<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить задачу</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .form-container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }
        input[type="text"]:focus {
            outline: none;
            border-color: #4CAF50;
        }
        .error {
            color: #d32f2f;
            background-color: #ffebee;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        .error-list {
            margin: 0;
            padding-left: 20px;
        }
        .button-group {
            display: flex;
            gap: 10px;
        }
        button, .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn-cancel {
            background-color: #757575;
            color: white;
        }
        .btn-cancel:hover {
            background-color: #616161;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Добавить новую задачу</h1>
        
        <?php if($errors->any()): ?>
            <div class="error">
                <ul class="error-list">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo e(route('task.add')); ?>">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="title">Название задачи:</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    required 
                    placeholder="Введите название задачи"
                    value="<?php echo e(old('title')); ?>"
                    autofocus
                >
            </div>
            
            <div class="button-group">
                <button type="submit">Добавить задачу</button>
                <a href="<?php echo e(route('task.list')); ?>" class="btn btn-cancel">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>

<?php /**PATH C:\Users\Приятный\Desktop\project\unik\web\PHP_BAZA\laravel\resources\views/task/add.blade.php ENDPATH**/ ?>