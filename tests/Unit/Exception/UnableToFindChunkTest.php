<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit\Exception;

use Laravite\Manifest\Exception\UnableToFindChunk;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Laravite\Manifest\Exception\UnableToFindChunk
 */
final class UnableToFindChunkTest extends TestCase
{
    public function test_it_returns_the_appropriate_message(): void
    {
        $this->expectExceptionMessage("Chunk [test.js] does not exist.");
        throw new UnableToFindChunk('test.js');
    }
}
