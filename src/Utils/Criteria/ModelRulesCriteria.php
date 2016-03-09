<?php

namespace AoScrud\Utils\Criteria;

use Illuminate\Database\Query\Builder;
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

        $model = $model->where(function ($query) {
            $this->rules($query, $this->rules);
        });

        //echo $model->toSql(); exit;

        return $model;
    }

    /**
     * @param Builder $query
     * @param array $rules
     * @param string $where
     */
    protected function rules($query, array $rules = [], $where = 'and')
    {
        $config = $this->configs(array_get($rules, 'config'));
        array_forget($rules, 'config');

        foreach ($rules as $field => $rule) {
            if ($config->get('where', $where) == 'and') {
                if (is_string($rule)) {
                    $this->where($query, $field, $rule);
                } else {
                    $query->where(function ($query) use ($rule) {
                        $this->rules($query, $rule, 'or');
                    });
                }
            } else {
                if (is_string($rule)) {
                    $this->orWhere($query, $field, $rule);
                } else {
                    $query->orWhere(function ($query) use ($rule) {
                        $this->rules($query, $rule, 'and');
                    });
                }
            }
        }
    }

    /**
     * @param mixed $rules
     * @return Collection
     */
    protected function configs($rules = null)
    {
        $configs = ['options' => []];

        if (is_string($rules)) {
            foreach (explode('|', $rules) as $v) {
                $c = explode(':', $v);
                count($c) == 2 ? array_set($configs, $c[0], $c[1]) : $configs['options'][] = $c[0];
            }
        }

        return collect($configs);
    }

    /**
     * @param Builder $query
     * @param string $field
     * @param array $rule
     */
    protected function where($query, $field, $rule)
    {
        $configs = $this->configs($rule);

        $value = trim(request()->get($configs->get('get', $field), ''));
        if ($value == '')
            return;

        $condition = $configs->get('options');
        $condition = array_shift($condition);

        if (in_array($condition, ['=', '<', '>', '<>', '<=', '>='])) {
            $query->where($field, $condition, $value);

        } elseif ($condition == '%like%') {
            $query->where($field, 'like', "%{$value}%");

        } elseif ($condition == 'like%') {
            $query->where($field, 'like', "{$value}%");

        } elseif ($condition == '%like') {
            $query->where($field, 'like', "%{$value}");

        } elseif ($condition == 'like') {
            $query->where($field, 'like', "{$value}");

        }
    }

    /**
     * @param Builder $query
     * @param string $field
     * @param array $rule
     */
    protected function orWhere($query, $field, $rule)
    {
        $configs = $this->configs($rule);

        $value = trim(request()->get($configs->get('get', $field), ''));
        if ($value == '')
            return;

        $condition = $configs->get('options');
        $condition = array_shift($condition);

        if (in_array($condition, ['=', '<', '>', '<>', '<=', '>='])) {
            $query->orWhere($field, $condition, $value);

        } elseif ($condition == '%like%') {
            $query->orWhere($field, 'like', "%{$value}%");

        } elseif ($condition == 'like%') {
            $query->orWhere($field, 'like', "{$value}%");

        } elseif ($condition == '%like') {
            $query->orWhere($field, 'like', "%{$value}");

        } elseif ($condition == 'like') {
            $query->orWhere($field, 'like', "{$value}");

        }
    }

}