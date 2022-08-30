<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of Directors</h2>
<!-- we take the $directors from CinemaController.php file in findAllDirectors() function -->
<!-- rowCount() -> how many director we have in DB -->
<hr>
<p>There are <?= $directors->rowCount(); ?> Directors.</p>
<table class="table table-success table-striped">

   <thead class="table-dark">  
       <tr>
           <th>First_name</th>
           <th>Last_name</th>
           <th>Birth_date</th>
           <th>Sex</th>
           <th>Delete</th>
       </tr>
   </thead>

   <tbody>  
   <?php while ($director = $directors -> fetch()){
    
   ?>
       <tr>
        <!-- access to name of each column of Director table in DB -->
           <td><?= $director['first_name'] ?></td>
           <td><?= $director['last_name'] ?></td>
           <td><?= $director['birth_date'] ?></td>
           <td><?= $director['sex'] ?></td>
           <!-- the value we put in [] sould be exactly the same as our column name in DB (the key of the associative array that we stock the data in it(executerRequet))-->
           <td><a href="index.php?action=deleteDirector&id=<?=$director['id_director']?>">Delete</a></td>
        </tr>
        <?php } ?>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";