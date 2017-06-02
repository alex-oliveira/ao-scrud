<?php

namespace AoScrud\Configs\Traits;

use AoScrud\Configs\Interfaces\IColumns;
use Closure;
use Illuminate\Support\Collection;

trait Orders
{

    /**
     * @var null|Collection|Closure
     */
    protected $orders = null;

    /**
     * @param null|array|Collection|Closure $orders
     * @return $this|Collection
     */
    public function orders($orders = null)
    {
        if (is_null($orders))
            return $this->getOrders();
        return $this->setOrders($orders);
    }

    /**
     * @param array|Collection|Closure $orders
     * @return $this
     */
    public function setOrders($orders)
    {
        if (is_array($orders))
            $this->orders = collect($orders);

        elseif ($orders instanceof Collection || $orders instanceof Closure)
            $this->orders = $orders;

        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrders()
    {
        if ($this->orders instanceof Collection)
            return $this->orders;

        if ($this->orders instanceof Closure) {
            $closure = $this->orders;
            $result = $closure($this);
            is_array($result) ? $result = collect($result) : null;
            return $result instanceof Collection ? $result : collect([]);
        }

        return $this->orders = collect([]);
    }

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param array $except
     * @return $this
     */
    public function setAllOrders(array $except = [])
    {
        if ($this instanceof IColumns)
            $this->setOrders($this->getAllColumns($except));

        return $this;
    }

}