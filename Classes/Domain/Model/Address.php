<?php

namespace Homeinfo\mdb\Domain\Model;

use Generator;

final class Address
{
    private const FIELDS = [
        'id',
        'street',
        'house_number',
        'zip_code',
        'city',
        'district'
    ];

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

    public static function fromPrefixedFields(array $array, string $prefix): ?Self
    {
        $addressFields = [];

        foreach ($array as $key => $value)
            if (str_starts_with($key, $prefix))
                $addressFields[substr($key, strlen($prefix))] = $value;

        return Self::fromArray($addressFields);
    }

    public static function fromArray(array $array): ?Self
    {
        if (($id = $array['id'] ?? NULL) === NULL)
            return NULL;

        if (($street = $array['street'] ?? NULL) === NULL)
            return NULL;
            
        if (($house_number = $array['house_number'] ?? NULL) === NULL)
            return NULL;
            
        if (($zip_code = $array['zip_code'] ?? NULL) === NULL)
            return NULL;
            
        if (($city = $array['city'] ?? NULL) === NULL)
            return NULL;

        return new self(
            $id,
            $street,
            $house_number,
            $zip_code,
            $city,
            $array['district'],
        );
    }

    public static function aliasedFields(string $alias): Generator
    {
        foreach (Self::FIELDS as $field)
            yield $alias . '.' . $field . ' as ' . $alias . '_' . $field;
    }
}
