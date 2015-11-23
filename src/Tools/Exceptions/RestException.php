<?php

namespace AoRest;

class RestException extends \Exception
{

    protected $alerts = [];

    public function setAlerts(array $alerts)
    {
        $this->alerts = $alerts;
        return $this;
    }

    public function getAlerts()
    {
        return $this->alerts;
    }

    public function addAlert($alert)
    {
        $this->alerts[] = $alert;
        return $this;
    }

}