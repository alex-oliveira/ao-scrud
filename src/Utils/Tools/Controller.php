<?php

namespace AoScrud\Utils\Tools;

use Illuminate\Support\Collection;

class Controller
{
    public function toArray($data)
    {
        if (is_array($data))
            return $data;

        if (is_object($data) && method_exists($data, 'toArray'))
            return $data->toArray();

        if ($data instanceof Collection)
            return $data->all();

        return $data;
    }

    public function search($service)
    {
        $data = $service->search(AoScrud()->params()->all());
        return response()->json($this->toArray($data), 200);
    }

    public function create()
    {

    }

    public function read()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }

    public function restore()
    {

    }

}
