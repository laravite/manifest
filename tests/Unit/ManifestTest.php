<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit;

use Exception;
use Laravite\Manifest\Chunk;
use Laravite\Manifest\Manifest;

class ManifestTest extends TestCase
{
    /**
     * @throws Exception
     */
    private function getTestManifest(): Manifest
    {
        return match ($json = file_get_contents(self::FIXTURES_DIR . 'manifest.json')) {
            false => throw new Exception('Cannot read test manifest file.'),
            default => Manifest::parse($json),
        };
    }

    public function test_it_parses_a_json_manifest(): void
    {
        $this->assertInstanceOf(Manifest::class, $this->getTestManifest());
    }

    public function test_it_returns_all_chunks(): void
    {
        $manifest = $this->getTestManifest();
        $this->assertIsArray($manifest->chunks);
        $this->assertCount(3, $manifest->chunks);
    }

    public function test_it_returns_all_entries(): void
    {
        $manifest = $this->getTestManifest();
        $this->assertIsArray($manifest->entries);
        $this->assertCount(1, $manifest->entries);
    }

    public function test_it_retrieves_a_specific_entry(): void
    {
        $manifest = $this->getTestManifest();
        $entry = $manifest->entry('main.js');
        $this->assertInstanceOf(Chunk::class, $entry);
        $this->assertEquals('assets/main.4889e940.js', $entry->file);
    }

    public function test_it_handles_not_existing_entries(): void
    {
        $manifest = $this->getTestManifest();
        $this->expectException(Exception::class);
        $manifest->entry('does-not-exist.js');
    }
}
