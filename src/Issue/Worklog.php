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

    public function __construct(array $params = [])
    {
        if (!empty($params)) {
            foreach ($params as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->{$key} = $value;
                } else {
                    dd([$key => 'doesn\'t exist']);
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

    public function setComment(string $comment): Worklog
    {
        $this->comment = $comment;

        return $this;
    }

    public function setTimeSpent(string $timeSpent): Worklog
    {
        $this->timeSpent = $timeSpent;

        return $this;
    }

    public function setTimeSpentSeconds(int $timeSpentSeconds): Worklog
    {
        $this->timeSpentSeconds = $timeSpentSeconds;

        return $this;
    }
}
