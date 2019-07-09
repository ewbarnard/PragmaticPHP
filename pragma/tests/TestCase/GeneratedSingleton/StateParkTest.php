<?php
declare(strict_types=1);

namespace App\Test\TestCase\GeneratedSingleton;

use App\GeneratedSingleton\CamdenStatePark;
use App\GeneratedSingleton\CarleyStatePark;
use App\GeneratedSingleton\StatePark;
use PHPUnit\Framework\TestCase;

class StateParkTest extends TestCase {
    public function testCamden(): void {
        $camden = CamdenStatePark::getInstance();
        static::assertInstanceOf(StatePark::class, $camden);
        static::assertInstanceOf(CamdenStatePark::class, $camden);
        static::assertNotInstanceOf(CarleyStatePark::class, $camden);
    }

    public function testCarley() {
        $carley = CarleyStatePark::getInstance();
        static::assertInstanceOf(StatePark::class, $carley);
        // Oops - this shows the problem
        static::assertInstanceOf(CamdenStatePark::class, $carley);
        static::assertNotInstanceOf(CarleyStatePark::class, $carley);
    }
}
