<?php

namespace AoScrud\Utils\Criteria;

use LucaDegasperi\OAuth2Server\Facades\Authorizer;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Contracts\CriteriaInterface;

class AuthorizerCriteria implements CriteriaInterface
{

    public function apply($model, RepositoryInterface $repository)
    {
        return $model->where('user_id', '=', Authorizer::getResourceOwnerId());
    }

}