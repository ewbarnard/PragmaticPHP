<?php
declare(strict_types=1);

namespace App\Singleton;

class StatePark {
    public const SP_AFTON = 'Afton State Park';
    public const SP_BANNING = 'Banning State Park';
    public const SP_BEAR_HEAD_LAKE = 'Bear Head Lake State Park';
    public const SP_BEAVER_CREEK_VALLEY = 'Beaver Creek Valley State Park';

    /** @var StatePark[] */
    protected static $instances = [];
    protected $name = '';

    private function __construct(string $name) {
        $this->name = $name;
    }

    public function getInstance(string $name): self {
        if (!array_key_exists($name, static::$instances)) {
            static::$instances[$name] = new static($name);
        }
        return static::$instances[$name];
    }

    public function getName(): string {
        return $this->name;
    }
}
