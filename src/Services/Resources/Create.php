<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\CreateConfig;
use Illuminate\Database\Eloquent\Model;

trait Create
{

    /**
     * Configs to create.
     *
     * @var CreateConfig
     */
    protected $create;

    /**
     * Return the configs to create.
     */
    public function createConfig()
    {
        return $this->create;
    }

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry.
     *
     * @param null|array $data
     * @return CreateConfig|Model
     * @throws \Exception
     */
    public function create(array $data)
    {
        $this->create->data($data);

        $this->createPrepare();

        $t = Transaction()->begin();
        try {
            $this->create->triggerOnExecute();
            $result = $this->createExecute();
            $this->create->triggerOnExecuteEnd($result);
        } catch (\Exception $e) {
            Transaction()->rollBack($t);
            throw $e;
        }
        Transaction()->commit($t);

        $this->create->triggerOnSuccess($result);

        return $result;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before create.
     */
    protected function createPrepare()
    {
        $this->create->triggerOnPrepare();
        try {
            $this->createValidate();
        } catch (\Exception $e) {
            $this->create->triggerOnPrepareError($e);
            throw $e;
        }
        $this->create->triggerOnPrepareEnd();
    }

    /**
     * Apply validation to create.
     */
    protected function createValidate()
    {
        Validate()->actor($this)
            ->data($this->create->data())
            ->rules($this->create->rules())
            ->run();
    }

    /**
     * Apply filter returning only the allowed fields to create.
     *
     * @return array
     */
    protected function createFilter()
    {
        return $this->create->data()->only($this->create->columns()->all())->all();
    }

    /**
     * Run create command in the model.
     *
     * @return Model
     */
    protected function createExecute()
    {
        return $this->create->model()->create($this->createFilter());
    }

}