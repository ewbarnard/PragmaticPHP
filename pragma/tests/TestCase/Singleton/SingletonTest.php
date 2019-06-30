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

        $bear1 = BearHeadLakeStatePark::getInstance();
        static::assertInstanceOf(BearHeadLakeStatePark::class, $bear1);
        static::assertNotSame($bear1, $afton1);

        $bear2 = BearHeadLakeStatePark::getInstance();
        static::assertSame($bear1, $bear2);

        $afton3 = AftonStatePark::getInstance();
        static::assertSame($afton1, $afton3);
    }
}
