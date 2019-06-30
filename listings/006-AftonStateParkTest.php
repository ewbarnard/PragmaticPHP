<?php
declare(strict_types=1);

namespace App\Test\TestCase\Singleton;

use App\Singleton\AftonStatePark;
use PHPUnit\Framework\TestCase;

class AftonStateParkTest extends TestCase {
    private const BANNING_SP = 'Banning State Park';
    private const CAMDEN_SP = 'Camden State Park';

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

    public function testSetTag(): void {
        $this->target->setTag(self::BANNING_SP);
        static::assertSame(self::BANNING_SP, $this->target->getTag());
    }

    public function testBothTags(): void {
        $this->target->setTag(self::BANNING_SP);
        static::assertSame(self::BANNING_SP, $this->target->getTag());
        static::assertSame(self::BANNING_SP, $this->target2->getTag());
    }

    public function testChangeTag(): void {
        $this->target->setTag(self::BANNING_SP);
        $this->target2->setTag(self::CAMDEN_SP);
        static::assertSame(self::CAMDEN_SP, $this->target->getTag());
        static::assertSame(self::CAMDEN_SP, $this->target2->getTag());
    }
}
