<?php
declare(strict_types=1);

namespace App\Singleton;

class AftonStatePark {
    /** @var \App\Singleton\AftonStatePark */
    private static $instance;
    private $tag = '';

    private function __construct() {
    }

    public static function getInstance(): self {
        if (!static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }

    public function setTag(string $tag): void {
        $this->tag = $tag;
    }

    public function getTag(): string {
        return $this->tag;
    }
}
