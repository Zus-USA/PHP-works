<?php

namespace App\Container;

use Exception;

class Container {
    private array $definitions = [];

    public function set (string $id, callable $callable): void {
        $this->definitions[$id] = $callable;
    }

    public function get (string $id): mixed {
        if (!isset($this->definitions[$id])) {
            throw new Exception("Service $id not found");
        } else {
            return $this->definitions[$id]($this);
        }
    }
}