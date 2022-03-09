<?php declare(strict_types=1);

namespace Laravite\Manifest;

/**
 * Raw Vite Manifest Transformer
 *
 * The transformer takes the JSON-decoded $manifest object, and produces a
 * Manifest object. All imports and dynamic imports are further transformed
 * into references to Chunk objects.
 */
final class Transformer
{
    /** @var array<string,Chunk> */
    private array $resolvedChunks = [];

    /**
     * @param array<string,array<string, mixed>> $manifest
     */
    public function __construct(private array $manifest) {}

    /**
     * @param array<string,array<string, mixed>> $manifest
     */
    public static function transform(array $manifest): Manifest
    {
        return (new Transformer($manifest))->buildManifest();
    }

    private function buildManifest(): Manifest
    {
        foreach ($this->manifest as $name => $attributes) {
            if (isset($attributes['imports'])) {
                $attributes['imports'] = $this->resolve($attributes['imports']);
            }
            if (isset($attributes['dynamicImports'])) {
                $attributes['dynamicImports'] = $this->resolve($attributes['dynamicImports']);
            }
            $this->resolvedChunks[$name] = Chunk::from($attributes);
        }

        return new Manifest($this->resolvedChunks);
    }

    /**
     * @param array<string> $imports
     * @return array<Chunk>
     */
    private function resolve(array $imports): array
    {
        return array_map(function (string $name) {

            // If a chunk matching the import name has already been resolved,
            // we'll return it immediately.
            if (isset($this->resolvedChunks[$name])) {
                return $this->resolvedChunks[$name];
            }

            // Otherwise, we'll grab the chunk's raw attributes from the decoded
            // manifest, resolve its imports and build a new Chunk.
            $attributes = $this->manifest[$name];
            if (isset($attributes['imports'])) {
                $attributes['imports'] = $this->resolve($attributes['imports']);
            }
            if (isset($attributes['dynamicImports'])) {
                $attributes['dynamicImports'] = $this->resolve($attributes['dynamicImports']);
            }
            $chunk = Chunk::from($attributes);

            // Save the chunk into the resolved chunks, in case we encounter it
            // again later on.
            $this->resolvedChunks[$name] = $chunk;

            return $chunk;
        }, $imports);
    }
}
