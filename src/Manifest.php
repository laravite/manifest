<?php declare(strict_types=1);

namespace Laravite\Manifest;

use Laravite\Manifest\Exception\EntryNotFound;

class Manifest
{
    /** @var array<Chunk> */
    public readonly array $entries;

    /**
     * @param array<Chunk> $chunks
     */
    public function __construct(
        public readonly array $chunks,
    ) {
        $this->entries = array_filter(
            $this->chunks,
            fn(Chunk $chunk) => $chunk->isEntry
        );
    }

    /**
     * Retrieves the given entry
     */
    public function entry(string $name): Chunk
    {
        return $this->entries[$name] ?? throw new EntryNotFound($name);
    }

    /**
     * Parses a Vite manifest
     */
    public static function parse(string $json): self
    {
        $json = json_decode($json, true);
        $chunks = array_map(fn (array $chunk) => new Chunk(...$chunk), $json);
        return new self($chunks);
    }
}
