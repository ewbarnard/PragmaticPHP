<?php
declare(strict_types=1);

namespace App\Test\TestCase\Singleton;

use App\Singleton\StateParkCampgrounds;
use PHPUnit\Framework\TestCase;

class StateParkCampgroundsTest extends TestCase {
    /** @var StateParkCampgrounds */
    private $target;

    public function setUp(): void {
        StateParkCampgrounds::reset();
    }

    public function testCorrectClass(): void {
        $this->target = StateParkCampgrounds::getInstance(StateParkCampgrounds::SP_BANNING);
        static::assertInstanceOf(StateParkCampgrounds::class, $this->target);
    }

    public function testSameInstance(): void {
        $this->target = StateParkCampgrounds::getInstance(StateParkCampgrounds::SP_BANNING);
        $next = StateParkCampgrounds::getInstance(StateParkCampgrounds::SP_BANNING);
        static::assertSame($this->target, $next);
    }

    public function testNotSameInstance(): void {
        $this->target = StateParkCampgrounds::getInstance(StateParkCampgrounds::SP_BANNING);
        $next = StateParkCampgrounds::getInstance(StateParkCampgrounds::SP_AFTON);
        static::assertNotSame($this->target, $next);
    }

    public function testReset(): void {
        $this->target = StateParkCampgrounds::getInstance(StateParkCampgrounds::SP_BANNING);
        StateParkCampgrounds::reset();
        $next = StateParkCampgrounds::getInstance(StateParkCampgrounds::SP_BANNING);
        static::assertNotSame($this->target, $next);
    }
}
