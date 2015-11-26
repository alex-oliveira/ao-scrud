<?php

namespace AoScrud\Tools\Formatters;

abstract class FormatterAbstract
{

    /**
     * Responsible method for filter the data of the registry.
     *
     * @param $data \Illuminate\Support\Collection
     */
    abstract public function apply($data);

}