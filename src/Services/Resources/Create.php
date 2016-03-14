<?php

namespace AoScrud\Services\Resources;

use AoScrud\Utils\Interceptors\SaveInterceptor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Create
{

    /**
     * The allow fields to create.
     *
     * @var array
     */
    protected $createFillable = [];

    /**
     * The interceptor class to registry in the repository.
     *
     * @var SaveInterceptor[]
     */
    protected $createInterceptors = [];

    //------------------------------------------------------------------------------------------------------------------
    // MAIN METHOD
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param Collection $data
     * @return Model
     * @throws \Exception
     */
    public function create(Collection $data)
    {
        $this->createPrepare($data);

        $this->tBegin();
        try {
            $obj = $this->createExecute($data);
        } catch (\Exception $e) {
            $this->tRollBack();
            throw $e;
        }
        $this->tCommit();

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
        foreach ($this->createInterceptors as $key => $interceptor) {
            if (is_string($interceptor) && is_subclass_of($interceptor, SaveInterceptor::class))
                $this->createInterceptors[$key] = $interceptor = app($interceptor);

            if (is_object($interceptor) && $interceptor instanceof SaveInterceptor)
                $interceptor->apply($data);
        }
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
        return $this->rep->create($data->only($this->createFillable())->all());
    }

}