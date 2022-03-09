<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit;

use Laravite\Manifest\Chunk;
use PHPUnit\Framework\TestCase;

/** @covers \Laravite\Manifest\Chunk */
final class ChunkTest extends TestCase
{
    public function test_it_can_be_built_from_arbitrary_attributes(): void
    {
        $chunk = Chunk::from([
            'file' => 'assets/shared.83069a53.js',
        ]);

        $this->assertInstanceOf(Chunk::class, $chunk);
    }

    public function test_it_exposes_its_attributes_as_public_properties(): void
    {
        $chunk = Chunk::from([
            'file' => 'assets/shared.83069a53.js',
        ]);

        $this->assertEquals('assets/shared.83069a53.js', $chunk->file);
    }

    public function test_it_returns_missing_attributes_as_null(): void
    {
        $chunk = Chunk::from([
            'file' => 'assets/shared.83069a53.js',
        ]);

        $this->assertNull($chunk->isEntry);
    }
}
