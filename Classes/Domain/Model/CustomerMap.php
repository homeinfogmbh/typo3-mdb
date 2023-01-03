<?php

namespace Homeinfo\mdb\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

class CustomerMap extends AbstractEntity
{
    /**
     * @var int
     */
    public $uid;

    /**
     * @var int
     */
    public $pid;

    /**
     * @var int
     */
    public $cruser_id;

    /**
     * @var int
     */
    public $tstamp;

    /**
     * @var int
     */
    public $crdate;

    /**
     * @var bool
     */
    public $deleted;

    /**
     * @var bool
     */
    public $hidden;

    /**
     * @var int
     */
    public $sys_language_uid;

    /**
     * @var int
     */
    public $l18n_parent;

    // /**
    //  * @var bytesarray
    //  */
    // public $l18n_diffsource;

    /**
     * @var int
     */
    public $fe_group;

    /**
     * @var int
     */
    public $parent_id;

    /**
     * @var int
     */
    public $sorting;

    // /**
    //  * @var int
    //  */
    // public $l10n_parent;

    /**
     * @var int
     */
    public $starttime;

    /**
     * @var int
     */
    public $endtime;
}