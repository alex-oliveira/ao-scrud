<?php

namespace AoScrud\Repositories\Traits;

trait Limit
{

    /**
     * @var int
     */
    protected $limit = 50;

    /**
     * @param int|null $limit
     * @return $this|int
     */
    public function limit($limit = null)
    {
        if (is_null($limit))
            return $this->getLimit();
        return $this->setLimit($limit);
    }

    /**
     * @return int
     */
    public function getLimit()
    {
//    /**
//     * @param Collection $data
//     * @return int
//     */
//    protected function makeLimit(Collection $data)
//    {
//        $limit = $data->get('limit', false);
//        $limit = $limit && is_numeric($limit) && is_int($limit + 0) && $limit > 0 && $limit <= $this->limit()
//            ? $limit
//            : 24;
//
//        return $limit;
//    }

        return $this->limit;
    }

    /**
     * @param int $limit
     * @return $this
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }

}