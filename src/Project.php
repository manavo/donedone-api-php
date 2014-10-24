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

    public function issue($id)
    {
        return new Issue($this->client, $this->id, $id);
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
     * Get all the issues by a filter associated with this project
     *
     * @param int $filter
     *
     * @return array
     */
    public function issuesByFilter($filter)
    {
        return $this->client->get(
            sprintf(
                'projects/%d/issues/by_custom_filter/%d',
                $this->id,
                $filter
            )
        );
    }

    /**
     * Get all the issues which are waiting on you, and are associated with
     * this project
     *
     * @return array
     */
    public function issuesWaitingOnYou()
    {
        return $this->client->get(
            sprintf('projects/%d/issues/waiting_on_you', $this->id)
        );
    }

    /**
     * Get all the issues which are waiting on them
     *
     * @return array
     */
    public function issuesWaitingOnThem()
    {
        return $this->client->get(
            sprintf('projects/%d/issues/waiting_on_them', $this->id)
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
     * Get filters of this project
     *
     * @return array
     */
    public function filters()
    {
        return $this->client->get('projects/' . $this->id . '/custom_filters');
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

    /**
     * Create a new release build for the project
     *
     * @param ReleaseBuild $releaseBuild
     *
     * @return array
     */
    public function createReleaseBuild($releaseBuild)
    {
        return $this->client->post(
            sprintf('projects/%d/release_builds', $this->id),
            $releaseBuild->toArray()
        );
    }

}
