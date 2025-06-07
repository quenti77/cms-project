<?php

namespace Neecride\Framework\Database;

readonly class Dsn
{
    private int $port;

    public function __construct(
        private string $type = 'pgsql',
        private string $host = '127.0.0.1',
        string $port = '5432',
        private string $name = 'cms_project',
    ) {
        $this->port = (int) $port;
    }

    public function isSqlite(): bool
    {
        return str_starts_with($this->type, 'sqlite');
    }

    public function generate(): string
    {
        return $this->isSqlite()
            ? "{$this->type}:{$this->host}"
            : "{$this->type}:host={$this->host};port={$this->port};dbname={$this->name}";
    }
}