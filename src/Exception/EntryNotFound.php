<?php declare(strict_types=1);

namespace Laravite\Manifest\Exception;

class EntryNotFound extends \RuntimeException
{
    public function __construct(string $name)
    {
        parent::__construct(
            sprintf('Cannot find the specified entry [%s] in the manifest.', $name)
        );
    }
}
