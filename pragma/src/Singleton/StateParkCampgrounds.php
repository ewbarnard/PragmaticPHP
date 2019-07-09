<?php
declare(strict_types=1);

namespace App\Singleton;

final class StateParkCampgrounds {
    public const SP_AFTON = 'Afton State Park';
    public const SP_BANNING = 'Banning State Park';

    /** @var StateParkCampgrounds[] */
    private static $instances = [];
    private $name = '';

    private function __construct(string $name) {
        $this->name = $name;
    }

    public static function getInstance(string $name): self {
        if (!array_key_exists($name, static::$instances)) {
            static::$instances[$name] = new static($name);
        }
        return static::$instances[$name];
    }

    public function getName(): string {
        return $this->name;
    }

    /**
     * Testing hook
     */
    public static function reset(): void {
        static::$instances = [];
    }
}
