<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of Castings</h2>
<hr>
<p>There are <?= $castings->rowCount(); ?> Castings.</p>
<table class="table table-success table-striped">

   <thead class="table-dark">  
       <tr>
           <th>ID_Film</th>
           <th>Film Title</th>
           <th>ID_Actor</th>
           <th>Actor's Name</th>
           <th>ID_Role</th>
           <th>Role</th>
           <th>Delete</th>
       </tr>
   </thead>

   <tbody>  
   <?php while ($casting = $castings -> fetch()){
    
   ?>
       <tr>
        <!-- access to name of each column of the table in DB -->
           <td><?= $casting['id_film'] ?></td>
           <td><?= $casting['title'] ?></td>
           <td><?= $casting['id_actor'] ?></td>
           <td><?= $casting['first_name'] . ' ' . $casting['last_name']?></td>
           <td><?= $casting['id_role'] ?></td>
           <td><?= $casting['role'] ?></td>
           <!-- the value we put in [] sould be exactly the same as our column name in DB (the key of the associative array that we stock the data in it(executerRequet))-->
           <td><a href="index.php?action=deleteCasting&id1=<?=$casting['id_role']?>&id2=<?=$casting['id_actor']?>&id3=<?=$casting['id_film']?>">Delete</a></td>
        </tr>
        <?php } ?>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";