<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\BaseInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Create
{

    /**
     * The validation rules to create or an interceptor class that return an array.
     *
     * @var array|BaseInterceptor
     */
    protected $createRules = [];

    /**
     * The allowed fields to create.
     *
     * @var array
     */
    protected $createFillable = [];

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
        $data = collect($data);
        $this->createPrepare($data);

        $t = Transaction()->begin();
        try {
            $obj = $this->createRun($data);
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
     *
     * @param Collection $data
     */
    protected function createPrepare(Collection $data)
    {
        $this->createValidate($data);
        $this->createFilter($data);
    }

    /**
     * Define the rule fields to create.
     *
     * @return array
     */
    protected function createRules()
    {
        return $this->createRules;
    }

    /**
     * Apply validation to create.
     *
     * @param Collection $data
     */
    protected function createValidate(Collection $data)
    {
        Validate()->actor($this)->data($data)->rules($this->createRules())->run();
    }

    /**
     * Define the allow fields to create.
     *
     * @return array
     */
    protected function createFillable()
    {
        return $this->createFillable;
    }

    /**
     * Apply filter returning only the allowed fields to create.
     *
     * @param Collection $data
     */
    protected function createFilter(Collection $data)
    {
        $data = $data->only($this->createFillable());
    }

    /**
     * Return the model to create.
     *
     * @return mixed
     */
    protected function createModel()
    {
        return $this->model();
    }

    /**
     * Run create command in the service.
     *
     * @param Collection $data
     * @return Model
     */
    protected function createRun(Collection $data)
    {
        return $this->createModel()->create($data->all());
    }

}