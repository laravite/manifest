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
     * @param array<string> $imports
     * @param array<string> $dynamicImports
     */
    public function __construct(
        public string $file,
        public bool $isEntry = false,
        public bool $isDynamicEntry = false,
        public ?string $src = null,
        public array $css = [],
        public array $assets = [],
        public array $imports = [],
        public array $dynamicImports = [],
    ) {}
}
