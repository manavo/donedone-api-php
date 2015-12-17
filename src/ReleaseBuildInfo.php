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
    private $id = null;
    /** @var string */
    private $title = null;
    /** @var array of int */
    private $order_numbers_ready_for_next_release = [];

    /**
     * ReleaseBuildInfo constructor.
     * @param array|null $data
     */
    function __construct($data = null)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->order_numbers_ready_for_next_release = $data['order_numbers_ready_for_next_release'];
    }

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

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'id'                                   => $this->id,
            'title'                                => $this->title,
            'order_numbers_ready_for_next_release' => $this->order_numbers_ready_for_next_release,
        ];

        return $data;
    }
}
