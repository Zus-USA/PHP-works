<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новая задача</title>
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
            max-width: 600px;
            margin: 0 auto;
        }
        header {
            border-bottom: 2px solid #fff;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }
        h1 {
            font-size: 32px;
            font-weight: normal;
            letter-spacing: 3px;
            text-transform: uppercase;
        }
        .back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #fff;
            text-decoration: none;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
            transition: opacity 0.3s;
        }
        .back-link:hover {
            opacity: 1;
        }
        .back-link::before {
            content: '← ';
        }
        .error-box {
            border: 2px solid #fff;
            background: #fff;
            color: #000;
            padding: 20px;
            margin-bottom: 30px;
        }
        .error-box ul {
            list-style: none;
            padding-left: 0;
        }
        .error-box li {
            margin-bottom: 8px;
        }
        .error-box li::before {
            content: '× ';
        }
        form {
            border: 2px solid #fff;
            padding: 40px;
        }
        .form-group {
            margin-bottom: 30px;
        }
        label {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 15px;
            opacity: 0.8;
        }
        input[type="text"] {
            width: 100%;
            background: #000;
            color: #fff;
            border: 2px solid #fff;
            padding: 15px;
            font-family: inherit;
            font-size: 18px;
            outline: none;
            transition: all 0.3s;
        }
        input[type="text"]:focus {
            background: #fff;
            color: #000;
        }
        input[type="text"]::placeholder {
            color: #666;
            opacity: 0.5;
        }
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        button, .btn {
            background: #fff;
            color: #000;
            border: 2px solid #fff;
            padding: 15px 30px;
            text-decoration: none;
            font-family: inherit;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.3s;
            flex: 1;
            min-width: 120px;
        }
        button:hover, .btn:hover {
            background: #000;
            color: #fff;
        }
        button[type="submit"] {
            background: #000;
            color: #fff;
        }
        button[type="submit"]:hover {
            background: #fff;
            color: #000;
        }
        @media (max-width: 768px) {
            h1 {
                font-size: 24px;
            }
            form {
                padding: 30px 20px;
            }
            .actions {
                flex-direction: column;
            }
            button, .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <header>
            <a href="{{ route('task.list') }}" class="back-link">Назад</a>
            <h1>Новая задача</h1>
        </header>
        
        @if($errors->any())
            <div class="error-box">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('task.add') }}">
            @csrf
            <div class="form-group">
                <label for="title">Название</label>
                <input 
                    type="text" 
                    id="title" 
                    name="title" 
                    required 
                    placeholder="Введите название задачи"
                    value="{{ old('title') }}"
                    autofocus
                >
            </div>
            
            <div class="actions">
                <button type="submit">Создать</button>
                <a href="{{ route('task.list') }}" class="btn">Отмена</a>
            </div>
        </form>
    </div>
</body>
</html>

