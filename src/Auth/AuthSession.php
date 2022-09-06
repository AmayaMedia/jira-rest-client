<?php

namespace Amayamedia\JiraRestClient\Auth;

use Amayamedia\JiraRestClient\utils\ClassSerialize;

class AuthSession extends ClassSerialize
{
    /**
     * @var SessionInfo
     */
    public SessionInfo $session;

    /**
     * @var LoginInfo
     */
    public LoginInfo $loginInfo;

    public array $errorMessages;

    public array $errors;
}
