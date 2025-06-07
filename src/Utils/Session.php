<?php

namespace Neecride\Framework\Utils;

use ArrayAccess;

class Session implements ArrayAccess
{
    public function __construct(string|null $sessionName = null)
    {
        if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
            if ($sessionName) {
                session_name($sessionName);
            }

            session_start();
        }
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($_SESSION[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $_SESSION[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $_SESSION[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($_SESSION[$offset]);
    }
}