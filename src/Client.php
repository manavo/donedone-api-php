<?php

namespace Manavo\DoneDone;

class Client
{

    /**
     * @var string
     */
    private $teamName;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $passwordOrApiToken;

    /**
     * @var \GuzzleHttp\Client
     */
    private $guzzleClient;

    /**
     * @param string $teamName
     * @param string $username
     * @param string $passwordOrApiToken
     */
    public function __construct($teamName, $username, $passwordOrApiToken)
    {
        $this->teamName = $teamName;
        $this->username = $username;
        $this->passwordOrApiToken = $passwordOrApiToken;

        $this->setClient(new \GuzzleHttp\Client([
            'defaults' => [
                'auth' => [$username, $passwordOrApiToken]
            ]
        ]));
    }

    /**
     * Get a list of all priority levels
     *
     * @return array
     */
    public function priorityLevels()
    {
        return $this->get('priority_levels');
    }

    /**
     * Get a list of all projects
     *
     * @return array
     */
    public function projects()
    {
        return $this->get('projects');
    }

    /**
     * Get a list of all companies
     *
     * @return array
     */
    public function companies()
    {
        return $this->get('companies');
    }

    /**
     * Get all the issues
     *
     * @return array
     */
    public function issues()
    {
        return $this->get('issues/all');
    }

    /**
     * Get all the active issues
     *
     * @return array
     */
    public function activeIssues()
    {
        return $this->get('issues/all_active');
    }

    /**
     * Get all the closed and fixed issues
     *
     * @return array
     */
    public function closedAndFixedIssues()
    {
        return $this->get('issues/all_closed_and_fixed');
    }

    /**
     * Get all the issues by a filter
     *
     * @param int $filter
     *
     * @return array
     */
    public function issuesByFilter($filter)
    {
        return $this->get('issues/by_global_custom_filter/' . $filter);
    }

    /**
     * Get all the issues which are waiting on you
     *
     * @return array
     */
    public function issuesWaitingOnYou()
    {
        return $this->get('issues/waiting_on_you');
    }

    /**
     * Get all the issues which are waiting on them
     *
     * @return array
     */
    public function issuesWaitingOnThem()
    {
        return $this->get('issues/waiting_on_them');
    }

    /**
     * Get a list of all global filters
     *
     * @return array
     */
    public function globalFilters()
    {
        return $this->get('global_custom_filters');
    }

    /**
     * Get a list of all issue creation types
     *
     * @return array
     */
    public function issueCreationTypes()
    {
        return $this->get('issue_creation_types');
    }

    /**
     * Get a list of all issue sort types
     *
     * @return array
     */
    public function issueSortTypes()
    {
        return $this->get('issue_sort_types');
    }

    /**
     * @param int $id
     *
     * @return Project
     */
    public function project($id)
    {
        return new Project($this, $id);
    }

    /**
     * @param int $id
     *
     * @return Company
     */
    public function company($id)
    {
        return new Company($this, $id);
    }

    /**
     * Create a new company
     *
     * @param Company $company
     *
     * @return array
     */
    public function createCompany($company)
    {
        return $this->post('companies', $company->toArray());
    }

    /**
     * Override the default Guzzle client
     *
     * @param \GuzzleHttp\Client $client
     */
    public function setClient($client)
    {
        $this->guzzleClient = $client;
    }

    /**
     * Generate the full URL from the specified endpoint
     *
     * @param string $endpoint
     *
     * @return string
     */
    private function getUrl($endpoint)
    {
        return sprintf(
            'https://%s.mydonedone.com/issuetracker/api/v2/%s.json',
            $this->teamName,
            $endpoint
        );
    }

    /**
     * @param string $endpoint
     * @param array  $data
     *
     * @return array
     */
    public function get($endpoint, $data = [])
    {
        $url = $this->getUrl($endpoint);

        $response = $this->guzzleClient->get($url, [
            'query' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $endpoint
     * @param array  $data
     *
     * @return array
     */
    public function post($endpoint, $data = [])
    {
        $url = $this->getUrl($endpoint);

        $response = $this->guzzleClient->post($url, [
            'body' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $endpoint
     * @param array  $data
     *
     * @return array
     */
    public function put($endpoint, $data = [])
    {
        $url = $this->getUrl($endpoint);

        $response = $this->guzzleClient->put($url, [
            'body' => $data
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}
