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

    public static function fromJoinedRecord(array $record): Self {
        return Self::fromArray(
            $record,
            Company::fromArray(
                [
                    'id' => $record['company_id'],
                    'name' => $record['company_name'],
                    'annotation' => $record['company_annotation'],
                ],
                (($address_id = $record['address_id']) === null) ? null : Address::fromArray([
                    'id' => $address_id,
                    'street' => $record['address_street'],
                    'house_number' => $record['address_house_number'],
                    'zip_code' => $record['address_zip_code'],
                    'city' => $record['address_city'],
                    'district' => $record['address_district'],
                ]),
            )
        );
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