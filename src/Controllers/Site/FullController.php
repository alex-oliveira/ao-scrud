<?php

namespace AoScrud\Controllers\Site;

use AoScrud\Controllers\Site\Traits\CreateTrait;
use AoScrud\Controllers\Site\Traits\DeleteTrait;
use AoScrud\Controllers\Site\Traits\DestroyTrait;
use AoScrud\Controllers\Site\Traits\EditTrait;
use AoScrud\Controllers\Site\Traits\StoreTrait;
use AoScrud\Controllers\Site\Traits\UpdateTrait;

abstract class FullController extends SearchController
{

    use CreateTrait, StoreTrait, EditTrait, UpdateTrait, DeleteTrait, DestroyTrait;

}
