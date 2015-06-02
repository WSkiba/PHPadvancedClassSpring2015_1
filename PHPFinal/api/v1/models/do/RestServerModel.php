<?php

namespace API\models\services;

class RestServerModel extends BaseModel {
    private $verb;
    private $resource;
    private $id;
    private $requestData;
    private $endpoint;
    
    function setVerb($verb){
        $this->verb = $verb;
    }
    function getVerb(){
        return $this->verb;
    }
    function setResources($resource){
        $this->resource = $resource;
    }
    function getResources(){
        return $this->resource;
    }
    function setId($id){
        $this->id = $id;
    }
    function getId(){
        return $this->id;
    }
    function setRequestData($requestData){
        $this->requestData = $requestData;
    }
    function getRequestData(){
        return $this->requestData;
    }
    function setEndpoint($endpoint){
        $this->endpoint = $endpoint;
    }
    function getEndpoint(){
        return $this->endpoint;
    }
}

