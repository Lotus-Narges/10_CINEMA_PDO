<?php

// localhost:8888/CINEMA-PDO-Part10

namespace App;

// to call class instead of "requires"
use Controller\CinemaController;
use Controller\deleteController;
use Controller\insertController;
use Controller\searchController;
use Controller\updateController;

// require "Controller/CinemaController.php";

// Auto loader function, to load all the files
spl_autoload_register(function ($_className){
    require str_replace("\\","/",$_className) . ".php";

});

// creating new object of CinemaController class
$ctrlCinema = new CinemaController();
$ctrlDelete = new DeleteController();
$ctrlInsert = new InsertController();
// $ctrlSearch = new SearchController();
// $ctrlUpdate = new UpdateController();

// protection of injections in URL //! fail XSS
$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id1 = filter_input(INPUT_GET, "id1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id2 = filter_input(INPUT_GET, "id2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id3 = filter_input(INPUT_GET, "id3", FILTER_SANITIZE_FULL_SPECIAL_CHARS);


// Verify if there's an action & what to do next
if(isset($_GET['action'])) {
    // Choosing the next step based on each specific action
    switch($_GET["action"]){
        case "listFilms" : $ctrlCinema -> findAllMovies(); break;
        case "listActors" : $ctrlCinema -> findAllActors(); break;
        case "listRoles" : $ctrlCinema -> findAllRoles(); break;
        case "listDirectors" : $ctrlCinema -> findAllDirectors(); break;
        case "filmDetails" : $ctrlCinema -> showFilm($id); break;

        case "modifyData" : $ctrlCinema -> modifyData(); break;

        case "insertActorForm" : $ctrlInsert -> insertActorForm(); break;
        case "insertActor" : $ctrlInsert -> insertActor(); break;
        case "deleteActorForm" : $ctrlDelete -> deleteActorForm(); break;
        case "deleteActor" : $ctrlDelete -> deleteActor($id); break;

        case "insertDirectorForm" : $ctrlInsert -> insertDirectorForm(); break;
        case "insertDirector" : $ctrlInsert ->insertDirector() ; break;
        case "deleteDirectorForm" : $ctrlDelete -> deleteDirectorForm(); break;
        case "deleteDirector" : $ctrlDelete -> deleteDirector($id); break;

        case "insertFilmForm" : $ctrlInsert -> insertFilmForm(); break;
        case "insertFilm" : $ctrlInsert ->insertFilm() ; break;
        case "deleteFilmForm" : $ctrlDelete -> deleteFilmForm(); break;
        case "deleteFilm" : $ctrlDelete -> deleteFilm($id); break;

        case "insertRoleForm" : $ctrlInsert -> insertRoleForm(); break;
        case "insertRole" : $ctrlInsert ->insertRole() ; break;
        case "deleteRoleForm" : $ctrlDelete -> deleteRoleForm(); break;
        case "deleteRole" : $ctrlDelete -> deleteRole($id); break;

        case "insertCastingForm" : $ctrlInsert -> insertCastingForm(); break;
        case "insertCasting" : $ctrlInsert ->insertCasting() ; break;
        case "deleteCastingForm" : $ctrlDelete -> deleteCastingForm(); break;
        case "deleteCasting" : $ctrlDelete -> deleteCasting($id1, $id2, $id3); break;

        case "showGenreForm" : $ctrlInsert -> showGenreForm(); break;

    }
} else {
    // if there's no action -> redirect to the home page
    $ctrlCinema -> homePage();
}

?>