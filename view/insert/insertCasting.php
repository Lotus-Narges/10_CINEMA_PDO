<?php
 ob_start();

?>

<h2> Insert Casting </h2>
<hr>
<!-- Here: we insert the role (which we write it directly), then we associate the film & actor (which exists already in DB) to the role -->

<form method="POST" action="index.php?action=insertCasting"> 
    <label for="select-role"> Role: </label><br>
    <select class="select" name="roleCasting" id="select-role">
        <option class="select-option" value="">--Please Select The Role--</option><br>
        <!-- $directors related to the insertController.php file & showFilmForm() method -->
        <?php while ($role = $roles -> fetch()){ ?>
        <!-- the value we put in [] sould be exactly the same as our column name in DB (the key of the associative array that we stock the data in it(executerRequet))-->
        <option value="<?= $role['id_role']?>"> <?= $role['role']?></option>
        <?php } ?>
    </select>
    <br>
    <label for="select-actor"> Actor: </label><br>
    <select name="actorCasting" id="select-actor">
        <option class="select-option" value="">--Please Select The Actor--</option><br>
        <!-- $directors related to the insertController.php file & showFilmForm() method -->
        <?php while ($actor = $actors -> fetch()){ ?>
        <!-- the value we put in [] sould be exactly the same as our column name in DB (the key of the associative array that we stock the data in it(executerRequet))-->
        <option value="<?= $actor['id_actor']?>"> <?= $actor['first_name'] . ' ' . $actor['last_name'] ?></option>
        <?php } ?>
    </select>
    <br>
    <label for="select-film"> Film: </label><br>
    <select name="filmCasting" id="select-film">
        <option class="select-option" value="">--Please Select The Film--</option><br>
        <!-- $directors related to the insertController.php file & showFilmForm() method -->
        <?php while ($film = $films -> fetch()){ ?>
        <!-- the value we put in [] sould be exactly the same as our column name in DB (the key of the associative array that we stock the data in it(executerRequet))-->
        <option value="<?= $film['id_film']?>"> <?= $film['title']?> </option>
        <?php } ?>
    </select>

    <br>
    <br>
    
    <button type="submit" name="submit"> Submit </button>

</form>


    


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";