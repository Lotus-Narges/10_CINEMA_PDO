<?php

namespace Controller;

use Model\DAO;

class DeleteController{

    public function deleteActorForm()
    {   
        $dao = new DAO();

        $sqlQuery = "SELECT Film.title, Actor.id_actor, Actor.first_name, Actor.last_name, Actor.sex, Actor.birth_date 
                    FROM Actor
                    INNER JOIN Casting ON Casting.id_actor = Actor.id_actor
                    INNER JOIN Film ON Casting.id_film = Film.id_film
                    ORDER BY Film.title; ";

        $actors = $dao -> executerRequete($sqlQuery);

        // Redirection to the deleteActor.php page
        require "view/delete/deleteActor.php";
    }

    public function deleteActor($id){
        //Delete the actor from DB
        $dao = new DAO();

        $sqlQuery ="DELETE FROM Actor WHERE id_actor = :id ";
        $actors = $dao -> executerRequete($sqlQuery, [":id" => $id]);

        if($actors){
            echo "Actor Deleted";
        }else{
            echo "Error";
        }

        $this -> deleteActorForm();

    }


    public function deleteDirectorForm(){

        $dao = new DAO();

        $sqlQuery = "SELECT Director.id_director, Director.first_name, Director.last_name, Director.sex, Director.birth_date 
                    FROM Director ORDER BY Director.id_director ASC;";

        $directors = $dao -> executerRequete($sqlQuery);

        // Redirection to the deleteDirector.php page
        require "view/delete/deleteDirector.php";
    }


    public function deleteDirector($id){

        $dao = new DAO();

        $sqlQuery ="DELETE FROM Director WHERE id_director = :id ";
        $directors = $dao -> executerRequete($sqlQuery, [":id" => $id]);

        if($directors){
            echo "Director Deleted";
        }else{
            echo "Error";
        }

        $this -> deleteDirectorForm();

    }


    public function deleteFilmForm(){

        $dao = new DAO();

        $sqlQuery = "SELECT f.id_film, f.title, f.release_year, f.run_time, f.summary, d.first_name, d.last_name 
                        FROM Film f 
                        INNER JOIN Director d 
                        ON f.id_director = d.id_director
                        ORDER BY f.id_film ASC; ";

        $films = $dao -> executerRequete($sqlQuery);

        // Redirection to the deleteDirector.php page
        require "view/delete/deleteFilm.php";
    }


    public function deleteFilm($id){

        $dao = new DAO();

        $sqlQuery ="DELETE FROM Film WHERE id_film = :id ";
        $films = $dao -> executerRequete($sqlQuery, [":id" => $id]);

        if($films){
            echo "Film Deleted";
        }else{
            echo "Error";
        }

        $this -> deleteFilmForm();
    }

    public function deleteRoleForm(){

        $dao = new DAO();

        $sqlQuery = "SELECT Film.title, Actor.first_name, Actor.last_name, Role.role, Role.id_role
                        From Film 
                        INNER JOIN Casting ON Casting.id_film = Film.id_film
                        INNER JOIN Actor ON Casting.id_actor = Actor.id_actor
                        INNER JOIN Role ON Casting.id_role = Role.id_role;" ;

        $roles = $dao -> executerRequete($sqlQuery);
        require "view/delete/deleteRole.php";

    }


    public function deleteRole ($id){
        $dao = new DAO();

        $sqlQuery ="DELETE FROM Role WHERE id_role = :id ";
        $roles = $dao -> executerRequete($sqlQuery, [":id" => $id]);

        if($roles){
            echo "Role Deleted";
        }else{
            echo "Error";
        }

        $this -> deleteRoleForm();
    }


    public function deleteCastingForm(){

        $dao = new DAO();

        $sqlQuery = "SELECT Film.id_film, Film.title, Actor.id_actor, Actor.first_name, Actor.last_name, Role.id_role, Role.role
                    FROM Film INNER JOIN Casting ON Film.id_film = Casting.id_film
                    INNER JOIN Actor ON Casting.id_actor = Actor.id_actor
                    INNER JOIN Role ON Casting.id_role = Role.id_role
                    ORDER BY Film.title;";

        $castings = $dao -> executerRequete($sqlQuery);
        require "view/delete/deleteCasting.php";

    }


    public function deleteCasting($id1, $id2, $id3){

        $dao = new DAO();

        // How to delete an element from Casting?
        $sqlQuery ="DELETE FROM Casting WHERE id_role = :id1 AND id_actor = :id2 AND id_film = :id3; ";
        $roles = $dao -> executerRequete($sqlQuery, [":id1" => $id1,
                                                    ":id2" => $id2,
                                                    ":id3" => $id3]);

        // var_dump($sqlQuery); die;
        if($roles){
            echo "Casting Deleted";
        }else{
            echo "Error";
        }

        $this -> deleteCastingForm();

    }

}