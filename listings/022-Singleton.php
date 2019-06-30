<?php
declare(strict_types=1);

namespace App\Singleton;

abstract class Singleton {
    /** @var \App\Singleton\Singleton[] */
    protected static $instances = [];

    private function __construct() {
    }

    public static function getInstance(): self {
        $class = get_called_class();
        if (!array_key_exists($class, static::$instances)) {
            static::$instances[$class] = new static;
        }
        return static::$instances[$class];
    }
}
