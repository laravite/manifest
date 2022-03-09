<?php declare(strict_types=1);

namespace Laravite\Manifest\Test\Helper;

use Exception;

trait InteractsWithTestManifest
{
    /**
     * @throws Exception if the test manifest cannot be loaded
     */
    private function getTestManifestAsJson(): string
    {
        return match ($json = file_get_contents(__DIR__ . '/../Fixtures/manifest.json')) {
            false => throw new Exception('Cannot read test manifest file.'),
            default => $json,
        };
    }

    /**
     * @throws Exception if the manifest cannot be loaded or decoded
     * @return array<string, mixed>
     */
    private function getTestManifestAsArray(): array
    {
        return match ($manifest = json_decode($this->getTestManifestAsJson(), true)) {
            null => throw new Exception('Cannot decode test manifest'),
            default => $manifest
        };
    }
}
