<?php

namespace API\models\services;

class UserModel extends BaseModel {
    
    private $userid;
    private $email;
    private $user;
    private $username;
    private $password;
    private $admin;
    private $active;
    
    function setUserid($userid){
        $this->userid = $userid;
    }
    function getUserid(){
        return $this->userid;
    }
    function setEmail($email){
        $this->email = $email;
    }
    function getEmail(){
        return $this->email;
    }
    function setUser($user){
        $this->user = $user;
    }
    function getUser(){
        return $this->user;
    }
    function setUsername($username){
        $this->username = $username;
    }
    function getUseruser(){
        return $this->username;
    }
    function setPassword($password){
        $this->password = $password;
    }
    function getPassword(){
        return $this->password;
    }
    function setAdmin($admin) {
        $this->admin = $admin;
    }
    function getAdamin() {
        return $this->admin;
    }
    function setActive($active) {
        $this->active = $active;
    }
    function getActive() {
        return $this->active;
    }
}