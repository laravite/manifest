<?php declare(strict_types=1);

namespace Laravite\Manifest\Exception;

final class UnableToFindEntry extends \RuntimeException
{
    public function __construct(string $name)
    {
        parent::__construct("Entry [$name] does not exist.");
    }
}
