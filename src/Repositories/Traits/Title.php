<?php

namespace AoScrud\Repositories\Traits;

trait Title
{

    /**
     * @var array
     */
    protected $title = '{{title undefined}}';

    /**
     * @param string|null $title
     * @return $this|string
     */
    public function title($title = null)
    {
        if (is_null($title))
            return $this->getTitle();
        return $this->setTitle($title);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

}