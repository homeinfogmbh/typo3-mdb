<?php

namespace Homeinfo\mdb\Domain\Repository;

use Generator;

use TYPO3\CMS\Extbase\Persistence\Repository;

class CustomerMapRepository extends Repository
{
    public function getCustomerIds(): Generator {
        foreach ($this->findAll() as &$record)
        {
            yield $record->cid;
        }
    }
}