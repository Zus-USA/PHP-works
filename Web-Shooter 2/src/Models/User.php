<?php

// Объявление пространства имён для организации классов
// Все классы в этой папке принадлежат пространству имён App\Models
namespace App\Models;

// Класс User (Пользователь)
class User
{
    // Приватные свойства - доступны только внутри класса
    // Это инкапсуляция данных
    private string $name;   // Имя пользователя (тип: строка)
    private string $email;  // Email пользователя (тип: строка)

    // Конструктор класса - вызывается при создании объекта
    // Принимает обязательные параметры: имя и email
    public function __construct(string $name, string $email)
    {
        // Инициализация свойств объекта
        $this->name = $name;   // Присваивание имени
        $this->email = $email; // Присваивание email
    }

    // Метод для получения полной информации о пользователе
    // Возвращает форматированную строку
    public function getInfo(): string
    {
        return "Пользователь: {$this->name}, Email: {$this->email}\n";
    }

    // Геттер для получения имени пользователя
    // Позволяет получить доступ к приватному свойству извне класса
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