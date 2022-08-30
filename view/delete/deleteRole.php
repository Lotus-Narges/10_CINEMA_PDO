<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of Roles</h2>
<hr>
<br>

<table class="table table-success table-striped">

   <thead class="table-dark">  
       <tr>
           <th>Movie</th>
           <th>Actor First_Name</th>
           <th>Actor Last_Name</th>
           <th>Role</th>
           <th>Delete</th>
       </tr>
   </thead>

   <tbody>  
   <?php while ($role = $roles -> fetch()){
    
   ?>
       <tr>
           <td><?= $role['title'] ?></td>
           <td><?= $role['first_name'] ?></td>
           <td><?= $role['last_name'] ?></td>
           <td><?= $role['role'] ?></td>
           <td><a href="index.php?action=deleteRole&id=<?=$role['id_role']?>">Delete</a></td>
           <!-- Here there's a problem -> instead of showing just delete as the link, it shows also the href link! -->
           <!-- Solution ->  in findAllRoles() method, we should get the id_role  -->
        </tr>
        <?php } ?>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";