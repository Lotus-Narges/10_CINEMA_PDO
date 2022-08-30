<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of Actors</h2>
<!-- we take the $actors from CinemaController.php file in findAllActors() function -->
<!-- rowCount() -> how many actors we have in DB -->
<hr>
<p>There are <?= $actors->rowCount(); ?> Actors.</p>
<table class="table table-success table-striped">
   <caption>List of Actors</caption>

   <thead class="table-dark">  
       <tr>
           <th>First_name</th>
           <th>Last_name</th>
           <th>Sex</th>
           <th>Birth_date</th>
       </tr>
   </thead>

   <tbody>  
   <?php while ($actor = $actors -> fetch()){
    
   ?>
       <tr>
        <!-- access to name of each column of Actor table in DB -->
           <td><?= $actor['first_name'] ?></td>
           <td><?= $actor['last_name'] ?></td>
           <td><?= $actor['sex'] ?></td>
           <td><?= $actor['birth_date'] ?></td>
        </tr>
        <?php } ?>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";