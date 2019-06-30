<?php
declare(strict_types=1);

namespace App\Test\TestCase\Singleton;

use App\Singleton\AftonStatePark;
use App\Singleton\BearHeadLakeStatePark;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase {
    public function testCollision(): void {
        $afton1 = AftonStatePark::getInstance();
        $afton2 = AftonStatePark::getInstance();
        static::assertInstanceOf(AftonStatePark::class, $afton1);
        static::assertInstanceOf(AftonStatePark::class, $afton2);
        static::assertSame($afton1, $afton2);

        $bear = BearHeadLakeStatePark::getInstance();
        // Oops! Wrong object class returned
        static::assertInstanceOf(AftonStatePark::class, $bear);
        static::assertNotInstanceOf(BearHeadLakeStatePark::class, $bear);
        static::assertSame($bear, $afton1);
    }
}
