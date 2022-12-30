<?php

return [
    'ctrl' => [
        'title' => 'Customer IDs',
        'label' => 'cid',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'sortby' => 'sorting',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'name,',
        'iconfile' => 'EXT:mdb/Resources/Public/Icons/Extension.svg',
    ],
    'types' => [
        '1' => ['showitem' => 'hidden, cid'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => 1,
            'label' => 'Hide',
            'config' => [
                'type' => 'check',
            ],
        ],
        'cid' => [
            'exclude' => false,
            'label' => 'Customer ID',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',                
                'size' => 1,
                'minitems' => 0,
            ],
        ],
    ],
];
