<?php

namespace AoScrud\Configs;

use AoScrud\Configs\Interfaces\IBlock;
use AoScrud\Configs\Interfaces\ICascade;
use AoScrud\Configs\Interfaces\IDissociate;
use AoScrud\Configs\Interfaces\IKeys;
use AoScrud\Configs\Interfaces\IObj;
use AoScrud\Configs\Interfaces\ISelect;
use AoScrud\Configs\Interfaces\ISoft;
use AoScrud\Configs\Interfaces\IType;
use AoScrud\Configs\Traits\Block;
use AoScrud\Configs\Traits\Cascade;
use AoScrud\Configs\Traits\Dissociate;
use AoScrud\Configs\Traits\Keys;
use AoScrud\Configs\Traits\Obj;
use AoScrud\Configs\Traits\Select;
use AoScrud\Configs\Traits\Soft;
use AoScrud\Configs\Traits\Type;

class DestroyConfig extends BaseConfig implements IKeys, ISelect, IObj, IBlock, ICascade, IDissociate, ISoft, IType
{

    use Keys, Select, Obj, Block, Cascade, Dissociate, Soft, Type;

    public function __construct()
    {
        $this->keys(['id']);
    }

}