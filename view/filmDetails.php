<?php
 ob_start();
 $film = $filmDetails -> fetch();
 // we put in temorary memory

//  var_dump($filmDetails);
?>

<h2> Film Details </h2>
<hr>
<p>Title: <?= $film['title']; ?></p>  
<p>Release year: <?= $film['release_year']; ?></p> 
<p>Run time: <?= $film['run_time']; ?></p> 
<Summary>Summary: <?= $film['summary']; ?></Summary>

<br>
<br>

<h5>List of All Actors Played in <?= $film['title']; ?></h5>

<table class="table table-success table-striped">

   <thead class="table-dark">  
       <tr>
           <th>First_name</th>
           <th>Last_name</th>
           <th>Role</th>
       </tr>
   </thead>

   <tbody>  
   <?php while ($actor = $filmActors -> fetch()){
    
   ?>
        <tr>
        <!-- access to name of each column of Actor table in DB -->
           <td><?= $actor['first_name'] ?></td>
           <td><?= $actor['last_name'] ?></td>
           <td><?= $actor['role'] ?></td>
        </tr>
        <?php } ?>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";