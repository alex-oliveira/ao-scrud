<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\DestroyConfig;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

trait Destroy
{

    /**
     * Configs to destroy.
     *
     * @var DestroyConfig
     */
    protected $destroy;

    /**
     * Return the configs to destroy.
     */
    public function destroyConfig()
    {
        return $this->destroy;
    }

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to destroy.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function destroy(array $data)
    {
        $this->destroy->data($data);

        $this->destroyPrepare();

        $t = AoScrud()->transaction()->begin();
        try {
            $this->destroy->triggerOnExecute();
            $result = $this->destroyExecute();
            $this->destroy->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            AoScrud()->transaction()->rollBack($t);
            $this->destroy->triggerOnExecuteError($e);
            throw $e;
        }
        AoScrud()->transaction()->commit($t);

        $this->destroy->triggerOnSuccess($result);

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before destroy.
     */
    protected function destroyPrepare()
    {
        $this->destroy->triggerOnPrepare();
        try {
            $this->destroySelect();
            $this->destroyValidate();
        } catch (\Exception $e) {
            $this->destroy->triggerOnPrepareError($e);
            throw $e;
        }
        $this->destroy->triggerOnPrepareEnd();
    }

    /**
     * Select the object to destroy.
     */
    protected function destroySelect()
    {
        $obj = $this->destroy->select();
        $obj ? $this->destroy->obj($obj) : abort(404);
    }

    /**
     * Validate possible destroy.
     */
    protected function destroyValidate()
    {
        //$this->destroy->type(0); // self::PHYSICAL_EXCLUSION

        $obj = $this->destroy->obj();
        foreach ($this->destroy->block() as $method => $label) {
            $qtd = $obj->{$method}()->count();

            if (is_null($qtd) || $qtd == 0)
                continue;

            //if ($this->destroy->soft()) {
            //    $this->destroy->type(1); // self::LOGICAL_EXCLUSION
            //    break;
            //
            //} else {
                abort(412, 'Há ' . $qtd . ' registro(s) de ' . $label . ' dependendo do registro de ' . $this->destroy->title() . ' #' . $obj->id . '.');
            //}
        }
    }

    /**
     * Run delete command in the model.
     *
     * @return bool|null
     */
    protected function destroyExecute()
    {
        $this->deleteAssociations();
        $this->deleteCascade();

        //if (!$this->destroy->soft())
        //    return $this->destroy->obj()->delete();
        //
        //if ($this->destroy->type() == 0) // ScrudService::PHYSICAL_EXCLUSION
        //    return $this->destroy->obj()->forceDelete();

        return $this->destroy->obj()->delete();
    }

    /**
     * Destroy relationships.
     */
    public function deleteAssociations()
    {
        //if ($this->destroy->soft() && $this->destroy->type() == 1) // ScrudService::LOGICAL_EXCLUSION
        //    return;

        $obj = $this->destroy->obj();
        foreach ($this->destroy->dissociate() as $method) {
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

    /**
     * Destroy registries in "cascade".
     */
    public function deleteCascade()
    {
        //if ($this->destroy->soft() && $this->destroy->type() == 1) // ScrudService::LOGICAL_EXCLUSION
        //    return;

        $obj = $this->destroy->obj();
        foreach ($this->destroy->cascade() as $method) {
            $items = $obj->{$method};
            if (is_null($items) || ($items instanceof Collection && $items->isEmpty()))
                continue;

            $obj->{$method}()->delete();
        }
    }

}