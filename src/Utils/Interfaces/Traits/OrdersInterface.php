<?php

namespace AoScrud\Utils\Interfaces\Traits;

use Closure;
use Illuminate\Support\Collection;

interface OrdersInterface
{

    /**
     * @param null|array|Closure|Collection $orders
     * @return $this|Collection
     */
    public function orders($orders = null);

    /**
     * @param array|Closure|Collection $orders
     * @return $this
     */
    public function setOrders($orders);

    /**
     * @return Collection
     */
    public function getOrders();

    //------------------------------------------------------------------------------------------------------------------

    /**
     * @param array $except
     * @return $this
     */
    public function setAllOrders(array $except = []);

}