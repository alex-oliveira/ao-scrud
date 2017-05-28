<?php

namespace AoScrud\Utils\Tools;

use DB;

class Incrementer
{

    public static function search(array $items, $params = null)
    {
        $condition = false;

        if (!count($items))
            return;

        if (is_null($params)) {
            $condition = true;
        } elseif (is_array($params)) {
            foreach ($params as $param)
                if (strlen($param) > 0) {
                    $condition = true;
                }
        }

        if ($condition) {
            $ids = [];
            foreach ($items as $item)
                $ids[] = $item->id;

            DB::table($item->getTable())->whereIn('id', $ids)->increment('qt_searches');
        }
    }

    public static function show($obj)
    {
        DB::table($obj->getTable())->whereId($obj->id)->increment('qt_searches', 3);
    }

}