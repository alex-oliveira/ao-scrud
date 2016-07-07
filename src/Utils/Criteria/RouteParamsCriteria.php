<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Utils\Interfaces\Traits\DataInterface;
use AoScrud\Utils\Interfaces\Traits\KeysInterface;
use AoScrud\Utils\Interfaces\Traits\ModelInterface;

class RouteParamsCriteria extends BaseCriteria
{

    /**
     * @param KeysInterface|DataInterface|ModelInterface $config
     * @return mixed
     */
    public function apply($config)
    {
        if (!($config instanceof KeysInterface && $config instanceof DataInterface && $config instanceof ModelInterface))
            return;

        $keys = $config->keys();
        if (empty($keys))
            return;

        $params = $config->data()->only($keys)->all();
        if (is_array($params) && count($params) > 0)
            $config->model($config->model()->where($params));
    }

}