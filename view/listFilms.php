<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of films</h2>
<!-- we take the $films from CinemaController.php file in findAllFilms() function -->
<!-- rowCount() -> how many films we have in DB -->
<hr>
<p>There are <?= $films->rowCount(); ?> films in stock</p>

<!--------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Making the search bar -->
<div>
    <form action="index.php?action=searchFilm" method="POST">
        <input type="text" placeholder="Search Film" name="keySearchFilm">
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<br>

<!-- Showing the search results -->
<?php

//We need to set this condition because if we don't have it we're gonna get an error
//Fatal error: Uncaught Error: Call to a member function rowCount() on null
if (isset($_POST['submit'])) {
    if (!empty($_POST['keySearchFilm'])) {
        // $search -> comes from CinemaController.php, findAllMovies() method
        if ($search -> rowCount() > 0) {
        //output the results?>

            <table class="table table-success table-striped">

                <thead>  
                    <tr>
                        <th>Title</th>
                        <th>Release_year</th>
                        <th>Director</th>
                    </tr>
                </thead>

            <tbody>
                <?php
                while ($result = $search -> fetch()) { ?>
                    <tr>
                        <!-- access to name of each column of Film table in DB -->
                        <td><?= $result['title'] ?></td>
                        <td><?= $result['release_year'] ?></td>
                        <td><?= $result['first_name'] . ' ' .  $result['last_name']?></td>
                    </tr>       
                <?php }
        }else { ?>
            <p>No result found</p>
        <?php }?>

            </tbody>
        </table>

    <?php }else {
        echo "Please Write Something";
    }        
}?>           
<hr>

<!----------------------------------------------------------------------------------------------------------------------------------------->


<table class="table table-success table-striped">
   <caption>List of films</caption>

   <thead class="table-dark">  
       <tr>
           <th>Title</th>
           <th>release_year</th>
           <th>run_time</th>
           <th>summary</th>
           <th>Director</th>
           <th>Details</th>
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
           <td><a href="index.php?action=filmDetails&id=<?=$film['id_film']?>">click here</a></td>
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