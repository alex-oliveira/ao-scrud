<?php

namespace AoScrud\Repositories\Interfaces\Methods;

use Illuminate\Support\Collection;

interface OrdersInterface
{

    /**
     * @param array|null $orders
     * @return $this|Collection
     */
    public function orders(array $orders = null);

    /**
     * @return Collection
     */
    public function getOrders();

    /**
     * @param array $orders
     * @return $this
     */
    public function setOrders(array $orders);

}