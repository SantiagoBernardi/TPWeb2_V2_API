<?php

include_once 'app\models\apimodel.php';
include_once 'app\views\apiview.php';
require_once 'app\helpers\api-helper.php';

    class ApiController {

        private $model;
        private $view;
        private $data;
        private $authHelper;

        function __construct() {
            $this->model = new ApiModel();
            $this->view = new ApiView();
            $this->authHelper = new AuthApiHelper();
            $this->data = file_get_contents("php://input");
        }

        private function getData() {
            return json_decode($this->data);
        }   
        

        public function getAnuros($params = null) {
            $params = [
                "sort" => "asc",
                "field" => "id",
                "where" => "anuros.id_ecosistema_fk",
                "limit" => "18446744073709551610",
                "offset" => "0"
            ];
            if (isset($_GET['sort'])){ 
                $params["sort"] = $_GET['sort'];
            }
            if (isset($_GET['field'])){
                $params["field"] = $_GET['field'];
            }
            if (isset($_GET['where'])){
                $params["where"] = $_GET['where'];
            }
            if (isset($_GET['limit'])){
                $params["limit"] = $_GET['limit'];
                if (isset($_GET['offset'])){
                    $params["offset"] = ($_GET['offset']-1)*$params["limit"];
                }
            }

            $bd = $this->model->getAnuros($params);
            $this->view->response($bd);
            
        }

        function getAnuroById($params = null ){
            $id = $params[':ID'];
            $bd = $this->model->getAnuroById($id);
            if ($bd)
                $this->view->response($bd);
            else 
                $this->view->response("El anuro con el id=$id no existe", 404);
        }

        function setAnuro($params = null) {
            if(!$this->authHelper->isLoggedIn()){
                $this->view->response("No estas logeado", 401);
                return;
            }
            $bd = $this->getData();
            if (empty($bd->foto)  || empty($bd->especie)  || empty($bd->familia)  || empty($bd->conservacion)  || empty($bd->id_ecosistema_fk)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $id = $this->model->setAnuro($bd->foto, $bd->especie, $bd->familia, $bd->conservacion, $bd->id_ecosistema_fk);
                $bd = $this->model->getAnuroById($id);
                $this->view->response($bd, 201);
            }
    }
}