<?php

namespace API\models\services;
use API\models\interfaces\IModel;
use API\models\interfaces\ILogging;
use \PDO;

abstract class BaseDAO {
        
        protected $DB = null;
        protected $model;
        protected $log = null;
        
        protected function setDB (PDO $DB) {
            $this->DB = $DB;
        }
        protected function getDB() {
            return $this->DB;
        }
        protected function setModel(IModel $model) {
            $this->model = $model;
        }
        protected function getModel() {
            return $this->model;
        }
        protected function setLog(ILogging $log) {
            if ($log instanceof ILogging) {
                $this->log = $log;
            }
        }
        protected function getLog() {
        return $this->log;
        }
}