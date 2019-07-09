<?php
declare(strict_types=1);

namespace App\Test\TestCase\Utility;

use App\Utility\LookupUtil;
use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;
use PHPUnit\Framework\TestCase;

class LookupUtilCacheTest extends TestCase {
    private const TABLE = 'xyzzy';
    private const CACHE = [
        'hollow' => 1,
        'voice' => 2,
        'Plugh' => 3,
    ];
    /** @var Connection */
    private $connection;

    public function setUp(): void {
        LookupUtil::reset();
        $this->connection = new Connection(['driver' => new Mysql()]);
        $dependencies = [
            'query' => true,
            'insert' => true,
            'cache' => self::CACHE,
        ];
        LookupUtil::getInstance($this->connection, self::TABLE, $dependencies);
    }

    public function dataCache(): array {
        $data = [];

        $data[] = [1, 'hollow'];
        $data[] = [2, 'voice'];
        $data[] = [3, 'Plugh'];

        return $data;
    }

    /**
     * @param int $expectedId
     * @param string $value
     * @dataProvider dataCache
     */
    public function testCache(int $expectedId, string $value): void {
        $actualId = LookupUtil::lookup($this->connection, self::TABLE, $value);
        static::assertSame($expectedId, $actualId);
    }
}
