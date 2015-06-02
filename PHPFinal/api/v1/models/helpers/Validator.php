<?php

namespace API\models\services;

use API\models\interfaces\IService;

class Validator implements IService{
    public function userIsValid($user) {
        return ( is_string($user) && !empty($user) );
    }
}

