<?php
// Start the temporary memory
ob_start();

?>

<h2>Modifying the DATA</h2>
<hr>

<table class="table table-success table-striped">

   <thead class="table-dark">  <!-- En-tête du tableau -->
       <tr>
           <th>Insert Data</th>
           <th>Delete Data</th>
           <!-- <th>Update Data</th>
           <th>Search Data</th> -->
       </tr>
   </thead>

   
    <tbody>  
       <tr>
          <!-- Here for action we put the name of the function which redirect us to the page ( EX -> insertActor.php )-->
          <!-- The ....Form pages -> the pages which allow us to modify data through them -->
            <td><a class="link" href="index.php?action=insertActorForm">Insert Actor</a></td>
            <td><a class="link" href="index.php?action=deleteActorForm">Delete Actor</a></td>
       </tr>
       <tr>
            <td><a class="link" href="index.php?action=insertDirectorForm">Insert Director</a></td>
            <td><a class="link" href="index.php?action=deleteDirectorForm">Delete Director</a></td>
       </tr>
       <tr>
            <td><a class="link" href="index.php?action=insertFilmForm">Insert Film</a></td>
            <td><a class="link" href="index.php?action=deleteFilmForm">Delete Film</a></td>
       </tr>
       <tr>
            <td><a class="link" href="index.php?action=insertRoleForm">Insert Role</a></td>
            <td><a class="link" href="index.php?action=deleteRoleForm">Delete Role</a></td>
       </tr>
       <tr>
            <td><a class="link" href="index.php?action=insertCastingForm">Insert Casting</a></td>
            <td><a class="link" href="index.php?action=deleteCastingForm">Delete Casting</a></td>
       </tr>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";