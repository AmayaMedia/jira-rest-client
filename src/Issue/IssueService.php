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
    public function getIssue(string $issueKey)
    {
        return $this->get($this->apiUri . $issueKey);
    }

    /**
     * Get all worklogs for the provided issue key
     * GET /rest/api/2/issue/{issueIdOrKey}/worklog
     *
     * @param string $issueKey
     * @return array|mixed
     */
    public function getWorklogs(string $issueKey)
    {
        return $this->get($this->apiUri . $issueKey . '/worklog/');
    }

    /**
     * Get Worklog for the provided issue key and worklog id
     * GET /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
     *
     * @param string $issueKey
     * @param int $worklogId
     * @return array|mixed
     */
    public function getWorklogById(string $issueKey, int $worklogId)
    {
        $response = $this->get($this->apiUri . $issueKey . '/worklog/' . $worklogId);

        return $response->ok() ? $response->json() : ['message' => $response->reason()];
    }

    /**
     * Add Worklog to for the provided issue key
     * POST /rest/api/2/issue/{issueIdOrKey}/worklog
     * POST /rest/tempo-timesheets/4/worklogs
     *
     * @param string $issueKey
     * @param Worklog $worklog
     * @return array|mixed
     */
    public function addWorklog(string $issueKey, Worklog $worklog)
    {
        // Let's attempt JIRA's default api endpoint
        $response = $this->post($this->apiUri . $issueKey . '/worklog/', $worklog->toArray());

        // Let's try Tempo's API in case JIRA's default failed
        if ($response->status() === 500 || !$response->ok()) {
            $response = $this->post('/rest/tempo-timesheets/4/worklogs', $worklog->toArray());
        }

        return $response;
    }

    /**
     * Update an existing Worklog for the provided issue key and worklog id
     * PUT /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
     * PUT /rest/tempo-timesheets/4/worklogs/{id}
     *
     * @param string $issueKey
     * @param int $worklogId
     * @param Worklog $worklog
     * @return array|mixed
     */
    public function updateWorklog(string $issueKey, int $worklogId, Worklog $worklog)
    {
        // Let's attempt JIRA's default api endpoint
        $response = $this->put($this->apiUri . $issueKey . '/worklog/' . $worklogId, $worklog->toArray());

        // Let's try Tempo's API in case JIRA's default failed
        if ($response->status() === 500 || !$response->ok()) {
            $response = $this->put('/rest/tempo-timesheets/4/worklogs/' . $worklogId, $worklog->toArray());
        }

        return $response;
    }

    /**
     * Delete a worklog for the provided issue key and worklog id
     * DELETE /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
     *
     * @param string $issueKey
     * @param int $worklogId
     * @return array|mixed
     */
    public function deleteWorklog(string $issueKey, int $worklogId)
    {
        return $this->delete($this->apiUri . $issueKey . '/worklog/' . $worklogId);

    }
}
