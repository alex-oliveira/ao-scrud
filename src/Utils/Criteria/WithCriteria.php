<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;
use AoScrud\Utils\Interfaces\Traits\WithInterface;
use Illuminate\Support\Collection;

class WithCriteria extends BaseCriteria
{

    /**
     * @var Collection
     */
    private $allowed;

    /**
     * @var array
     */
    private $approved = [];

    /**
     * @param ModelInterface|DataInterface|WithInterface
     * @return mixed
     */
    public function apply($config)
    {
        if (!($config instanceof ModelInterface && $config instanceof DataInterface && $config instanceof WithInterface))
            return;

        if ($config->with()->isEmpty())
            return;

        $this->allowed = $config->with();
        foreach ($this->allowed as $key => $value) {
            if (is_numeric($key))
                $this->allowed->forget($key)->put($value, '*');
        }

        foreach (explode('|', $config->data()->get('with', '')) as $with) {
            $parts = explode(':', $with);
            if (count($parts) == 0)
                continue;

            if (!$this->allowed->has($parts[0]))
                continue;

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
        $fields = array_intersect(explode(',', $columns), self::getAllowedFields($settings));

        if (count($fields) == 0)
            $fields = self::getDefaultFields($settings);

        $this->setApproved($name, $fields);
    }

    //------------------------------------------------------------------------------------------------------------------

    protected function setApproved($name, array $fields = [])
    {
        if (count($fields) > 0) {
            $this->approved[$name] = function ($query) use ($fields) {
                $query->select($fields);
            };
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