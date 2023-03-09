<?php

namespace Homeinfo\mdb\Domain\Model;

use Generator;

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

    public static function fromPrefixedFields(array $array, string $prefix): Self
    {
        $addressFields = [];

        foreach ($array as $key => $value)
            if (str_starts_with($key, $prefix))
                $addressFields[ltrim($key, $prefix)] = $value;

        return Self::fromArray($addressFields);
    }

    public static function fromArray(array $array): Self
    {
        return new self(
            $array['id'],
            $array['street'],
            $array['house_number'],
            $array['zip_code'],
            $array['city'],
            $array['district'],
        );
    }

    public static function aliasedFields(string $alias): Generator
    {
        foreach (['id', 'street', 'house_number', 'zip_code', 'city', 'district'] as $field)
            yield $alias . '.' . $field . ' as ' . $alias . '_' . $field;
    }
}
