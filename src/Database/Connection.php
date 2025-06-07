<?php

namespace Neecride\Framework\Database;

use DateTimeInterface;
use PDO;
use PDOStatement;

class Connection extends PDO
{
    private const array TYPE = [
        'integer' => parent::PARAM_INT,
        'boolean' => parent::PARAM_BOOL,
    ];

    public function __construct(
        Dsn $dsn,
        string $username,
        string $password,
        array $options = [],
    ) {
        parent::__construct($dsn->generate(), $username, $password, $options);
        $this->setAttribute(parent::ATTR_DEFAULT_FETCH_MODE, parent::FETCH_ASSOC);
        $this->setAttribute(parent::ATTR_EMULATE_PREPARES, false);
    }

    public function request(string $statement, array $params = []): PDOStatement
    {
        $request = $this->prepare($statement);

        foreach ($params as $field => $value) {
            $paramType = gettype($value);
            $bindType = parent::PARAM_STR;

            if ($value instanceof DateTimeInterface) {
                $value = $value->format('Y-m-d H:i:s');
            } else if (array_key_exists($paramType, self::TYPE)) {
                $bindType = self::TYPE[$paramType];
            } else if ($value === null) {
                $bindType = parent::PARAM_NULL;
            }

            $request->bindValue($field, $value, $bindType);
        }

        $request->execute();
        return $request;
    }
}