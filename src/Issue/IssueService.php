<?php

namespace Amayamedia\JiraRestClient\Issue;

use Amayamedia\JiraRestClient\Auth\AuthService;
use Amayamedia\JiraRestClient\JiraRestClient;

class IssueService extends JiraRestClient
{
    public function __construct(string $baserUrl = '')
    {
        parent::__construct($baserUrl);
        $this->setAPIUri('/rest/api/2/issue/');
    }

    /**
     * Returns the issue with the provided issue key
     *
     * @param string $issueKey
     * @param array $params
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function getIssue(string $issueKey, $params = [])
    {
        $response = $this->get($this->apiUri . $issueKey);

        return $response->json();
    }

    /**
     * Get all worklogs for the provided issue key
     * @param string $issueKey
     * @return array|mixed
     */
    public function getWorklog(string $issueKey)
    {
        // GET /rest/api/2/issue/{issueIdOrKey}/worklog
        $response = $this->get($this->apiUri . $issueKey . '/worklog/');

        return $response->ok() ? $response->json() : ['message' => $response->reason()];
    }

    /**
     * Get Worklog for the provided issue key and worklog id
     * @param string $issueKey
     * @param int $worklogId
     * @return array|mixed
     */
    public function getWorklogById(string $issueKey, int $worklogId)
    {
        // GET /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
        $response = $this->get($this->apiUri . $issueKey . '/worklog/' . $worklogId);

        return $response->ok() ? $response->json() : ['message' => $response->reason()];
    }

    /**
     * Add Worklog to for the provided issue key
     *
     * @param string $issueKey
     * @param Worklog $worklog
     * @return array|mixed
     */
    public function addWorklog(string $issueKey, Worklog $worklog)
    {
        // POST /rest/api/2/issue/{issueIdOrKey}/worklog
        $response = $this->post($this->apiUri . $issueKey . '/worklog/', $worklog->toArray());

        return $response->ok() ? $response->json() : ['message' => $response->reason()];
    }

    /**
     * Update an existing Worklog for the provided issue key and worklog id
     *
     * @param string $issueKey
     * @param int $worklogId
     * @param Worklog $worklog
     * @return array|mixed
     */
    public function updateWorklog(string $issueKey, int $worklogId, Worklog $worklog)
    {
        // PUT /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
        $response = $this->put($this->apiUri . $issueKey . '/worklog/' . $worklogId, $worklog);

        return $response->ok() ? $response->json() : ['message' => $response->reason()];
    }

    /**
     * Delete an worklog for the provided issue key and worklog id
     * @param string $issueKey
     * @param int $worklogId
     * @return array|mixed
     */
    public function deleteWorklog(string $issueKey, int $worklogId)
    {
        // DELETE /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
        $response = $this->delete($this->apiUri . $issueKey . '/worklog/' . $worklogId);

        return $response->ok() ? $response->json() : ['message' => $response->reason()];
    }
}
