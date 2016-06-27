<?php

namespace AoScrud\Repositories\Interfaces\Methods;

interface TitleInterface
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