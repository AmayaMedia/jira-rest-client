<?php

namespace Amayamedia\JiraRestClient\Auth;

use Amayamedia\JiraRestClient\utils\ClassSerialize;

class SessionInfo extends ClassSerialize
{
    /**
     * @var string
     */
    public string $name;

    /**
     * @var string
     */
    public string $value;
}
