<?php

namespace Homeinfo\mdb\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;

use Homeinfo\mdb\Domain\Repository\CustomerRepository;
use Homeinfo\mdb\Domain\Repository\CustomerMapRepository;

class DebugController extends ActionController
{
    public function indexAction()
    {
        
        // $repository = GeneralUtility::makeInstance(ObjectManager::class)
        //     ->get(CustomerRepository::class);
        // $records = $repository->list();
        $repository = GeneralUtility::makeInstance(ObjectManager::class)
            ->get(CustomerMapRepository::class);
        $records = $repository->findAll();
        DebuggerUtility::var_dump($records, "Records: ");
        $this->view->assign('check_results', $records);
    }
}
