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
           <th>First_name</th>
           <th>Last_name</th>
           <th>Role</th>
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
        </tr>
        <?php } ?>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";