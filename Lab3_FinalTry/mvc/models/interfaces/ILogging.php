<?php

namespace App\models\interfaces;

interface ILogging {
        
    public function log($data);
    public function logDebug($data);
    public function logException($data);
    public function logError($data);
 
}
