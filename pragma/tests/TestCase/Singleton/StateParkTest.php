<?php
declare(strict_types=1);

namespace App\Test\TestCase\Singleton;

use App\Singleton\StatePark;
use PHPUnit\Framework\TestCase;

class StateParkTest extends TestCase {
    /** @var StatePark */
    private $afton;
    /** @var StatePark */
    private $banning;
    /** @var StatePark */
    private $bear;
    /** @var StatePark */
    private $beaver;

    protected function setUp(): void {
        $this->afton = StatePark::getInstance(StatePark::SP_AFTON);
        $this->banning = StatePark::getInstance(StatePark::SP_BANNING);
        $this->bear = StatePark::getInstance(StatePark::SP_BEAR_HEAD_LAKE);
        $this->beaver = StatePark::getInstance(StatePark::SP_BEAVER_CREEK_VALLEY);
    }

    public function testClass(): void {
        static::assertInstanceOf(StatePark::class, $this->afton);
        static::assertInstanceOf(StatePark::class, $this->banning);
        static::assertInstanceOf(StatePark::class, $this->bear);
        static::assertInstanceOf(StatePark::class, $this->beaver);
    }

    public function testName() {
        static::assertSame(StatePark::SP_AFTON, $this->afton->getName());
        static::assertSame(StatePark::SP_BANNING, $this->banning->getName());
        static::assertSame(StatePark::SP_BEAR_HEAD_LAKE, $this->bear->getName());
        static::assertSame(StatePark::SP_BEAVER_CREEK_VALLEY, $this->beaver->getName());
    }

    public function testNotSame() {
        static::assertNotSame($this->afton, $this->banning);
        static::assertNotSame($this->afton, $this->bear);
        static::assertNotSame($this->afton, $this->beaver);
        static::assertNotSame($this->banning, $this->bear);
        static::assertNotSame($this->banning, $this->beaver);
        static::assertNotSame($this->bear, $this->beaver);
    }
}
