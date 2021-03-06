<?php

namespace API\models\services;

include_once './api/v1/models/interfaces/IService.php';
include_once './api/v1/models/helpers/RestProxy.php';

$consumeAPI = new RestProxy();

$key = 'test';
$auth = $key.':';

$method = $consumeAPI->getHTTPVerb();
$data = $consumeAPI->getHTTPData();

// make sure the url is correct.  Your folder name might not be called PHPadvClassSpring2015
$url = $consumeAPI->endpoint('http://localhost:8080/PHPadvancedClassSpring2015/PHPFinal/api/v1');

$consumeAPI->callAPI($method, $url, $data, $auth);

//http://www.restapitutorial.com/
//http://blog.mwaysolutions.com/2014/06/05/10-best-practices-for-better-restful-api/

