<?php
declare(strict_types=1);

namespace App\Test\TestCase\Singleton;

use App\Singleton\AftonStatePark;
use PHPUnit\Framework\TestCase;

class AftonStateParkTest extends TestCase {
    /** @var AftonStatePark */
    private $target;
    /** @var AftonStatePark */
    private $target2;

    protected function setUp(): void {
        $this->target = AftonStatePark::getInstance();
        $this->target2 = AftonStatePark::getInstance();
    }

    public function testSameInstance(): void {
        static::assertSame($this->target, $this->target2);
    }
}
