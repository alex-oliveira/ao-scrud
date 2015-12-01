<?php

namespace AoScrud\Services\Resources\Create;

use AoScrud\Tools\Formatters\FormatterAbstract;
use AoScrud\Tools\Validators\ValidatorAbstract;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Create
{

    /**
     * The formatter class to registry in the repository.
     *
     * @var FormatterAbstract
     */
    protected $createFormatter;

    /**
     * The validator class to registry in repository.
     *
     * @var ValidatorAbstract
     */
    protected $createValidator;

    //------------------------------------------------------------------------------------------------------------------
    // MASTERS //-------------------------------------------------------------------------------------------------------
    //------------------------------------------------------------------------------------------------------------------

    /**
     * Main method to registry in the repository.
     *
     * @param array|null $data
     * @return Model
     * @throws Exception
     */
    public function create(array $data = null)
    {
        $data = is_null($data) ? $this->createData() : collect($data);

        $this->createFormatter($data);
        $this->createValidator($data);

        $this->tBegin();
        try {
            $obj = $this->createSave($data);
        } catch (Exception $e) {
            $this->tRollBack();
            throw $e; //new Exception('falha ao tentar cadastrar', 500, $e);
        }
        $this->tCommit();

        return $obj;
    }

    /**
     * Return the data of request to registry.
     *
     * @return Collection
     */
    protected function createData()
    {
        return $this->data();
    }

    /**
     * Run formatter class in data of request.
     *
     * @param Collection $data
     * @return array
     */
    protected function createFormatter($data)
    {
        if (isset($this->createFormatter)) {
            if (is_string($this->createFormatter) && is_subclass_of($this->createFormatter, FormatterAbstract::class)) {
                $this->createFormatter = app($this->createFormatter);
            }
            is_object($this->createFormatter) ? $this->createFormatter->apply($data) : null;
        }
    }

    /**
     * Run validator class in data of request.
     *
     * @param Collection $data
     * @return array
     */
    protected function createValidator($data)
    {
        if (isset($this->createValidator)) {
            if (is_string($this->createValidator) && is_subclass_of($this->createValidator, ValidatorAbstract::class)) {
                $this->createValidator = app($this->createValidator);
            }
            is_object($this->createValidator) ? $this->createValidator->apply($data) : null;
        }
    }

    /**
     * Run create command in the repository.
     *
     * @param Collection $data
     * @return array
     */
    protected function createSave($data)
    {
        return $this->rep->create($data->all());
    }

}