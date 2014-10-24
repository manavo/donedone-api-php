<?php

namespace Manavo\DoneDone;

class Project
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
     * @param Client $client
     * @param int    $id
     */
    function __construct($client, $id)
    {
        $this->client = $client;
        $this->id = $id;
    }

    /**
     * Get all the people associated with this project
     *
     * @return array
     */
    public function people()
    {
        return $this->client->get('projects/' . $this->id . '/people');
    }

    /**
     * Get all the issues associated with this project
     *
     * @return array
     */
    public function issues()
    {
        return $this->client->get('projects/' . $this->id . '/issues/all');
    }

    /**
     * Get all the active issues associated with this project
     *
     * @return array
     */
    public function activeIssues()
    {
        return $this->client->get(
            'projects/' . $this->id . '/issues/all_active'
        );
    }

    /**
     * Get all the closed and fixed issues associated with this project
     *
     * @return array
     */
    public function closedAndFixedIssues()
    {
        return $this->client->get(
            'projects/' . $this->id . '/issues/all_closed_and_fixed'
        );
    }

    /**
     * Get release builds of this project
     *
     * @return array
     */
    public function releaseBuilds()
    {
        return $this->client->get('projects/' . $this->id . '/release_builds');
    }

    /**
     * Add a new issue to the project
     *
     * @param Issue $issue
     *
     * @return array
     */
    public function addIssue($issue)
    {
        return $this->client->post(
            'projects/' . $this->id . '/issues', $issue->toArray()
        );
    }

}
