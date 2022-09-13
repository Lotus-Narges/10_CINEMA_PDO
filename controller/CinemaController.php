<?php

namespace Controller;

use Model\DAO;

class CinemaController
{
    public function homePage()
    {
        // The function which redirect us to the home page
        require "view/homePage.php";
    }

    public function modifyData()
    {
        // Redirection to the Modify page
        require "view/modifyData.php";
    }


    public function findAllMovies($searchFilm = null)
    {
        //* Search all the movies in DB
        // create new object of DAO class -> access to data in DB
        // !DAO (data access object) -> Allows us to have access to the data which are stocked in DB

        $dao = new DAO();

        // The query we send to DB
        // id film is very important to get because its the element allows us to get the film by id
        $sqlQuery = "SELECT f.id_film, f.title, f.release_year, f.run_time, f.summary, d.first_name, d.last_name 
                     FROM Film f 
                     INNER JOIN Director d 
                     ON f.id_director = d.id_director
                     ORDER BY f.id_film ASC; ";

        // We execute the query with the help of DAO class and calling the executerRequete function (Object operator ->)
        // $films variable is gonna be used in view (fetch() & rowCount() functions -> we apply these functions to this variable)
        // $films -> A variable that holds the execution part & our SQL query
        $films = $dao -> executerRequete($sqlQuery);

        $search = $searchFilm;

        // inclut le contenu d'un autre fichier appelé, et provoque une erreur bloquante s'il est indisponible
        require "view/listFilms.php";
    }



    public function findAllRoles()
    {
        //* Returns all the Roles in DB

        $dao = new DAO();
        $sqlQuery = "SELECT Film.title, Actor.first_name, Actor.last_name, Role.role, Role.id_role  
                        FROM Actor
                        INNER JOIN Casting
                        ON Actor.id_actor = Casting.id_Actor
                        INNER JOIN Role
                        ON Casting.id_role = Role.id_role
                        INNER JOIN Film
                        ON Casting.id_film = Film.id_film
                        ORDER BY Film.title";
        $roles = $dao -> executerRequete($sqlQuery);

        require "view/listRoles.php";
    }



    public function findAllActors($searchActor = null)
    // here we set $searchActor argument to be able to make connection between CinemaController & SearchController
    // we set the $searchActor = null -> in case there's no argument we wont have any arror
    {
        //* Returns all the Actors in DB

        $dao = new DAO();
        $sqlQuery = "SELECT id_actor, first_name, last_name, sex, birth_date FROM Actor ORDER BY id_actor ASC; ";
        $actors = $dao -> executerRequete($sqlQuery);
        
        // we stock $searchActor argument to the $search variable
        $search = $searchActor;

        require "view/listActors.php";
    }



    public function findAllDirectors($searchDirector = null)
    {
        //* Returns all the Directors in DB

        $dao = new DAO();
        $sqlQuery = "SELECT id_director, first_name, last_name, birth_date, sex FROM Director ORDER BY id_director ASC; ";
        $directors = $dao -> executerRequete($sqlQuery);

        $search = $searchDirector;

        require "view/listDirectors.php";
    }
//--------------------------------------------------------------------------------------------------------------------------

    public function showFilm($id)
    {
        //* Shows all the details about a movie
        $dao = new DAO();

        $sqlQuery1 = "SELECT f.title, f.release_year, f.run_time, f.summary 
                     FROM Film f
                     WHERE f.id_film = :id";


        //* Returns all the Actors who played in a movie
        $sqlQuery2 = "SELECT Actor.first_name, Actor.last_name, Role.role  
                    FROM Actor
                    INNER JOIN Casting
                    ON Actor.id_actor = Casting.id_Actor
                    INNER JOIN Role
                    ON Casting.id_role = Role.id_role
                    INNER JOIN Film
                    ON Casting.id_film = Film.id_film
                    WHERE Film.id_film = :id";

        $filmDetails = $dao -> executerRequete($sqlQuery1, [":id" => $id]);
        $filmActors = $dao -> executerRequete($sqlQuery2, [":id" => $id]);

        require "view/filmDetails.php";
    }

}