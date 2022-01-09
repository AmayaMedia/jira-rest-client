<?php

namespace Amayamedia\JiraRestClient;

use Amayamedia\JiraRestClient\Auth\AuthService;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class JiraRestClient
{
    public string $baseUrl = '';

    /**
     * JIRA REST API URI.
     *
     * @var string
     */
    protected $apiUri = '/rest/2';

    protected PendingRequest $http;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->http = Http::baseUrl($this->baseUrl);
    }

    protected function setAPIUri(string $uri)
    {
        $this->apiUri = $uri;
    }

    public function useAuth(AuthService $authService)
    {
        $this->http = $authService->http;
    }

    protected function get(string $uri, $data = [])
    {
        return $this->http->get($uri);
    }
    protected function post(string $uri, $data = [])
    {
        return $this->http->post($uri, $data);
    }
    protected function put(string $uri, $data = [])
    {
        return $this->http->put($uri, $data);
    }
    protected function patch(string $uri, $data = [])
    {
        return $this->http->patch($uri, $data);
    }
    protected function delete(string $uri)
    {
        return $this->http->delete($uri);
    }
}
