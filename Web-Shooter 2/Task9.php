<?php

// Конструктор с автоматическим созданием свойств name и email
class User {
    public function __construct(
        public string $name,
        public string $email
    ) {}

    // Метод для получения информации о пользователе в виде строки
    public function getInfo(): string {
        return "Имя: {$this->name}, Email: {$this->email}";
    } 
}

// Создаем нового пользователя
$user = new User("Квадрат", "square@example.com");

// Выводим информацию о пользователе
echo $user->getInfo();

?>