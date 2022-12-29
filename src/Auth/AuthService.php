<?php

namespace Amayamedia\JiraRestClient\Auth;

use Amayamedia\JiraRestClient\JiraRestClient;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Facades\Http;

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
        return $this->http->get($this->apiUri);
    }

    /**
     * Start a new user session
     *
     * @param null $username
     * @param null $password
     * @return AuthService
     */
    public function login($username = null, $password = null): AuthSession
    {
        if (!$username) {
            $username = $this->jiraUser['name'];
        }

        if (!$password) {
            $password = $this->jiraUser['password'];
        }

        $response = $this->post($this->apiUri, [
            'username' => $username,
            'password' => $password,
        ]);

        // Return user session
        // @TODO: handle errors
        return $this->jsonMapper->map(json_decode(json_encode($response->json())), new AuthSession());
    }

    /**
     * Destroy the current user session
     *
     * @return void
     */
    public function logout()
    {
        return $this->http->delete($this->apiUri);

        // return $response->status() === 204 ? ['message' => 'Success'] : $response->json();
    }

    /**
     * @param array $cookies
     * @return $this
     */
    public function authorizeWithCookie(array $cookies)
    {
        $headers = [];
        foreach ($cookies as $name => $value) {
            // Set Cookie header
            $headers['Cookie'] = "$name=$value;";
        }

        // Set Cookies as Headers because `::withCookies` is weird
        $cookiedClient = Http::withHeaders($headers);
        $cookiedClient->baseUrl($this->baseUrl);

        $this->http = $cookiedClient;
        return $this;
    }
}
