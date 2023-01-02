<?php

namespace Homeinfo\mdb\Domain\Model;

final class Address
{
    function __construct(
        public readonly int $id,
        public readonly string $street,
        public readonly string $house_number,
        public readonly string $zip_code,
        public readonly string $city,
        public readonly ?string $district,
    )
    {
    }

    public static function fromArray(array $array): Self {
        return new self(
            $array['id'],
            $array['street'],
            $array['house_number'],
            $array['zip_code'],
            $array['city'],
            $array['district'],
        );
    }
}