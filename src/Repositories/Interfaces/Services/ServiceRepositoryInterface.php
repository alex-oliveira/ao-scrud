<?php

namespace AoScrud\Repositories\Interfaces\Services;

interface ServiceRepositoryInterface
{

    public function search(array $data);

    public function read(array $data);

    public function create(array $data);

    public function update(array $data);

    public function destroy(array $data);

    public function restore(array $data);

}