<?php

namespace AoScrud\Tools\Criteria;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ModelRulesCriteria implements CriteriaInterface
{

    /**
     * @var array;
     */
    protected $rules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules = [])
    {
        $this->rules = $rules;
    }

    public function apply($model, RepositoryInterface $repository)
    {
        if (empty($this->rules)) {
            return $model;
        }

        $search = request()->get('search', null);

        $v1 = $v2 = [];
        foreach ($this->rules as $field => $condition) {
            $value = trim(strtolower(request()->get($field, '')));
            if ($condition == 'like' && $search) {
                $v2[$field] = "%{$search}%";
            } elseif (strlen($value) > 0) {
                $v1[$field] = $value;
            }
        }
        $values = array_merge($v1, $v2);

        $model = $model->where(function ($query) use ($values) {
            $first = true;
            foreach ($values as $field => $value) {
                if ($first) {
                    $query->where($field, $this->rules[$field], $value);
                } else {
                    $query->orWhere($field, $this->rules[$field], $value);
                }
                $first = false;
            }
        });

        return $model;
    }

}