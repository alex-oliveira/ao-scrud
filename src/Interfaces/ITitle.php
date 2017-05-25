<?php

namespace AoScrud\Interfaces;

interface ITitle
{

    /**
     * @param string|null $title
     * @return $this|string
     */
    public function title($title = null);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title);

}