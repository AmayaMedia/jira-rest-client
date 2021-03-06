<?php

namespace Amayamedia\JiraRestClient\Auth;

use Amayamedia\JiraRestClient\JiraRestClient;
use GuzzleHttp\Cookie\CookieJar;

class AuthService extends JiraRestClient
{
    private array $jiraUser = [];

    private CookieJar $cookies;

    public function __construct(string $baseUrl = '')
    {
        parent::__construct($baseUrl);
        $this->setAPIUri('/rest/auth/1/session');
    }

    /**
     * Return the current user if logged in
     *
     * @return array|mixed
     */
    public function currentUser()
    {
        // @todo: return cache user
        $response = $this->get($this->apiUri);

        return $response->json();
    }

    /**
     * Start a new user session
     *
     * @param null $username
     * @param null $password
     * @return AuthService
     */
    public function login($username = null, $password = null): AuthService
    {
        if (!$username) {
            $username = $this->jiraUser['name'];
        }

        if (!$password) {
            $password = $this->jiraUser['password'];
        }

        // @todo: Make request
        $response = $this->post($this->apiUri, [
            'username' => $username,
            'password' => $password,
        ]);

        // Save cookies?
        $this->cookies = $response->cookies();
        // $this->http->withCookies((array) $response->cookies(), $this->baseUrl);

        // @todo: Map session

        // @todo: save cookies?

        // @todo: Return session?
        return $this;
    }

    /**
     * Destroy the current user session
     *
     * @return void
     */
    public function logout()
    {
        $this->delete($this->apiUri);
    }
}
