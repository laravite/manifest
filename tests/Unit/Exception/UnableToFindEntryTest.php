<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit\Exception;

use Laravite\Manifest\Exception\UnableToFindEntry;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Laravite\Manifest\Exception\UnableToFindEntry
 */
final class UnableToFindEntryTest extends TestCase
{
    public function test_it_returns_the_appropriate_message(): void
    {
        $this->expectExceptionMessage("Entry [test.js] does not exist.");
        throw new UnableToFindEntry('test.js');
    }
}
