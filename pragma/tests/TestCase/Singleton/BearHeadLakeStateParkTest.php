<?php
declare(strict_types=1);

namespace App\Test\TestCase\Singleton;

use App\Singleton\BearHeadLakeStatePark;
use PHPUnit\Framework\TestCase;

class BearHeadLakeStateParkTest extends TestCase {
    /** @var \App\Singleton\BearHeadLakeStatePark */
    private $target;
    /** @var \App\Singleton\BearHeadLakeStatePark */
    private $target2;

    protected function setUp(): void {
        $this->target = BearHeadLakeStatePark::getInstance();
        $this->target2 = BearHeadLakeStatePark::getInstance();
    }

    public function testSameInstance(): void {
        static::assertSame($this->target, $this->target2);
    }
}
