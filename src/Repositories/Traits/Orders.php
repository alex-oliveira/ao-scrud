<?php

namespace AoScrud\Repositories\Traits;

use Illuminate\Support\Collection;

trait Orders
{

    /**
     * @var null|Collection
     */
    protected $orders = null;

    /**
     * @param array|null $orders
     * @return $this|Collection
     */
    public function orders(array $orders = null)
    {
        if (is_null($orders))
            return $this->getOrders();
        return $this->setOrders($orders);
    }

    /**
     * @return Collection
     */
    public function getOrders()
    {
        return is_null($this->orders) ? $this->orders = collect([]) : $this->orders;
    }

    /**
     * @param array $orders
     * @return $this
     */
    public function setOrders(array $orders)
    {
        $this->orders = collect($orders);
        return $this;
    }

}