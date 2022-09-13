<?php

namespace Controller;
use Controller\CinemaController;

use Model\DAO;

class SearchController {

    public function searchActor(){

        $dao = new DAO();

        // here we must put the name of our input in listActors.php
        $key = filter_input(INPUT_POST, "keySearchActor", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sqlQuery = 'SELECT first_name, last_name FROM Actor 
                    WHERE first_name LIKE :keySearchActor OR last_name LIKE :keySearchActor
                    ORDER BY first_name;' ;

        $searchActor = $dao -> executerRequete($sqlQuery, [':keySearchActor'=> '%'.$key.'%']);

        // here we call CinemaController() -> because we want to put the search bar in listActors.php and we want to use findAllActors method
        // Create the new object of CinemaController
        $ctrlCinema = new CinemaController();
        // be able to use findAllActors() method
        $ctrlCinema->findAllActors($searchActor);

        // we do what we did above instead of require "view/listActors.php"; because we can't require the same for the both method 
    }


    public function searchDirector() {

        $dao = new DAO();

        // here we must put the name of our input in listActors.php
        $key = filter_input(INPUT_POST, "keySearchDirector", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sqlQuery ='SELECT first_name, last_name FROM Director 
                    WHERE first_name LIKE :keySearchDirector OR last_name LIKE :keySearchDirector
                    ORDER BY first_name;';

        $searchDirector = $dao -> executerRequete($sqlQuery, [':keySearchDirector'=> '%'.$key.'%']);

        // here we call CinemaController() -> because we want to put the search bar in listActors.php and we want to use findAllActors method
        // Create the new object of CinemaController
        $ctrlCinema = new CinemaController();
        // be able to use findAllActors() method
        $ctrlCinema -> findAllDirectors($searchDirector);

        // we do what we did above instead of require "view/listActors.php"; because we can't require the same for the both method 
    }



    public function searchFilm() {

        $dao = new DAO();

        // here we must put the name of our input in listActors.php
        $key = filter_input(INPUT_POST, "keySearchFilm", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $sqlQuery ='SELECT Film.title, Film.release_year, Director.first_name, Director.last_name
                    FROM Film INNER JOIN Director ON Film.id_director = Director.id_director
                    WHERE Film.title LIKE :keySearchFilm OR Film.release_year LIKE :keySearchFilm
                    OR Director.first_name LIKE :keySearchFilm OR Director.last_name LIKE :keySearchFilm 
                    ORDER BY Film.title;';

        $searchFilm = $dao -> executerRequete($sqlQuery, [':keySearchFilm'=> '%'.$key.'%']);

        // here we call CinemaController() -> because we want to put the search bar in listActors.php and we want to use findAllActors method
        // Create the new object of CinemaController
        $ctrlCinema = new CinemaController();
        // be able to use findAllActors() method
        $ctrlCinema -> findAllMovies($searchFilm);

        // we do what we did above, instead of require "view/listActors.php"; because we can't require the same for the both method 
    }

}