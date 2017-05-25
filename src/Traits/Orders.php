<?php

namespace AoScrud\Traits;

use AoScrud\Interfaces\IColumns;
use Closure;
use Illuminate\Support\Collection;

trait Orders
{

    /**
     * @var null|array|Closure|Collection
     */
    protected $orders = null;

    /**
     * @param null|array|Closure|Collection $orders
     * @return $this|Collection
     */
    public function orders($orders = null)
    {
        if (is_null($orders))
            return $this->getOrders();
        return $this->setOrders($orders);
    }

    /**
     * @param array|Closure|Collection $orders
     * @return $this
     */
    public function setOrders($orders)
    {
        $this->orders = is_array($orders) ? collect($orders) : $orders;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getOrders()
    {
        if ($this->orders instanceof Collection)
            return $this->orders;

        if (is_null($this->orders))
            return $this->orders = collect([]);

        if (is_array($this->orders))
            return $this->orders = collect($this->orders);

        if ($this->orders instanceof Closure) {
            $closure = $this->orders;
            $result = $closure($this);
            return is_array($result) ? collect($result) : $result;
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