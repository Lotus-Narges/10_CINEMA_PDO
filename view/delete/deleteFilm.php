<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of films</h2>
<!-- we take the $films from CinemaController.php file in findAllFilms() function -->
<!-- rowCount() -> how many films we have in DB -->
<hr>
<p>There are <?= $films->rowCount(); ?> films</p>
<table class="table table-success table-striped">
   <caption>List of films</caption>

   <thead class="table-dark">  
       <tr>
           <th>Title</th>
           <th>release_year</th>
           <th>run_time</th>
           <th>summary</th>
           <th>Director</th>
           <th>Delete</th>
       </tr>
   </thead>

   <tbody>  
    <?php while ($film = $films -> fetch()){ ?>
       <tr>
            <!-- access to name of each column of Film table in DB -->
           <td><?= $film['title'] ?></td>
           <td><?= $film['release_year'] ?></td>
           <td><?= $film['run_time'] ?></td>
           <td><?= $film['summary'] ?></td>
            <!-- Here we have access to director table by the INNER JOIN in our query -->
           <td><?= $film['first_name'] . ' ' . $film['last_name']?></td>
           <td><a href="index.php?action=deleteFilm&id=<?=$film['id_film']?>">Delete</a></td>
        </tr>
    <?php } ?>
   </tbody>
</table>

<!-- <a href="index.php?action=showFilmForm">Add Movie</a> -->


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";