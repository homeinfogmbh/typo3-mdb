<?php

namespace Homeinfo\Pinlogin\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Repository;
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

class CustomerRepository extends Repository
{
    public function findByCurrentPageId(): QueryResultInterface {
        $query = $this->createQuery();
        return $query->execute();
    }
}
