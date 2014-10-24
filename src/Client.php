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
     * @param $endpoint
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

        return $response->json();
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

        return $response->json();
    }

}
