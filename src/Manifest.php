<?php declare(strict_types=1);

namespace Laravite\Manifest;

use Composer\InstalledVersions;
use Laravite\Manifest\Exception\UnableToFindChunk;
use Laravite\Manifest\Exception\UnableToFindEntry;
use Laravite\Manifest\Exception\UnableToParse;

final class Manifest
{
    /** @var array<Chunk> */
    public readonly array $entries;

    /**
     * @param array<Chunk> $chunks
     */
    public function __construct(public readonly array $chunks = [])
    {
        $this->entries = array_filter($this->chunks, fn(Chunk $chunk) => $chunk->isEntry);
    }

    /**
     * Parses a JSON Vite manifest
     */
    public static function parse(string $json, bool $validate = true): Manifest
    {
        $manifest = match ($rawChunks = json_decode($json, true)) {
            null => throw new UnableToParse('The JSON payload is invalid'),
            default => $rawChunks,
        };

        if (InstalledVersions::isInstalled('opis/json-schema') && $validate) {
            $validator = new \Opis\JsonSchema\Validator();
            if($validator->validate(
                json_decode($json),
                file_get_contents(__DIR__ . '/../schema/manifest.schema.json')
            )->hasError()) {
                throw new UnableToParse('The manifest does not validate against the schema');
            }
        }

        return Transformer::transform($manifest);
    }

    /**
     * Retrieves a specific chunk by name
     */
    public function chunk(string $name): Chunk
    {
        return $this->chunks[$name] ?? throw new UnableToFindChunk($name);
    }

    /**
     * Retrieves a specific entry by name
     */
    public function entry(string $name): Chunk
    {
        return $this->entries[$name] ?? throw new UnableToFindEntry($name);
    }
}
