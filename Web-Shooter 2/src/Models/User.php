<?php

// Объявление пространства имён для организации классов
// Все классы в этой папке принадлежат пространству имён App\Models
namespace App\Models;

class User
{
    private string $name;   // Имя пользователя
    private string $email;  // Email пользователя

    // Конструктор класса
    public function __construct(string $name, string $email)
    {
        // Инициализация свойств объекта
        $this->name = $name;   // Присваивание имени
        $this->email = $email; // Присваивание email
    }

    // Метод для получения полной информации о пользователе
    public function getInfo(): string
    {
        return "Пользователь: {$this->name}, Email: {$this->email}\n";
    }

    // Геттер для получения имени пользователя
    public function getName(): string
    {
        return $this->name;
    }

    // Геттер для получения email пользователя
    public function getEmail(): string
    {
        return $this->email;
    }
}