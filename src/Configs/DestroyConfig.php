<?php

namespace AoScrud\Configs;

use AoScrud\Interfaces\IBlock;
use AoScrud\Interfaces\ICascade;
use AoScrud\Interfaces\IDissociate;
use AoScrud\Interfaces\IKeys;
use AoScrud\Interfaces\IObj;
use AoScrud\Interfaces\ISelect;
use AoScrud\Interfaces\ISoft;
use AoScrud\Interfaces\IType;
use AoScrud\Traits\Block;
use AoScrud\Traits\Cascade;
use AoScrud\Traits\Dissociate;
use AoScrud\Traits\Keys;
use AoScrud\Traits\Obj;
use AoScrud\Traits\Select;
use AoScrud\Traits\Soft;
use AoScrud\Traits\Type;

class DestroyConfig extends BaseConfig implements IKeys, ISelect, IObj, IBlock, ICascade, IDissociate, ISoft, IType
{

    use Keys, Select, Obj, Block, Cascade, Dissociate, Soft, Type;

    public function __construct()
    {
        $this->keys(['id']);
    }

}