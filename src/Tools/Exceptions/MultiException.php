<?php

namespace AoScrud\Tools\Exceptions;

class MultiException extends \Exception
{

    protected $issues = [];

    public function getIssues()
    {
        return $this->issues;
    }

    public function addIssue($issue)
    {
        $this->issues[] = $issue;
        return $this;
    }

    public function setIssues(array $issues)
    {
        $this->issues = $issues;
        return $this;
    }

}