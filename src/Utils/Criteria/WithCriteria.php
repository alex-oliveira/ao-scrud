<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Services\Configs\Interfaces\IData;
use AoScrud\Services\Configs\Interfaces\IModel;
use AoScrud\Services\Configs\Interfaces\IWith;
use Illuminate\Support\Collection;

class WithCriteria extends BaseCriteria
{

    /**
     * @var mixed
     */
    private $config;

    /**
     * @var Collection
     */
    private $allowed;

    /**
     * @var array
     */
    private $approved = [];

    /**
     * @param IWith|IData|IModel $config
     * @return mixed
     */
    public function apply($config)
    {
        if (!($config instanceof IWith && $config instanceof IData && $config instanceof IModel))
            return;

        if ($config->with()->isEmpty())
            return;

        $this->config = $config;

        $this->allowed = $config->with();
        foreach ($this->allowed as $key => $value) {
            if (is_numeric($key))
                $this->allowed->forget($key)->put($value, '*');
        }

        foreach (explode('|', $config->data()->get('with', '')) as $with) {
            $parts = explode(':', $with);

            if (count($parts) > 0 && $this->allowed->has($parts[0]))
                $this->processWith($parts[0], (isset($parts[1]) ? $parts[1] : ''));
        }

        if (count($this->approved) > 0)
            $config->model($config->model()->with($this->approved));
    }

    //------------------------------------------------------------------------------------------------------------------

    protected function processWith($name, $columns)
    {
        $settings = $this->allowed->get($name);

        if ($this->settingWithoutColumns($name, $columns, $settings))
            return;

        if ($this->requestWithoutColumns($name, $columns, $settings))
            return;

        if ($this->requestAllColumns($name, $columns, $settings))
            return;

        $this->requestSpecificColumns($name, $columns, $settings);
    }

    protected function settingWithoutColumns($name, $columns, $settings)
    {
        if (is_string($settings) && $settings == '*') {
            $this->setApproved($name);
            return true;
        }
        return false;
    }

    protected function requestWithoutColumns($name, $columns, $settings)
    {
        if ($columns == '') {
            $this->setApproved($name, self::getDefaultFields($settings));
            return true;
        }
        return false;
    }

    protected function requestAllColumns($name, $columns, $settings)
    {
        if ($columns == '*') {
            $this->setApproved($name, self::getAllowedFields($settings));
            return true;
        }
        return false;
    }

    protected function requestSpecificColumns($name, $columns, $settings)
    {
        $requests = explode(',', $columns);

        $fields = [];
        foreach (self::getAllowedFields($settings) as $key => $value)
            if (in_array($value, $requests))
                $fields[$key] = $value;

        if (count($fields) == 0)
            $fields = self::getDefaultFields($settings);

        $this->setApproved($name, $fields);
    }

    //------------------------------------------------------------------------------------------------------------------

    protected function setApproved($name, array $fields = [])
    {
        $columns = [];
        foreach ($fields as $key => $value)
            $columns[] = is_string($key) && !is_numeric($key) ? $key : $value;

        $settings = $this->allowed->get($name);
        $custom = false;
        if (is_array($settings) && isset($settings['custom']))
            $custom = $settings['custom'];

        if (count($columns) > 0) {
            if ($custom instanceof \Closure) {
                $config = $this->config;
                $this->approved[$name] = function ($query) use ($columns, $custom, $config) {
                    $query->select($columns);
                    $custom($config, $query);
                };
            } else {
                $this->approved[$name] = function ($query) use ($columns) {
                    $query->select($columns);
                };
            }
        } else {
            $this->approved[] = $name;
        }
    }

    protected static function getDefaultFields($settings)
    {
        $fields = [];

        if (isset($settings['columns'])) {
            if (is_string($settings['columns']))
                $fields = explode(',', $settings['columns']);
            elseif (is_array($settings['columns']))
                $fields = $settings['columns'];

        } elseif (is_string($settings)) {
            $fields = explode(',', $settings);
        } elseif (is_array($settings)) {
            $fields = $settings;
        }

        return $fields;
    }

    protected static function getAllowedFields($settings)
    {
        $fields = self::getDefaultFields($settings);

        if (isset($settings['otherColumns'])) {
            $others = [];

            if (is_string($settings['otherColumns']))
                $others = explode(',', $settings['otherColumns']);
            elseif (is_array($settings['otherColumns']))
                $others = $settings['otherColumns'];

            $fields = array_merge($fields, $others);
        }

        return $fields;
    }

}