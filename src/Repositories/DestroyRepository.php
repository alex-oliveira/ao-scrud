<?php

namespace AoScrud\Repositories;

use AoScrud\Repositories\Interfaces\Repositories\DestroyRepositoryInterface;
use AoScrud\Repositories\Traits\Block;
use AoScrud\Repositories\Traits\Cascade;
use AoScrud\Repositories\Traits\Data;
use AoScrud\Repositories\Traits\Dissociate;
use AoScrud\Repositories\Traits\Keys;
use AoScrud\Repositories\Traits\Obj;
use AoScrud\Repositories\Traits\OnError;
use AoScrud\Repositories\Traits\OnExecute;
use AoScrud\Repositories\Traits\OnExecuteEnd;
use AoScrud\Repositories\Traits\OnExecuteError;
use AoScrud\Repositories\Traits\OnPrepare;
use AoScrud\Repositories\Traits\OnPrepareEnd;
use AoScrud\Repositories\Traits\OnPrepareError;
use AoScrud\Repositories\Traits\OnSuccess;
use AoScrud\Repositories\Traits\Select;
use AoScrud\Repositories\Traits\Soft;
use AoScrud\Repositories\Traits\Title;
use AoScrud\Repositories\Traits\Type;
use Illuminate\Database\Eloquent\Collection;

class DestroyRepository extends BaseRepository implements DestroyRepositoryInterface
{

    use Data, Keys, Title, Select, Obj, Block, Cascade, Dissociate, Soft, Type, OnPrepare, OnPrepareEnd, OnPrepareError, OnExecute, OnExecuteEnd, OnExecuteError, OnSuccess, OnError;

    CONST PHYSICAL_EXCLUSION = 0;
    CONST LOGICAL_EXCLUSION = 1;

    /**
     * @return mixed
     * @throws \Exception
     */
    public function run()
    {
        $this->prepare();

        $t = Transaction()->begin();
        try {
            $this->triggerOnExecute();
            $result = $this->execute();
            $this->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            Transaction()->rollBack($t);
            $this->triggerOnExecuteError($e);
            throw $e;
        }
        Transaction()->commit($t);

        $this->triggerOnSuccess($result);

        return $result;
    }

    public function prepare()
    {
        $this->triggerOnPrepare();
        try {
            $this->read();
            $this->validate();
        } catch (\Exception $e) {
            $this->triggerOnPrepareError($e);
            throw $e;
        }
        $this->triggerOnPrepareEnd();
    }

    public function read()
    {
        $obj = $this->select();
        $obj ? $this->obj($obj) : abort(404);
    }

    public function validate()
    {
        $this->type(self::PHYSICAL_EXCLUSION);

        $obj = $this->obj();
        foreach ($this->block() as $method => $label) {
            $items = $obj->{$method};
            if (is_null($items) || ($items instanceof Collection && $items->isEmpty()))
                continue;

            if ($this->soft()) {
                $this->type(self::LOGICAL_EXCLUSION);
                break;

            } else {
                $message = 'do registro de ' . $this->title() . ' #' . $obj->id . '.';
                if ($items instanceof Collection) {
                    $message = 'Há ' . $items->count() . ' registro(s) de ' . $label . ' dependendo ' . $message;
                } else {
                    $message = 'O registro de ' . $label . ' #' . $items->id . ' depende ' . $message;
                }
                abort(412, $message);
            }
        }
    }

    public function execute()
    {
        $this->deleteCascade();

        if (!$this->soft())
            return $this->obj()->delete();

        if ($this->type() == self::PHYSICAL_EXCLUSION)
            return $this->obj()->forceDelete();

        return $this->obj()->delete();
    }

    public function deleteCascade()
    {
        if ($this->soft() && $this->type() == self::LOGICAL_EXCLUSION)
            return;

        $obj = $this->obj();
        foreach ($this->cascade() as $method) {
            $items = $obj->{$method};
            if (is_null($items) || ($items instanceof Collection && $items->isEmpty()))
                continue;

            $obj->{$method}()->delete();
        }
    }

}