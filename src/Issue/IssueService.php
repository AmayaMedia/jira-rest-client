<?php

namespace Amayamedia\JiraRestClient\Issue;

use Amayamedia\JiraRestClient\Auth\AuthService;
use Amayamedia\JiraRestClient\JiraRestClient;

class IssueService extends JiraRestClient
{
    private AuthService $authClient;

    public function __construct(string $baserUrl = '')
    {
        parent::__construct($baserUrl);
        $this->setAPIUri('/rest/api/2/issue/');
    }

    /**
     * @param string $issueKey
     * @param array $params
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public function getIssue(string $issueKey, $params = [])
    {
        $response = $this->get($this->apiUri . $issueKey);

        return $response->json();
    }

    public function getWorklog(string $issueKey)
    {
        // GET /rest/api/2/issue/{issueIdOrKey}/worklog
        $response = $this->get($this->apiUri . $issueKey . '/worklog/');

        return $response->json();
    }

    public function getWorklogById(string $issueKey, int $worklogId)
    {
        // GET /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
        $response = $this->get($this->apiUri . $issueKey . '/worklog/' . $worklogId);

        return $response->json();
    }

    public function addWorklog(string $issueKey, $worklog = [])
    {
        // POST /rest/api/2/issue/{issueIdOrKey}/worklog
        $response = $this->post($this->apiUri . $issueKey . '/worklog/', $worklog);

        return $response->json();
    }

    public function updateWorklog(string $issueKey, int $worklogId, $worklog = [])
    {
        // PUT /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
        $response = $this->put($this->apiUri . $issueKey . '/worklog/' . $worklogId, $worklog);

        return $response->json();
    }

    public function deleteWorklog(string $issueKey, int $worklogId)
    {
        // DELETE /rest/api/2/issue/{issueIdOrKey}/worklog/{id}
        $response = $this->delete($this->apiUri . $issueKey . '/worklog/' . $worklogId);

        return $response->json();
    }
}
