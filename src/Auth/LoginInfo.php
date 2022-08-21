<?php

namespace Amayamedia\JiraRestClient\Auth;

use Amayamedia\JiraRestClient\utils\ClassSerialize;

class LoginInfo extends ClassSerialize
{
    /**
     * @var int
     */
    public int $failedLoginCount;

    /**
     * @var int
     */
    public int $loginCount;

    /**
     * * timestamp string "2022-01-01T11:40:59.771+0000".
     *
     * @var string
     */
    public string $lastFailedLoginTime;

    /**
     * * timestamp string "2022-01-01T11:40:59.771+0000".
     *
     * @var string
     */
    public string $previousLoginTime;
}
