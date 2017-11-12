<?php

namespace AoScrud\Utils\Criteria;

use AoScrud\Services\Configs\Interfaces\IData;
use AoScrud\Services\Configs\Interfaces\IKeys;
use AoScrud\Services\Configs\Interfaces\IModel;

class RouteParamsCriteria extends BaseCriteria
{

    /**
     * @param IKeys|IData|IModel $config
     * @return mixed
     */
    public function apply($config)
    {
        if (!($config instanceof IKeys && $config instanceof IData && $config instanceof IModel))
            return;

        $keys = $config->keys()->all();
        if (empty($keys))
            return;

        $params = $config->data()->only($keys)->all();
        if (is_array($params) && count($params) > 0)
            $config->model($config->model()->where($params));
    }

}