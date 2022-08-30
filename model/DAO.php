<?php

namespace Model;


// !DAO (data access object) -> Allows us to have access to the data which are stocked in DB
class DAO{
    private $bdd;

    public function __construct(){
        // !PDO class -> Represents a connection between PHP and a database server.
        /*
        Example:
        *$host = 'localhost';
        *$dbName = 'Cinema';
        *$user = 'root';
        *$password = 'root';

        !DSN (Data Source Name) -> A string that has the Associated data structure to describe a connection to DB
        *$dsn = 'mysql:host='.$host.';dbname='.$dbname;

        Create pdo instance:
        $pdo = new PDO($dsn, $user, $password);
        */

        //Create a pdo instance
        $this->bdd = new \PDO('mysql:host=localhost;dbname=Cinema;charset=utf8', 'root', 'root');
    }

    function getBDD(){
        // the function which allows us to connect to DB when we return it
        return $this->bdd;
    }

    public function executerRequete($sql, $params = NULL){
    // Function which allows us to execute the queries

        // Showing the errors
        $this -> bdd -> setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); 

        if ($params == NULL){
            $resultat = $this->bdd->query($sql);
        }else{
            $resultat = $this->bdd->prepare($sql);
            $resultat->execute($params);
        }
        return $resultat;
    }
}