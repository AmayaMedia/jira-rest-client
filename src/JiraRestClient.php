<?php

namespace Amayamedia\JiraRestClient;

use Amayamedia\JiraRestClient\Auth\AuthService;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use JsonMapper;

class JiraRestClient
{
    public string $baseUrl = '';

    /**
     * JIRA REST API URI.
     *
     * @var string
     */
    protected $apiUri = '/rest/2';

    protected JsonMapper $jsonMapper;

    protected PendingRequest $http;

    public function __construct(string $baseUrl)
    {
        $this->baseUrl = $baseUrl;
        $this->http = Http::baseUrl($this->baseUrl);
        $this->jsonMapper = new JsonMapper();
    }

    /**
     * Sets the default API endpoint
     * @param string $uri
     */
    protected function setAPIUri(string $uri)
    {
        $this->apiUri = $uri;
    }

    /**
     * Use an existing HTTP Client
     *
     * @param AuthService $authService
     */
    public function useAuth(AuthService $authService)
    {
        $this->http = $authService->http;
    }

    /**
     * Make a GET request
     *
     * @param string $uri
     * @param array $data
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    protected function get(string $uri, $data = [])
    {
        return $this->http->get($uri);
    }

    /**
     * Make a POST request
     *
     * @param string $uri
     * @param array $data
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    protected function post(string $uri, $data = [])
    {
        return $this->http->post($uri, $data);
    }

    /**
     * Make a PUT request
     * @param string $uri
     * @param array $data
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    protected function put(string $uri, $data = [])
    {
        return $this->http->put($uri, $data);
    }

    /**
     * Make a PATCH request
     *
     * @param string $uri
     * @param array $data
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    protected function patch(string $uri, $data = [])
    {
        return $this->http->patch($uri, $data);
    }

    /**
     * Make a DELETE request
     *
     * @param string $uri
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    protected function delete(string $uri)
    {
        return $this->http->delete($uri);
    }
}
