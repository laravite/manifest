<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Unit;

use Laravite\Manifest\Chunk;
use Laravite\Manifest\Manifest;
use Laravite\Manifest\Test\Helper\InteractsWithTestManifest;
use Laravite\Manifest\Transformer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Laravite\Manifest\Transformer
 *
 * @uses   \Laravite\Manifest\Chunk
 * @uses   \Laravite\Manifest\Manifest
 */
final class TransformerTest extends TestCase
{
    use InteractsWithTestManifest;

    public function test_it_transforms_a_json_decoded_manifest_into_a_manifest(): void
    {
        $manifest = $this->getTestManifestAsArray();

        $this->assertInstanceOf(Manifest::class, Transformer::transform((array)$manifest));
    }

    public function test_it_resolves_imports_into_chunks(): void
    {
        $manifest = Transformer::transform($this->getTestManifestAsArray());

        $this->assertInstanceOf(
            Chunk::class,
            $manifest->chunk('views/foo.js')->imports[0]
        );
    }

    public function test_it_resolves_dynamic_imports_into_chunks(): void
    {
        $manifest = Transformer::transform($this->getTestManifestAsArray());

        $this->assertInstanceOf(
            Chunk::class,
            $manifest->chunk('main.js')->dynamicImports[0]
        );
    }
}
