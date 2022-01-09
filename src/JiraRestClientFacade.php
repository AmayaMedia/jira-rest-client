<?php

namespace Amayamedia\JiraRestClient;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Amayamedia\JiraRestClient\JiraRestClient
 */
class JiraRestClientFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jira-rest-client';
    }
}
