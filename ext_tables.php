<?php
defined('TYPO3_MODE') || die();

// allow table entries to be added to normal pages
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_mdb_domain_model_customermap');


\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
    'mdb',
    'mdb',
    '',
    '',
    [
        \Homeinfo\mdb\Controller\DebugController::class => 'index',
    ],
    [
        'access' => 'user',
        'labels' => 'LLL:EXT:mdb/Resources/Private/Language/locallang_be.xlf:backend.customers.label',
        'inheritNavigationComponentFromMainModule' => false,
        'standalone' => true,
    ]
);