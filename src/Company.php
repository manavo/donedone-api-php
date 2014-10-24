<?php

namespace Manavo\DoneDone;

class Company
{

    /**
     * @var Client
     */
    private $client;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name = null;

    /**
     * @param Client $client
     * @param int $id
     */
    function __construct($client = null, $id = null)
    {
        $this->client = $client;
        $this->id = $id;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Update the name of a company
     *
     * @param string $newName
     * @return array
     */
    public function updateName($newName)
    {
        return $this->client->put('companies/'.$this->id, [
            'company_name' => $newName
        ]);
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
