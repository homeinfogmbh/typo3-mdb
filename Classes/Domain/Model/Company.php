<?php

namespace Homeinfo\mdb\Domain\Model;

use Homeinfo\mdb\Domain\Model\Address;

final class Company
{
    function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly ?Address $address,
        public readonly ?string $annotation,
    )
    {
    }

    public static function fromArray(array $array, ?Address $address): Self {
        return new self(
            $array['id'],
            $array['name'],
            $address,
            $array['annotation'],
        );
    }
}
