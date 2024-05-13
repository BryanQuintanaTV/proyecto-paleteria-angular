<?php

require_once "connection.php";

class GetModel{

    /* *****************************************
    Peticion GET sin FILTRO
    ********************************************/    
    static public function getData($table, $columnas, $orderBy, $orderMode, 
         $startAt, $endAt){

        $ordenar = "";
        if($orderBy != null && $orderMode != null){
            $ordenar  = " ORDER BY $orderBy $orderMode";
        }
        
        $limitar = "";
        if($startAt != null && $endAt != null){
            $limitar = " LIMIT $startAt, $endAt ";
        }

        $sql  = "SELECT $columnas FROM $table $ordenar  $limitar";

        $conection = Connection::connect();//->prepare();
        $stmt = $conection->prepare($sql); 
        $stmt -> execute();
        //FETCH_CLASS Sirve para que me regrese el indice con el nombre de las columnas
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    /* *****************************************
    Peticion GET con FILTRO
    ********************************************/
    static public function getDataFilter($table, $columnas, $linkTo, $equalTo, 
        $orderBy, $orderMode, $startAt, $endAt){

        $linkToArray = explode(",", $linkTo);
        $equalToArray = explode("_", $equalTo);
        
        //Verificar que sean del mismo tamaño
        if(count($linkToArray) == count($equalToArray)){
            $condicion = "";
            $vueltas = count($linkToArray)-1;

            for($i=0; $i <= $vueltas; $i++){
                $condicion = $condicion . " " . $linkToArray[$i] . " = ?";
                if($i != $vueltas){
                    $condicion .= " AND ";
                }
            }
        } 
        
        $ordenar = "";
        if($orderBy != null && $orderMode != null){
            $ordenar  = " ORDER BY $orderBy $orderMode";
        }
        
        $limitar = "";
        if($startAt != null && $endAt != null){
            $limitar = " LIMIT $startAt, $endAt ";
        }
        

        $sql  = "SELECT $columnas FROM $table WHERE $condicion $ordenar  $limitar";

        $conection = Connection::connect();
        $stmt = $conection->prepare($sql); 
        
        for($i=0; $i< count($equalToArray); $i++){
            $stmt->bindParam($i+1, $equalToArray[$i], PDO::PARAM_STR);
        }
 
        $stmt -> execute();
        //FETCH_CLASS Sirve para que me regrese el indice con el nombre de las columnas
        return $stmt->fetchAll(PDO::FETCH_CLASS);
        
    }

    /* *****************************************
    Peticion GET Con RELACIONES sin FILTRO
    ********************************************/    
    static public function getRelationData($relTablas, $relCampos, $columnas, $orderBy, $orderMode, 
         $startAt, $endAt){

        $ordenar = "";
        if($orderBy != null && $orderMode != null){
            $ordenar  = " ORDER BY $orderBy $orderMode";
        }
        
        $limitar = "";
        if($startAt != null && $endAt != null){
            $limitar = " LIMIT $startAt, $endAt ";
        }

        $tablas = explode(",", $relTablas);
        $campos = explode(",", $relCampos);

        /*
            SELECT * 
            FROM countries 
            INNER JOIN codes      ON countries.id_code_country = codes.id_code
            INNER JOIN dialcodes  ON countries.id_dialcode_contry = dialcodes.id_dialcode
        */

        $sql = "SELECT $columnas FROM $tablas[0]";
        for($i = 1; $i < count($tablas); $i++){
            $innerJOIN = " INNER JOIN $tablas[$i] ON $tablas[0].id_$campos[0] = $tablas[$i].id_$campos[$i] "; 
            $sql .= $innerJOIN;
        }

        $sql .= $ordenar . $limitar;

        //return;
        $conection = Connection::connect();//->prepare();
        $stmt = $conection->prepare($sql); 
        $stmt -> execute();
        //FETCH_CLASS Sirve para que me regrese el indice con el nombre de las columnas
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }


    /* *****************************************
    Peticion GET Con RELACIONES CON FILTRO
    ********************************************/    
    static public function getRelationDataFilter($relTablas, $relCampos, $columnas, $linkTo, $equalTo, 
                      $orderBy, $orderMode, $startAt, $endAt){

        $linkToArray = explode(",", $linkTo);
        $equalToArray = explode("_", $equalTo);
        
        
        //Verificar que sean del mismo tamaño
        $condicion = " ";
        if(count($linkToArray) == count($equalToArray)){
            $condicion = " WHERE ";
            $vueltas = count($linkToArray)-1;
            for($i=0; $i <= $vueltas; $i++){
                $condicion = $condicion . " " . $linkToArray[$i] . " = ?";
                if($i != $vueltas){
                    $condicion .= " AND ";
                }
            }
        } 

        $ordenar = "";
        if($orderBy != null && $orderMode != null){
            $ordenar  = " ORDER BY $orderBy $orderMode";
        }
        
        $limitar = "";
        if($startAt != null && $endAt != null){
            $limitar = " LIMIT $startAt, $endAt ";
        }

        $tablas = explode(",", $relTablas);
        $campos = explode(",", $relCampos);

        $sql = "SELECT $columnas FROM $tablas[0]";
        for($i = 1; $i < count($tablas); $i++){
            $innerJOIN = " INNER JOIN $tablas[$i] ON $tablas[0].id_$campos[0] = $tablas[$i].id_$campos[$i] "; 
            $sql .= $innerJOIN;
        }

        $sql .= $condicion . $ordenar . $limitar;

        echo $sql;
        //return;
        $conection = Connection::connect();//->prepare();
        $stmt = $conection->prepare($sql); 

        for($i=0; $i< count($equalToArray); $i++){
            $stmt->bindParam($i+1, $equalToArray[$i], PDO::PARAM_STR);
        }

        $stmt -> execute();
        //FETCH_CLASS Sirve para que me regrese el indice con el nombre de las columnas
        return $stmt->fetchAll(PDO::FETCH_CLASS);
    }


}