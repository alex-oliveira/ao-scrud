<?php

namespace AoScrud\Services\Resources;

use AoScrud\Services\Configs\CreateConfig;
use Illuminate\Database\Eloquent\Model;

trait Create
{

    /**
     * @var CreateConfig
     */
    protected $create;

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param array $data
     * @return Model
     * @throws \Exception
     */
    public function create(array $data)
    {
        $this->create->data($data);

        $this->createPrepare();

        $t = Transaction()->begin();
        try {
            $obj = $this->createExecute();
        } catch (\Exception $e) {
            Transaction()->rollBack($t);
            throw $e;
        }
        Transaction()->commit($t);

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Rum the preparations to create.
     */
    protected function createPrepare()
    {
        $this->createValidate();
    }

    /**
     * Apply validation to create.
     */
    protected function createValidate()
    {
        Validate()->actor($this)->data($this->create->data())->rules($this->create->rules())->run();
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
     * Run create command in the service.
     *
     * @return Model
     */
    protected function createExecute()
    {
        return $this->create->model()->create($this->createFilter());
    }

}