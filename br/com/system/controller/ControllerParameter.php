<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once server_path("br/com/system/dao/DAOParameter.php");
include_once server_path("br/com/system/model/ModelParameter.php");

class ControllerParameter {

    private $info;
    private $daoParameter;

    function __construct() {
        $this->info = 'default=default';
        $this->daoParameter = new DAOParameter();
    }

    public function delete() {
        if (GenericController::authotity()) {
            $para_pk_id = strip_tags($_GET['para_pk_id']);
            if (!isset($para_pk_id)) {
                $this->info = 'warning=parameter_uninformed';
            }
            try {
                $daoUser = new DAOUser();
                if (empty($daoUser->selectCountObjectsByFKParameter($para_pk_id))) {
                    if (!$this->daoParameter->delete($para_pk_id)) {
                        $this->info = 'warning=parameter_not_exists';
                        $this->list();
                    }
                    $this->info = "success=parameter_deleted";
                } else {
                    $this->info = "warning=parameter_in_use";
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function disable() {
        if (GenericController::authotity()) {
            $para_pk_id = strip_tags($_GET['para_pk_id']);
            if (isset($para_pk_id)) {
                $para_status = false;
                try {
                    if (($this->daoParameter->selectObjectById($para_pk_id)) === null) {
                        $this->info = 'warning=parameter_not_exists';
                    } else {
                        $parameter = new ModelParameter();
                        $parameter->para_pk_id = $para_pk_id;
                        $parameter->para_status = $para_status;

                        $this->daoParameter->updateStatus($parameter);
                        $this->info = 'success=parameter_disabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=parameter_uninformed';
            }
            $this->list();
        }
    }

    public function edit() {
        if (GenericController::authotity()) {
            $para_pk_id = $_GET['para_pk_id'];
            if (!isset($para_pk_id)) {
                $this->info = 'warning=parameter_uninformed';
                $this->list();
            }
            try {
                $parameter = $this->daoParameter->selectObjectById($para_pk_id);
                if (!isset($parameter)) {
                    $this->info = 'warning=parameter_not_exists';
                    $this->list();
                }
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            if ($parameter == false) {
                $this->info = "warning=aauthority_not_found";
            }
            include_once server_path('br/com/system/view/parameter/edit.php');
        }
    }

    public function enable() {
        if (GenericController::authotity()) {
            $para_pk_id = strip_tags($_GET['para_pk_id']);
            if (isset($para_pk_id)) {
                $para_status = true;
                try {
                    if (($this->daoParameter->selectObjectById($para_pk_id)) === null) {
                        $this->info = 'warning=parameter_not_exists';
                    } else {
                        $parameter = new ModelParameter();
                        $parameter->para_pk_id = $para_pk_id;
                        $parameter->para_status = $para_status;

                        $this->daoParameter->updateStatus($parameter);
                        $this->info = 'success=parameter_enabled';
                    }
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
            } else {
                $this->info = 'warning=parameter_uninformed';
            }
            $this->list();
        }
    }

    public function list() {
        if (GenericController::authotity()) {
            if (isset($_POST['para_key']) && isset($_POST['para_value'])) {
                $para_key = strip_tags($_POST['para_key']);
                try {
                    $parameter = new ModelParameter();
                    $parameter->para_key = strip_tags($_POST['para_key']);
                    $parameter->para_key = strip_tags($_POST['para_value']);
                    $parameters = $this->daoParameter->selectObjectsByContainsObject($parameter);
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                if (isset($this->info)) {
                    GenericController::valid_messages($this->info);
                }
            }
            include_once server_path('br/com/system/view/parameter/list.php');
        }
    }

    public function new() {
        if (GenericController::authotity()) {
            include_once server_path('br/com/system/view/parameter/new.php');
        }
    }

    public function save() {
        if (GenericController::authotity()) {
            $para_key = strip_tags($_POST['para_key']);
            $para_value = strip_tags($_POST['para_value']);
            $para_description = strip_tags($_POST['para_description']);
            $para_status = false;
            global $user_logged;
            $para_fk_user_pk_id = $user_logged->user_pk_id;
            $parameter = new ModelParameter();
            $parameter->para_key = $para_key;
            $parameter->para_status = $para_status;
            $parameter->para_value = $para_value;
            $parameter->para_description = $para_description;
            $parameter->para_fk_user_pk_id = $para_fk_user_pk_id;
            
            try {
                $this->daoParameter->save($parameter);
                $this->info = "success=parameter_created";
            } catch (Exception $erro) {
                $this->info = "error=" . $erro->getMessage();
            }
            $this->list();
        }
    }

    public function update() {
        if (GenericController::authotity()) {
            if (GenericController::authotity()) {
                $para_pk_id = strip_tags($_POST['para_pk_id']);
                if (!isset($para_pk_id)) {
                    $this->info = 'warning=parameter_uninformed';
                }
                $para_key = strip_tags($_POST['para_key']);
                $para_value = strip_tags($_POST['para_value']);
                $para_description = strip_tags($_POST['para_description']);

                $parameter = new ModelParameter();
                $parameter->para_pk_id = $para_pk_id;
                $parameter->para_key = $para_key;
                $parameter->para_value = $para_value;
                $parameter->para_description = $para_description;

                try {
                    $this->daoParameter->update($parameter);
                    if ($parameter == null) {
                        $this->info = 'warning=parameter_not_exists';
                        $this->list();
                    }
                    $this->info = 'success=parameter_updated';
                } catch (Exception $erro) {
                    $this->info = "error=" . $erro->getMessage();
                }
                $this->list();
            }
        }
    }

}
