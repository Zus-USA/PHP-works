<?php

namespace App\Validator;

class ValidationResult
{
    public function __construct(
        private readonly bool $isValid,
        private readonly array $errors = []
    ) {
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !$this->isValid;
    }

    public function getErrorsByField(): array
    {
        return ['title' => $this->errors];
    }
}

