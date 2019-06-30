<?php
declare(strict_types=1);

namespace App\Test\TestCase\Singleton;

use App\Singleton\AftonStatePark;
use PHPUnit\Framework\TestCase;

class AftonStateParkTest extends TestCase {
    private $target;

    public function testConstructor(): void {
        $this->target = new AftonStatePark();
        static::assertInstanceOf(AftonStatePark::class, $this->target);
        static::fail('Successful setup: ' . __FILE__ . ' line ' . __LINE__);
    }
}
