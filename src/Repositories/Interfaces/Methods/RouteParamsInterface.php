<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface RouteParamsInterface
{

    /**
     * @param array|null $params
     * @return $this|Collection
     */
    public function routeParams(array $params = null);

    /**
     * @return Collection
     */
    public function getRouteParams();

    /**
     * @param array $params
     * @return $this
     */
    public function setRouteParams(array $params);

}