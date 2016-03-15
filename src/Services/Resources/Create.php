<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\BaseInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Create
{

    /**
     * The interceptor class to registry in the repository.
     *
     * @var BaseInterceptor[]
     */
    protected $createInterceptors = [];

    /**
     * The allow fields to create.
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

        $this->tBegin();
        try {
            $obj = $this->createExecute($data);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

        // DISPATCH EVENT

        return $obj;
    }

    //------------------------------------------------------------------------------------------------------------------
    // AUXILIARY METHODS
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Run all preparations before create.
     *
     * @param Collection $data
     */
    protected function createPrepare(Collection $data)
    {
        $this->createInterceptors($data);
    }

    /**
     * Apply interceptors to create.
     *
     * @param Collection $data
     */
    protected function createInterceptors(Collection $data)
    {
        foreach ($this->createInterceptors as $key => $interceptor) {
            if (is_string($interceptor) && is_subclass_of($interceptor, BaseInterceptor::class))
                $this->createInterceptors[$key] = $interceptor = app($interceptor);

            if (is_object($interceptor) && $interceptor instanceof BaseInterceptor)
                $interceptor->apply($this, $data);
        }
    }

    /**
     * Apply validation to create.
     *
     * @param Collection $data
     * @return array
     */
    protected function createValidate(Collection $data)
    {
        validate($data->all(), $this->createRules($data));
    }

    /**
     * Return the validation rules to create.
     *
     * @param Collection $data
     * @return array
     */
    protected function createRules(Collection $data)
    {
        return [];
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
     * Run create command in the repository.
     *
     * @param Collection $data
     * @return Model
     */
    protected function createExecute(Collection $data)
    {
        return $this->model()->create($data->only($this->createFillable())->all());
    }

}