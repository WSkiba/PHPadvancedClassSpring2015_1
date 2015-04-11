<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IDAO
 *
 * @author 001288282
 */
interface IDAO {
    public function idExisit($id);
    public function getById($id);
    public function delete($id); 
    public function save(IModel $model);
    
}
