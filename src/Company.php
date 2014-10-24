<?php

namespace Manavo\DoneDone;

class Company
{

    /**
     * @var string
     */
    private $name = null;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [
            'company_name' => $this->name,
        ];

        return $data;
    }

}
