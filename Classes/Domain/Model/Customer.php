<?php

namespace Homeinfo\mdb\Domain\Model;

use Homeinfo\mdb\Domain\Model\Company;

final class Customer
{
    function __construct(
        public readonly int $id,
        public readonly Company $company,
        public readonly ?int $reseller,
        public readonly string $abbreviation,
        public readonly ?string $annotation,
    )
    {
    }

    public static function fromArray(array $array, Company $company): Self {
        return new self(
            $array['id'],
            $company,
            $array['reseller'],
            $array['abbreviation'],
            $array['annotation'],
        );
    }
}