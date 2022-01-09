<?php

namespace Amayamedia\JiraRestClient;

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

    protected function get(string $uri)
    {
        return $this->http->get($uri);
    }
    protected function post($uri, $data)
    {
        return $this->http->post($uri, $data);
    }
    protected function put($data)
    {
        // @todo
    }
    protected function patch($data)
    {
        // @todo
    }
    protected function delete($uri)
    {
        return $this->http->delete($uri);
    }
}
