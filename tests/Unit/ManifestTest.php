<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit;

use Laravite\Manifest\Chunk;
use Laravite\Manifest\Manifest;

class ManifestTest extends TestCase
{
    public function test_it_parses_a_json_manifest(): void
    {
        $this->assertInstanceOf(Manifest::class, Manifest::parse(''));
    }

    public function test_it_returns_all_chunks(): void
    {
        /** @phpstan-ignore-next-line */
        $manifest = Manifest::parse(file_get_contents(self::FIXTURES_DIR . 'manifest.json'));
        $this->assertIsArray($manifest->chunks);
        $this->assertCount(3, $manifest->chunks);
    }

    public function test_it_returns_all_entries(): void
    {
        /** @phpstan-ignore-next-line */
        $manifest = Manifest::parse(file_get_contents(self::FIXTURES_DIR . 'manifest.json'));
        $this->assertIsArray($manifest->entries);
        $this->assertCount(1, $manifest->entries);
    }

    public function test_it_retrieves_a_specific_entry(): void
    {
        /** @phpstan-ignore-next-line */
        $manifest = Manifest::parse(file_get_contents(self::FIXTURES_DIR . 'manifest.json'));
        $entry = $manifest->entry('main.js');
        $this->assertInstanceOf(Chunk::class, $entry);
        $this->assertEquals('assets/main.4889e940.js', $entry->file);
    }

    public function test_it_handles_not_existing_entries(): void
    {
        /** @phpstan-ignore-next-line */
        $manifest = Manifest::parse(file_get_contents(self::FIXTURES_DIR . 'manifest.json'));
        $this->expectException(\Exception::class);
        $manifest->entry('does-not-exist.js');
    }
}
