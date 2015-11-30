<?php

/*******************************************************************************
* Classe Connector                                                             *
* Auteur : Brendan Abolivier                                                   *
* Fonction : Permettre une gestion plus facile et plus claire de la connexion  *
*            au serveur MySQL                                                  *
*                                                                              *
*    Attribut :                                                                *
*        $bdd : objet PDO                                                      *
*                                                                              *
* Méthodes :                                                                   *
*        __construct()                                                         *
*        Select()                                                              *
*        Insert()                                                              *
*        Update()                                                              *
*******************************************************************************/

include(__DIR__."/../../DbIds.php");

class Connector {

    private $bdd;

    function __construct() {
        $dbconnect = getParams();

        $options = array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        );

        $this->bdd = new PDO("mysql:host=".$dbconnect[0].";dbname=".$dbconnect[1],
            $dbconnect[2], $dbconnect[3], $options);

        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    function Select($fields, $tables, $options = array()) {
        $request = "SELECT $fields FROM $tables ";
        $arrayVerif = array();
        foreach($options as $name=>$value) {
            if(($upName = strtoupper($name)) == "WHERE") {
                $whereClause = " $upName ";
                foreach($value as $array) {
                    if(sizeof($array) != 3 && sizeof($array) != 4) {
                        throw new Exception("wrong_arg_nmbr_where");
                    }
                    if(sizeof($array) == 3) {
                        $whereClause .= $array[0]." ".$array[1]." ? AND ";
                        array_push($arrayVerif, $array[2]);
                    } else {
                        $whereClause .= $array[0]." ".$array[1]." ".$array[2]
                                        ." AND ";
                    }
                }
                $request .= substr($whereClause, 0, -5);
            } else if(($upName = strtoupper($name)) == "ORDER BY") {
                if(sizeof($value) != 2 && substr($value[0], -2) != "()") {
                    throw new Exception("wrong_arg_nmbr_order_by");
                }

                $request .= " ".$upName." ".implode(" ", $value);
            } else if(($upName = strtoupper($name)) == "LIMIT") {
                if(sizeof($value) == 1) {
                    // La colonne "limit" ne contient qu'un nombre de champs
                    $request .= " $upName ".$value[0];
                } else if(sizeof($value) == 2) {
                    // La colonne "limit" contient un index de départ et un
                    // nombre de champs
                    $request .= " $upName ".$value[0].",".$value[1];
                } else {
                    throw new Exception("wrong_arg_numbr_limit");
                }
            } else {
                throw new Exception("unknown_arg");
            }
        }

        $stmt = $this->bdd->prepare($request);

        if($stmt->execute($arrayVerif)) {
            return $stmt->fetchAll();
        } else {
            return null;
        }
    }

    function Insert($table, $values) {
        $request = "INSERT INTO $table(";
        $valeurs = "VALUES(";
        $arrayVerif = array();
        foreach($values as $name=>$value) {
            $request .= $name.",";
            $valeurs .= "?,";
            array_push($arrayVerif, $value);
        }

        $request = substr($request, 0, -1).") ".substr($valeurs, 0, -1).")";

        $stmt = $this->bdd->prepare($request);

        $stmt->execute($arrayVerif);
    }

    function Update($table, $update) {
        $request = "UPDATE $table SET ";
        $arrayVerif = array();
        foreach($update["set"] as $name=>$value) {
            $request .= $name."=?,";
            array_push($arrayVerif, $value);
        }
        $request = substr($request, 0, -1)." WHERE ";
        foreach($update["where"] as $value) {
            $request .= $value[0].$value[1]."? AND ";
            array_push($arrayVerif, $value[2]);
        }
        $request = substr($request, 0, -5);

        $stmt = $this->bdd->prepare($request);
        $stmt->execute($arrayVerif);
    }

    function Delete($table, $where = array()) {
        $request = "DELETE FROM $table";
        $arrayVerif = array();
        $request .= " WHERE ";
        foreach($where as $value) {
            $request .= $value[0].$value[1]."? AND ";
            array_push($arrayVerif, $value[2]);
        }
        $request = substr($request, 0, -5);

        $stmt = $this->bdd->prepare($request);
        $stmt->execute($arrayVerif);
    }

    function beginTransaction() {
        $this->bdd->beginTransaction();
    }

    function commit() {
        $this->bdd->commit();
    }
}
