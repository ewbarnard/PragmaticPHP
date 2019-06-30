<?php
declare(strict_types=1);

namespace App\Singleton;

abstract class Singleton {
    /** @var \App\Singleton\Singleton */
    protected static $instance;

    private function __construct() {
    }

    public static function getInstance(): self {
        if (!static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}
