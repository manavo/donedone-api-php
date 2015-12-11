<?php
/**
 * Created by PhpStorm.
 * User: k127
 * Date: 11.12.15
 * Time: 15:49
 */

namespace Manavo\DoneDone;

/**
 * Class ReleaseBuildInfo
 * @package Manavo\DoneDone
 */
class ReleaseBuildInfo
{
    /** @var int */
    private $id;
    /** @var string */
    private $title;
    /** @var array of int */
    private $order_numbers_ready_for_next_release;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getOrderNumbersReadyForNextRelease()
    {
        return $this->order_numbers_ready_for_next_release;
    }
}
