<?php

namespace Controller;

use Model\DAO;

class InsertController {


    public function insertActorForm()
    {
        // Redirection to the insert actor page
        require "view/insert/insertActor.php";
    }

    public function insertActor(){
    //Insert the actors into the table

    $dao = new DAO();

    if (isset($_POST['submit'])) {
        // Get form data
        //! Here all tha names that we put in filter_input() -> they are the name we gave to our input in insertActor.php file not the columns of DB table
        $firstName = filter_input(INPUT_POST, "actorFirstName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $lastName = filter_input(INPUT_POST, "actorLastName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $sex = filter_input(INPUT_POST, "actorSex", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        // $birthDate = htmlspecialchars($_POST['birth_date']);
        // actorBirthDate -> the name we gave to our input form, it should be the same
        $date = strtr($_POST['actorBirthDate'], '/', '-');
        $birthDate = date('Y-m-d', strtotime($date));
        

        // var_dump($_POST);
        //Check required fields
        if (!empty($firstName) && !empty($lastName) && !empty($sex) && !empty($birthDate)) {
            //Passed
            $sqlQuery = 'INSERT INTO Actor (first_name, last_name, sex, birth_date)
                            VALUES (:first_name, :last_name, :sex, :birth_date)';

            // Here we execute the query & stock it in an associative array
            $insertActor = $dao -> executerRequete($sqlQuery, [':first_name'=>$firstName,
                                                                ':last_name'=>$lastName,
                                                                ':sex'=>$sex,
                                                                ':birth_date'=>$birthDate]);

            var_dump($insertActor);

            if ($insertActor){
                echo "Actor added";
            }else{
                echo "Error";
            }
        } 
            

    }
    // Allows us to reload the page after the submit
    $this -> insertActorForm();
    }


    public function insertDirectorForm(){
        require "view/insert/insertDirector.php";
    }

    public function insertDirector(){

        $dao = New DAO();

        if(isset($_POST['submit'])){
            $firstName = filter_input(INPUT_POST, "directorFirstName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $lastName = filter_input(INPUT_POST, "directorLastName", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sex = filter_input(INPUT_POST, "directorSex", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $date = strtr($_POST['directorBirthDate'], '/', '-');
            $birthDate = date('Y-m-d', strtotime($date));

            var_dump($_POST);



        if (!empty($firstName) && !empty($lastName) && !empty($sex) && !empty($birthDate)) {
            //Passed
            $sqlQuery = 'INSERT INTO Director (first_name, last_name, sex, birth_date)
                            VALUES (:first_name, :last_name, :sex, :birth_date)';

            // Here we execute the query & stock it in an associative array
            $insertDirector = $dao -> executerRequete($sqlQuery, [':first_name'=>$firstName,
                                                                ':last_name'=>$lastName,
                                                                ':sex'=>$sex,
                                                                ':birth_date'=>$birthDate]);

            var_dump($insertDirector);

            if ($insertDirector){
                echo "Director added";
            }else{
                echo "Error";
            }
        } 
            

    }

    // Allows us to reload the page after the submit
    $this -> insertDirectorForm();
    }



    public function insertFilmForm(){
        // upload the insertFilm.php in index.php through template.php
        //this method will allow us the to show list of the directors in insertFilm page on the website

        $dao = new DAO();
        $sqlQuery1 = "SELECT id_director, first_name, last_name FROM Director; ";
        $sqlQuery2 = "SELECT id_genre, genre FROM Genre;";

        $directors = $dao -> executerRequete($sqlQuery1);
        $genres = $dao -> executerRequete($sqlQuery2);
        
        require "view/insert/insertFilm.php";
    }

    public function insertFilm(){

        $dao = New DAO();

        if(isset($_POST['submit'])){
            $filmTitle = filter_input(INPUT_POST, "filmTitle", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // $date = strtr($_POST['filmReleaseYear'], '/', '-');
            // $filmReleaseYear = date('Y-m-d', strtotime($date));
            $filmReleaseYear = filter_input(INPUT_POST, 'filmReleaseYear', FILTER_SANITIZE_NUMBER_INT);
            $filmRunTime = filter_input(INPUT_POST, 'filmRunTime', FILTER_SANITIZE_NUMBER_INT);
            $filmSummary = filter_input(INPUT_POST, "filmSummary", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // the name of the label in insertFilm.php
            $filmDirector = $_POST['filmDirector'];
            $filmGenre = $_POST['filmGenre'];
            

            var_dump($_POST);
            print_r($_POST);



        if (!empty($filmTitle) && !empty($filmReleaseYear) && !empty($filmRunTime ) && !empty($filmSummary) && !empty($filmDirector)) {
            //Passed

            //Insert film details
            $sqlQuery1 = 'INSERT INTO Film (title, release_year, run_time, summary, id_director)
                            VALUES (:title, :release_year, :run_time, :summary, :id_director)';
            // Get the id of the last film that is added
            $sqlQuery2 = 'SELECT MAX(id_film) FROM Film;';

            //insert the data to Genre-film table
            $sqlQuery3 = 'INSERT INTO Genre_film (id_film, id_genre) 
                            VALUES (:id_film, :id_genre)';

            // insert the data into casting table
            // $sqlQuery4 ='INSERT INTO Casting (id_film, id_actor, id_role)
            //                 VALUES (:id_film, :id_actor, :id_role)';

            // Here we execute the query & stock it in an associative array
            // We stock the information about the film (Film table)
            $insertFilm1 = $dao -> executerRequete($sqlQuery1, [':title'=>$filmTitle,
                                                                ':release_year'=>$filmReleaseYear,
                                                                ':run_time'=>$filmRunTime,
                                                                ':summary'=>$filmSummary,
                                                                ':id_director'=>$filmDirector]);
            
            //We get the Max id -> id of the eilm that we just added
            // when we want to show or list sth we must have fetch() / fetchAll()
            $getMaxID = $dao -> executerRequete($sqlQuery2) -> fetch();

            echo "Max id:";
            var_dump($getMaxID);

            // We insert the data in Genre_film table
            // Array to string conversion -> :id_film'=>$getMaxID[0] >> We want to have access to the value of index
            $insertGenreFilm = $dao -> executerRequete($sqlQuery3, [':id_film'=>$getMaxID[0],
                                                                ':id_genre'=>$filmGenre]);

            print_r($insertFilm1);

            if ($insertFilm1 && $insertGenreFilm){
                echo "Film added";
            }else{
                echo "Error";
        }
        } 
    }
    // Allows us to reload the page after the submit
    $this -> insertFilmForm();
    }



    public function insertRoleForm(){

        require "view/insert/insertRole.php";
    }

    public function insertRole(){

        $dao = new DAO();

        if(isset($_POST['submit'])){

            $role = filter_input(INPUT_POST, 'role', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            if(!empty($role)){

                $sqlQuery1 = 'INSERT INTO Role (role) VALUES (:role)';
                $insertRole = $dao -> executerRequete($sqlQuery1, [':role' => $role]);
                var_dump($insertRole);

                if ($insertRole){
                    echo "Role Added";
                }else{
                    echo "Error";
                }
            }
        }
        // Allows us to reload the page after the submit
        $this -> insertRoleForm();
    }

     
    public function insertCastingForm(){
        //* Returns all the Actors in DB

        $dao = new DAO();

        $sqlQuery1 = "SELECT id_role, role FROM Role;" ;
        $roles = $dao -> executerRequete($sqlQuery1);

        // this query allows us to select an actor
        $sqlQuery2 = "SELECT id_actor, first_name, last_name FROM Actor; ";
        $actors = $dao -> executerRequete($sqlQuery2);

        // this query allows us to select a film 
        $sqlQuery3 = "SELECT id_film, title FROM Film";
        $films = $dao -> executerRequete($sqlQuery3);

        require "view/insert/insertCasting.php";

    }


    public function insertCasting(){

        $dao = new DAO();

        if(isset($_POST['submit'])){

            // we stock the actor & film & role that we choose on web page and we stock it in these variables by $_POST[]
            // here we use superglobal $_POST[] because we get the data through the web page and user chooses one by one
            $roleCasting = $_POST['roleCasting'];
            $actorCasting = $_POST['actorCasting'];
            $filmCasting = $_POST['filmCasting'];

            if(!empty($roleCasting) && !empty($actorCasting) && !empty($filmCasting)){

                // Another way of doing it -> insert the role & choose the actor & film in the same time by getting the MAX(Last) id added to role table

                // $sqlQuery1 = 'INSERT INTO Role (role) VALUES (:role)';
                // $insertRole = $dao -> executerRequete($sqlQuery1, [':role' => $role]);
                // var_dump($insertRole);

                // $sqlQuery2 = 'SELECT MAX(id_role) FROM Role;';
                // $getMaxID = $dao -> executerRequete($sqlQuery2) -> fetch();

                $sqlQuery = 'INSERT INTO Casting (id_film, id_actor, id_role) VALUES (:id_film, :id_actor, :id_role)';
                $insertCasting = $dao -> executerRequete($sqlQuery, [':id_film' => $filmCasting,
                                                                        ':id_actor' => $actorCasting,
                                                                        // ':id_role' => $getMaxID[0]
                                                                        ':id_role' => $roleCasting]);

                var_dump($insertCasting);

                if ($insertCasting){
                    echo "Casting Added";
                }else{
                    echo "Error";
                }
            }
        }
        // Allows us to reload the page after the submit
        $this -> insertCastingForm();
    }



    public function showGenreForm(){
        require "view/insert/insertGenre.php";
    }
    
}

?>