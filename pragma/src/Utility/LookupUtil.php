<?php

namespace App\Utility;

use Cake\Database\Connection;
use Cake\Database\StatementInterface;

final class LookupUtil {
    private const CACHE_LIMIT = 200;

    private static $instances = [];

    /** @var Connection */
    private $connection;
    /** @var StatementInterface */
    private $query;
    /** @var StatementInterface */
    private $insert;

    private $cache = [];
    private $table = '';

    private function __construct(Connection $connection, string $table, array $dependencies) {
        $this->connection = $connection;
        $this->table = $table;
        if (count($dependencies)) {
            $this->injectDependencies($dependencies);
        }
        $this->prepareStatements();
    }

    private function injectDependencies(array $dependencies): void {
        foreach ($dependencies as $key => $value) {
            if (property_exists(static::class, $key)) {
                $this->$key = $value;
            }
        }
    }

    private function prepareStatements(): void {
        if (!$this->query) {
            /** @noinspection SqlResolve */
            $sql = 'SELECT id FROM prepared_statements.' . $this->table . ' WHERE `name` = ?';
            $this->query = $this->connection->prepare($sql);
        }
        if (!$this->insert) {
            /** @noinspection SqlResolve */
            $sql = 'INSERT INTO prepared_statements.' . $this->table . ' (`name`) VALUES (?)';
            $this->insert = $this->connection->prepare($sql);
        }
    }

    public static function lookup(Connection $connection, string $table, $value) {
        $instance = static::getInstance($connection, $table);
        return array_key_exists($value, $instance->cache) ?
            $instance->cache[$value] : $instance->runLookup($value);
    }

    public static function getInstance(Connection $connection, string $table, array $dependencies = []): self {
        if (!array_key_exists($table, static::$instances)) {
            static::$instances[$table] = new static($connection, $table, $dependencies);
        }
        return static::$instances[$table];
    }

    private function runLookup($value) {
        if (count($this->cache) >= self::CACHE_LIMIT) {
            $this->cache = []; // Cache got too big; clear and start over
        }
        $parms = [substr($value, 0, 255)];
        $this->query->execute($parms);
        $row = $this->query->fetch('assoc');
        if (is_array($row) && array_key_exists('id', $row)) {
            $id = (int)$row['id'];
        } else {
            $this->insert->execute($parms);
            $id = (int)$this->insert->lastInsertId();
        }
        $this->cache[$value] = $id;
        return $id;
    }

    public static function reset(): void {
        static::$instances = [];
    }
}
