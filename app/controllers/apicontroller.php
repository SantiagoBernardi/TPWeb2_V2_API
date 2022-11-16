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

        private function verifyParams($params) {
            $columns = [
                "id",
                "foto", 
                "especie", 
                "familia", 
                "conservacion", 
                "id_ecosistema_fk",
            ];
            if ($params["field"] != null && !in_array(strtolower($params["field"]), $columns)) {
                $this->view->response("La columna ingresada '$params[field]' es incorrecta. Por favor reintente ingresando '$columns[0]', '$columns[1]', '$columns[2]', '$columns[3]', o '$columns[4]'", 400);
                die;
            }
            if ($params["sort"] != null && $params["sort"] != "asc" && $params["sort"] != "desc") {
                $this->view->response("El parametro de orden '$params[sort]' no existe. Ingrese 'asc' o 'desc'", 400);
                die;
            }
            if ($params["where"] != null && $params["where"] != 1 && $params["where"] != 2 && $params["where"] != 3 && $params["where"] != 4 && $params["where"] != 5 && $params["where"] != "anuros.id_ecosistema_fk") {
                $this->view->response("El parametro de filtro '$params[where]' no existe. Ingrese un ecosistema valido entre 1 y 5", 400);
                die;
            }
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
            $this->verifyParams($params);
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