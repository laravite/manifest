<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit;

use Laravite\Manifest\Exception\UnableToFindChunk;
use Laravite\Manifest\Exception\UnableToFindEntry;
use Laravite\Manifest\Exception\UnableToParse;
use Laravite\Manifest\Manifest;
use Laravite\Manifest\Test\Helper\InteractsWithTestManifest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Laravite\Manifest\Manifest
 *
 * @uses   \Laravite\Manifest\Chunk
 * @uses   \Laravite\Manifest\Transformer
 * @uses   \Laravite\Manifest\Exception\UnableToFindChunk
 * @uses   \Laravite\Manifest\Exception\UnableToFindEntry
 */
final class ManifestTest extends TestCase
{
    use InteractsWithTestManifest;

    /**
     * @uses \Laravite\Manifest\Chunk
     */
    public function test_it_parses_a_json_manifest(): void
    {
        $this->assertInstanceOf(
            Manifest::class,
            Manifest::parse($this->getTestManifestAsJson()),
        );
    }

    public function test_it_handles_invalid_json_input(): void
    {
        $this->expectException(UnableToParse::class);
        $this->expectExceptionMessage('The JSON payload is invalid');
        Manifest::parse('this is invalid json');
    }

    public function test_it_exposes_all_the_chunks(): void
    {
        $manifest = Manifest::parse($this->getTestManifestAsJson());

        $this->assertIsArray($manifest->chunks);
        $this->assertCount(5, $manifest->chunks);
    }

    public function test_it_retrieves_a_specific_chunk(): void
    {
        $manifest = Manifest::parse($this->getTestManifestAsJson());

        $this->assertEquals(
            'assets/main.4889e940.js',
            $manifest->chunk('main.js')->file
        );
    }

    public function test_it_handles_non_existing_chunks(): void
    {
        $this->expectException(UnableToFindChunk::class);

        $manifest = Manifest::parse($this->getTestManifestAsJson());
        $manifest->chunk('test.js');
    }

    public function test_it_exposes_all_the_static_entries(): void
    {
        $manifest = Manifest::parse($this->getTestManifestAsJson());

        $this->assertIsArray($manifest->entries);
        $this->assertCount(1, $manifest->entries);
    }

    public function test_it_retrieves_a_specific_entry(): void
    {
        $manifest = Manifest::parse($this->getTestManifestAsJson());

        $this->assertEquals(
            'assets/main.4889e940.js',
            $manifest->entry('main.js')->file
        );
    }

    public function test_it_handles_non_existing_entries(): void
    {
        $this->expectException(UnableToFindEntry::class);

        $manifest = Manifest::parse($this->getTestManifestAsJson());
        $manifest->entry('test.js');
    }

    public function test_it_validates_the_manifest_against_the_schema(): void
    {
        $this->expectException(UnableToParse::class);
        Manifest::parse('{}', true);
    }
}
