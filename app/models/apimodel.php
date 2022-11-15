<?php

    class ApiModel {

        private function connect() {
            $db = new PDO('mysql:host=localhost;'.'dbname=bd_anuros;charset=utf8', 'root', '');
            return $db; 
        }

        function getAnuros($params) {
            $db = $this->connect();
            $query = $db->prepare(" SELECT * 
                                    FROM anuros 
                                    INNER JOIN ecosistemas
                                    ON anuros.id_ecosistema_fk = ecosistemas.id_e 
                                    WHERE anuros.id_ecosistema_fk = $params[where]
                                    ORDER BY $params[field] $params[sort]
                                    LIMIT $params[limit]
                                    OFFSET $params[offset]");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_OBJ);
        }

        function getAnuroById($id){
            $db = $this->connect();
            $query = $db->prepare(' SELECT * 
                                    FROM anuros 
                                    INNER JOIN ecosistemas 
                                    on anuros.id_ecosistema_fk = ecosistemas.id_e 
                                    WHERE anuros.id = ?');
            $query->execute([$id]);
            return  $query->fetchAll(PDO::FETCH_OBJ);
        }

        function setAnuro($foto,$especie,$familia,$conservacion,$ecosistema){
            $db = $this->connect();
            $query = $db->prepare(" INSERT INTO anuros (foto,especie,familia,conservacion,id_ecosistema_fk) 
                                    VALUES (?, ?, ?, ?, ?)");
            $query->execute([$foto,$especie,$familia,$conservacion,$ecosistema]);
            return $db->lastInsertId();
        }
    }