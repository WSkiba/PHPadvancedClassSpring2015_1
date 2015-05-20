<?php

namespace App\models\interfaces;

interface IDAO {
    public function create(IModel $model);
    public function update(IModel $model);
    public function read($id);
    public function delete($id);
    
}