<?php

namespace AoScrud\Services\Configurators;

use AoScrud\Services\Configs\Interfaces\IBlock;
use AoScrud\Services\Configs\Interfaces\ICascade;
use AoScrud\Services\Configs\Interfaces\IDissociate;
use AoScrud\Services\Configs\Interfaces\IKeys;
use AoScrud\Services\Configs\Interfaces\IObj;
use AoScrud\Services\Configs\Interfaces\ISelect;
use AoScrud\Services\Configs\Interfaces\ISoft;
use AoScrud\Services\Configs\Interfaces\IType;
use AoScrud\Services\Configs\Block;
use AoScrud\Services\Configs\Cascade;
use AoScrud\Services\Configs\Dissociate;
use AoScrud\Services\Configs\Keys;
use AoScrud\Services\Configs\Obj;
use AoScrud\Services\Configs\Select;
use AoScrud\Services\Configs\Soft;
use AoScrud\Services\Configs\Type;

class DestroyConfigurator extends BaseConfigurator implements
    IKeys, ISelect, IObj, IBlock, ICascade, IDissociate, ISoft, IType
{

    use Keys, Select, Obj, Block, Cascade, Dissociate, Soft, Type;

    public function __construct()
    {
        $this->keys(['id']);
    }

}