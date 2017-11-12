<?php

namespace AoScrud\Services\Configs\Interfaces;

use Closure;
use Illuminate\Support\Collection;

interface IOrders
{

    /**
     * @param null|array|Collection|Closure $orders
     * @return $this|Collection
     */
    public function orders($orders = null);

    /**
     * @param array|Collection|Closure $orders
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