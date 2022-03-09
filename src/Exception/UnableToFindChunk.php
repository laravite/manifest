<?php declare(strict_types=1);

namespace Laravite\Manifest\Exception;

final class UnableToFindChunk extends \RuntimeException
{
    public function __construct(string $name)
    {
        parent::__construct("Chunk [$name] does not exist.");
    }
}
