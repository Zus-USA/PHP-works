<?php

namespace Cymphone\Validation;

use Cymphone\Http\Request;

class Validator
{
    private array $rules;
    private array $errors = [];
    private Request $request;

    public function __construct(Request $request, array $rules)
    {
        $this->request = $request;
        $this->rules = $rules;
    }

    public function validate(): bool
    {
        $this->errors = [];

        foreach ($this->rules as $field => $rules) {
            $rulesArray = is_string($rules) ? explode('|', $rules) : $rules;
            $value = $this->request->input($field);

            foreach ($rulesArray as $rule) {
                if ($rule === 'required' && empty($value)) {
                    $this->errors[$field][] = "Поле {$field} обязательно для заполнения";
                } elseif ($rule === 'string' && !empty($value) && !is_string($value)) {
                    $this->errors[$field][] = "Поле {$field} должно быть строкой";
                } elseif (strpos($rule, 'max:') === 0 && !empty($value)) {
                    $max = (int) substr($rule, 4);
                    if (is_string($value) && strlen($value) > $max) {
                        $this->errors[$field][] = "Поле {$field} не должно превышать {$max} символов";
                    }
                } elseif (strpos($rule, 'min:') === 0 && !empty($value)) {
                    $min = (int) substr($rule, 4);
                    if (is_string($value) && strlen($value) < $min) {
                        $this->errors[$field][] = "Поле {$field} должно содержать минимум {$min} символов";
                    }
                }
            }
        }

        return empty($this->errors);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    public function all(): array
    {
        $all = [];
        foreach ($this->errors as $field => $errors) {
            $all = array_merge($all, $errors);
        }
        return $all;
    }

    public function first(string $field): ?string
    {
        return $this->errors[$field][0] ?? null;
    }
}

