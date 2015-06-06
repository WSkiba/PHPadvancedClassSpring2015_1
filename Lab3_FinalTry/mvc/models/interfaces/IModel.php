<?php
namespace App\models\interfaces;

interface IModel {
    public function reset();
    public function map(array $values);
    public function getAllValues();
}