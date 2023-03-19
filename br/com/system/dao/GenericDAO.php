<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class GenericDAO {

    private $instance;
    private $comp;
    private $user;
    private $pass;
    private $query;
    private $statement;
    private $host;

    function __construct() {
        $this->comp = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $this->host = "db_system";
        $this->port = 3306;
        $this->user = "root";
        $this->pass = "12345678";
        $this->dbname = "system";
    }

    public function getInstance() {
        if (!isset($this->instance)) {
            try {
                $this->instance = new PDO('mysql:host=' . $this->host . ';port=' . $this->port .';dbname=' . $this->dbname . ';', $this->user, $this->pass, $this->comp);
                $this->instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            } catch (Exception $erro) {
                throw new Exception($erro->getMessage());
            }
        }
        return $this->instance;
    }

}
