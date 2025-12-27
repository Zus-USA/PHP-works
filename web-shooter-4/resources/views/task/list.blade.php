<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Задачи</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Courier New', monospace;
            background: #000;
            color: #fff;
            min-height: 100vh;
            padding: 40px 20px;
            line-height: 1.6;
        }
        .wrapper {
            max-width: 900px;
            margin: 0 auto;
        }
        header {
            border-bottom: 2px solid #fff;
            padding-bottom: 20px;
            margin-bottom: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
        }
        h1 {
            font-size: 32px;
            font-weight: normal;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .btn {
            background: #fff;
            color: #000;
            border: 2px solid #fff;
            padding: 12px 24px;
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-block;
        }
        .btn:hover {
            background: #000;
            color: #fff;
        }
        .message {
            background: #fff;
            color: #000;
            padding: 15px;
            margin-bottom: 30px;
            border: 2px solid #fff;
            font-size: 14px;
        }
        .tasks-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }
        .task-card {
            border: 2px solid #fff;
            padding: 25px;
            background: #000;
            position: relative;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
        }
        .task-card:hover {
            background: #fff;
            color: #000;
        }
        .task-card.completed {
            opacity: 0.5;
            border-style: dashed;
        }
        .task-card.completed::before {
            content: '✓';
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
        }
        .task-number {
            font-size: 12px;
            opacity: 0.6;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .task-title {
            font-size: 18px;
            flex-grow: 1;
            word-break: break-word;
        }
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            border: 2px dashed #fff;
        }
        .empty-state p {
            font-size: 18px;
            margin-bottom: 30px;
            opacity: 0.7;
        }
        .empty-state .btn {
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }
            .tasks-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <h1>Задачи</h1>
            <a href="{{ route('task.add') }}" class="btn">+ Новая</a>
        </header>
        
        @if(session('success'))
            <div class="message">{{ session('success') }}</div>
        @endif
        
        @if(empty($tasks))
            <div class="empty-state">
                <p>Список пуст</p>
                <a href="{{ route('task.add') }}" class="btn">Создать задачу</a>
            </div>
        @else
            <div class="tasks-grid">
                @foreach($tasks as $index => $task)
                    <div class="task-card {{ $task->completed ? 'completed' : '' }}">
                        <div class="task-number">#{{ $task->id ?? ($index + 1) }}</div>
                        <div class="task-title">{{ $task->title }}</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>

