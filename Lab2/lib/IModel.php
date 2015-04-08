<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IModel
 *
 * @author 001288282
 */
interface IModel {
    public function reset();
    public function map(array $values);
}
