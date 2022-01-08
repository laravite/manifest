<?php declare(strict_types=1);

namespace Laravite\Manifest;

class Chunk
{
    /**
     * @param string $file
     * @param bool $isEntry
     * @param bool $isDynamicEntry
     * @param string|null $src
     * @param array<string> $css
     * @param array<string> $assets
     * @param array<Chunk> $imports
     * @param array<Chunk> $dynamicImports
     */
    public function __construct(
        public readonly string $file,
        public readonly bool $isEntry = false,
        public readonly bool $isDynamicEntry = false,
        public readonly ?string $src = null,
        public readonly array $css = [],
        public readonly array $assets = [],
        public readonly array $imports = [],
        public readonly array $dynamicImports = [],
    ) {}
}
