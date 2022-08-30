<?php
ob_start();
?>

<h2> Insert The Movie </h2>
<hr>

<form method="POST" action="index.php?action=insertFilm">
    <label> Title </label><br>
    <input type="text" name="filmTitle" required>
    <br>
    <label> Release Year </label><br>
    <input type="number" name="filmReleaseYear" required>
    <br>
    <label> Run Time </label><br>
    <input type="number" name="filmRunTime" required>
    <br>


    <label for="select-genre"> Genre: </label><br>
    <select name="filmGenre" id="select-genre">
        <option value="">--Please Select The Genre--</option>
        <!-- $directors related to the insertController.php file & showFilmForm() method -->
        <?php while ($genre = $genres -> fetch()){ ?>
        <!-- the value we put in [] sould be exactly the same as our column name in DB (the key of the associative array that we stock the data in it(executerRequet))-->
        <option value="<?= $genre['id_genre']?>"> <?= $genre['genre'] ?></option>
        <?php } ?>
    </select>
    <br>


    <label for="select-director"> Director: </label><br>
    <select name="filmDirector" id="select-director">
        <option value="">--Please Select The Director--</option>
        <!-- $directors related to the insertController.php file & showFilmForm() method -->
        <?php while ($director = $directors -> fetch()){ ?>
        <!-- the value we put in [] sould be exactly the same as our column name in DB (the key of the associative array that we stock the data in it(executerRequet))-->
        <option value="<?= $director['id_director']?>"> <?= $director['first_name'] . ' ' . $director['last_name'] ?></option>
        <?php } ?>
    </select>
    <br>     
    <br>
    <label for="summary"> Summary </label><br>
    <textarea id="summary" name="filmSummary" required> </textarea>
    <br>
    <button type="submit" name="submit"> Submit </button>
</form>

<!-- ERROR -> Films dont insert in DB -->


<?php

//clean the temporary memory
$content = ob_get_clean();

// redirection 
require "view/template.php";