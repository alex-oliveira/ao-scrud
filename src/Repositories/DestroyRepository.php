<?php

namespace AoScrud\Repositories;

use AoScrud\Interfaces\Repositories\DestroyRepositoryInterface;
use AoScrud\Utils\Traits\Block;
use AoScrud\Utils\Traits\Cascade;
use AoScrud\Utils\Traits\Data;
use AoScrud\Utils\Traits\Dissociate;
use AoScrud\Utils\Traits\Keys;
use AoScrud\Utils\Traits\Obj;
use AoScrud\Utils\Traits\OnError;
use AoScrud\Utils\Traits\OnExecute;
use AoScrud\Utils\Traits\OnExecuteEnd;
use AoScrud\Utils\Traits\OnExecuteError;
use AoScrud\Utils\Traits\OnPrepare;
use AoScrud\Utils\Traits\OnPrepareEnd;
use AoScrud\Utils\Traits\OnPrepareError;
use AoScrud\Utils\Traits\OnSuccess;
use AoScrud\Utils\Traits\Select;
use AoScrud\Utils\Traits\Soft;
use AoScrud\Utils\Traits\Title;
use AoScrud\Utils\Traits\Type;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        $this->deleteAssociations();
        $this->deleteCascade();

        if (!$this->soft())
            return $this->obj()->delete();

        if ($this->type() == self::PHYSICAL_EXCLUSION)
            return $this->obj()->forceDelete();

        return $this->obj()->delete();
    }

    public function deleteAssociations()
    {
        if ($this->soft() && $this->type() == self::LOGICAL_EXCLUSION)
            return;

        $obj = $this->obj();
        foreach ($this->dissociate() as $method) {
            $items = $obj->{$method}();

            if ($items instanceof BelongsToMany) {
                $items->sync([]);
            } elseif ($items instanceof BelongsTo) {
                $items->dissociate();
            } else {
                dd('DISSOCIATE TYPE NOT IMPLEMENTED');
            }
        }
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