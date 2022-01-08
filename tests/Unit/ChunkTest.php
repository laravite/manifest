<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit;

use Laravite\Manifest\Chunk;

class ChunkTest extends TestCase
{
    public function test_chunk_is_not_an_entry_ny_default(): void
    {
        $this->assertFalse((new Chunk('main.ts'))->isEntry);
    }

    public function test_chunk_is_not_a_dynamic_entry_by_default(): void
    {
        $this->assertFalse((new Chunk('main.ts'))->isDynamicEntry);
    }

    public function test_chunk_has_no_source_file_by_default(): void
    {
        $this->assertNull((new Chunk('main.ts'))->src);
    }

    public function test_chunk_has_no_css_by_default(): void
    {
        $this->assertCount(0, (new Chunk('main.ts'))->css);
    }

    public function test_chunk_has_no_assets_by_default(): void
    {
        $this->assertCount(0, (new Chunk('main.ts'))->assets);
    }

    public function test_chunk_has_no_imports_by_default(): void
    {
        $this->assertCount(0, (new Chunk('main.ts'))->imports);
    }

    public function test_chunk_has_no_dynamic_imports_by_default(): void
    {
        $this->assertCount(0, (new Chunk('main.ts'))->dynamicImports);
    }
}
