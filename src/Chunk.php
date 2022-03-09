<?php declare(strict_types=1);

namespace Laravite\Manifest;

/**
 * @property-read string $file
 * @property-read ?bool $isEntry
 * @property-read ?bool $isDynamicEntry
 * @property-read ?string $src
 * @property-read ?string[] $css
 * @property-read ?string[] $assets
 * @property-read ?Chunk[] $imports
 * @property-read ?Chunk[] $dynamicImports
 */
final class Chunk
{
    /**
     * Creates a new Chunk
     *
     * @param array<string, mixed> $attributes
     */
    public function __construct(
        private array $attributes = [],
    ) {}

    /**
     * Creates a Chunk from arbitrary attributes
     *
     * @param array<string, mixed> $attributes
     */
    public static function from(array $attributes): Chunk
    {
        return new Chunk($attributes);
    }

    /**
     * Dynamically retrieves an attribute as a property
     */
    public function __get(string $attribute): mixed
    {
        return $this->attributes[$attribute] ?? null;
    }
}
