<?php

namespace Amayamedia\JiraRestClient\Issue;

class Worklog
{
    public string $self;
    public array $author;
    public array $updateAuthor;
    public string $comment;
    public string $updated;
    public string $started;
    public string $timeSpent;
    public int $timeSpentSeconds;
    public string $id;
    public string $issueId;

    /**
     * Add values to properties on initializations
     *
     * @param array $params
     */
    public function __construct(array $params = [])
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                }
            }
        }
    }

    /**
     * Function to serialize obj vars.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_filter(get_object_vars($this));
    }

    /**
     * Set Comment property
     *
     * @param string $comment
     * @return Worklog
     */
    public function setComment(string $comment): Worklog
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Set time spent in string format, e.g. "3h 20m"
     *
     * @param string $timeSpent
     * @return Worklog
     */
    public function setTimeSpent(string $timeSpent): Worklog
    {
        $this->timeSpent = $timeSpent;

        return $this;
    }

    /**
     * Set time spent in seconds
     *
     * @param int $timeSpentSeconds
     * @return Worklog
     */
    public function setTimeSpentSeconds(int $timeSpentSeconds): Worklog
    {
        $this->timeSpentSeconds = $timeSpentSeconds;

        return $this;
    }
}
