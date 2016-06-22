<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait RouteParams
{

    /**
     * @var null|Collection
     */
    protected $routeParams = null;

    /**
     * @param array|null $params
     * @return $this|Collection
     */
    public function routeParams(array $params = null)
    {
        if (is_null($params))
            return $this->getRouteParams();
        return $this->setRouteParams($params);
    }

    /**
     * @return Collection
     */
    public function getRouteParams()
    {
        return is_null($this->routeParams) ? $this->routeParams = collect([]) : $this->routeParams;
    }

    /**
     * @param array $params
     * @return $this
     */
    public function setRouteParams(array $params)
    {
        $this->routeParams = collect($params);
        return $this;
    }

}