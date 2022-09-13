<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of Actors</h2>
<!-- we take the $actors from CinemaController.php file in findAllActors() function -->
<!-- rowCount() -> how many actors we have in DB -->
<hr>
<p>There are <?= $actors->rowCount(); ?> Actors.</p>


<!--------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Making the search bar -->
<div>
    <form action="index.php?action=searchActor" method="POST">
        <input type="text" placeholder="Search Actor" name="keySearchActor">
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<br>

<!-- Showing the search results -->
<?php
//We need to set this condition because if we don't have it we're gonna get an error
//Fatal error: Uncaught Error: Call to a member function rowCount() on null
if (isset($_POST['submit'])) {
    if (!empty($_POST['keySearchActor'])) {
        // $search -> comes from CinemaController.php, findAllActors() method
        if ($search -> rowCount() > 0) {
            //output the results?>

            <table class="table table-success table-striped">

                <thead>  
                    <tr>
                        <th>First_name</th>
                        <th>Last_name</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    while ($result = $search -> fetch()) { ?>
                        <tr>
                            <!-- access to name of each column of Actor table in DB -->
                            <td><?= $result['first_name'] ?></td>
                            <td><?= $result['last_name'] ?></td>
                        </tr>  
                    <?php }
            } else { ?>
                <p>No results found</p>
            <?php }?>

                </tbody>
            </table>

    <?php } else {
        echo "Please Write Something";
    }       
}?>           
<hr>

<!--------------------------------------------------------------------------------------------------------------------------------------- -->


<!-- list of all the actors -->
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