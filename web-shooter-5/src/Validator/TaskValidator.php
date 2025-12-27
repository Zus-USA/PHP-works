<?php

namespace App\Validator;

class TaskValidator
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 255;

    /**
     * Валидация названия задачи
     */
    public function validateTitle(?string $title): ValidationResult
    {
        $errors = [];
        $title = $title ?? '';

        if (empty(trim($title))) {
            $errors[] = 'Название задачи не может быть пустым';
        } elseif (strlen(trim($title)) < self::MIN_LENGTH) {
            $errors[] = sprintf('Название задачи должно содержать минимум %d символа', self::MIN_LENGTH);
        }

        if (strlen($title) > self::MAX_LENGTH) {
            $errors[] = sprintf('Название задачи не должно превышать %d символов', self::MAX_LENGTH);
        }

        return new ValidationResult(empty($errors), $errors);
    }
}

