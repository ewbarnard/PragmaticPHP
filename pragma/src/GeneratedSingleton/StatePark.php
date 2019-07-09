<?php
declare(strict_types=1);

namespace App\GeneratedSingleton;

abstract class StatePark {
    /** @var StatePark */
    private static $instance;

    private function __construct() {
    }

    public static function getInstance(): self {
        if (!self::$instance) {
            self::$instance = new static;
        }
        return self::$instance;
    }

}
