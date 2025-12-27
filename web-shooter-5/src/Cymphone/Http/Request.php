<?php

namespace Cymphone\Http;

class Request
{
    private array $get;
    private array $post;
    private array $server;
    private array $session;

    public function __construct()
    {
        $this->get = $_GET;
        $this->post = $_POST;
        $this->server = $_SERVER;
        $this->session = $_SESSION ?? [];
    }

    public function get(string $key, $default = null)
    {
        return $this->get[$key] ?? $default;
    }

    public function post(string $key, $default = null)
    {
        return $this->post[$key] ?? $default;
    }

    public function input(string $key, $default = null)
    {
        return $this->post($key, $this->get($key, $default));
    }

    public function method(): string
    {
        return strtoupper($this->server['REQUEST_METHOD'] ?? 'GET');
    }

    public function path(): string
    {
        $path = parse_url($this->server['REQUEST_URI'] ?? '/', PHP_URL_PATH);
        return $path ?: '/';
    }

    public function isMethod(string $method): bool
    {
        return $this->method() === strtoupper($method);
    }

    public function all(): array
    {
        return array_merge($this->get, $this->post);
    }

    public function has(string $key): bool
    {
        return isset($this->get[$key]) || isset($this->post[$key]);
    }

    public function session(): array
    {
        return $this->session;
    }

    public function setSession(string $key, $value): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$key] = $value;
    }

    public function getSession(string $key, $default = null)
    {
        return $this->session[$key] ?? $default;
    }

    public function flash(string $key, $value): void
    {
        $this->setSession('_flash.' . $key, $value);
    }

    public function getFlash(string $key, $default = null)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $flashKey = '_flash.' . $key;
        $value = $_SESSION[$flashKey] ?? $default;
        if (isset($_SESSION[$flashKey])) {
            unset($_SESSION[$flashKey]);
        }
        return $value;
    }
}

