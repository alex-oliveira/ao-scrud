<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\UpdateConfig;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Update
{

    /**
     * Configs to update.
     *
     * @var UpdateConfig
     */
    protected $update;

    /**
     * Return the configs to update.
     */
    public function updateConfig()
    {
        return $this->update;
    }

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to update.
     *
     * @param array $data
     * @return bool
     * @throws \Exception
     */
    public function update(array $data)
    {
        $this->update->data($data);

        $this->updatePrepare();

        $t = Transaction()->begin();
        try {
            $result = $this->updateExecute();
        } catch (\Exception $e) {
            Transaction()->rollBack($t);
            throw $e;
        }
        Transaction()->commit($t);

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before update.
     */
    protected function updatePrepare()
    {
        $this->updateSelect();
        $this->updateValidate();
    }

    /**
     * Select the object to update.
     */
    protected function updateSelect()
    {
        $obj = $this->update->select();
        $obj ? $this->update->obj($obj) : abort(404);
    }

    /**
     * Apply validation to update.
     */
    protected function updateValidate()
    {
        Validate()->actor($this)
            ->obj($this->update->obj())
            ->data($this->update->data())
            ->rules($this->update->rules())
            ->run();
    }

    /**
     * Apply filter returning only the allowed fields to update.
     *
     * @return array
     */
    protected function updateFilter()
    {
        return $this->update->data()->only($this->update->columns()->all())->all();
    }

    /**
     * Run update command in the model.
     *
     * @return Model
     */
    protected function updateExecute()
    {
        $obj = $this->update->obj();
        $obj->fill($this->updateFilter());
        return $obj->isDirty() ? $obj->save() : false;
    }

}