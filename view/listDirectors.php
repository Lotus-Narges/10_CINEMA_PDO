<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>List of Directors</h2>
<!-- we take the $directors from CinemaController.php file in findAllDirectors() function -->
<!-- rowCount() -> how many director we have in DB -->
<hr>
<p>There are <?= $directors->rowCount(); ?> Directors.</p>

<!--------------------------------------------------------------------------------------------------------------------------------------- -->
<!-- Making the search bar -->
<div>
    <form action="index.php?action=searchDirector" method="POST">
        <input type="text" placeholder="Search Director" name="keySearchDirector">
        <button type="submit" name="submit">Submit</button>
    </form>
</div>
<br>

<!-- Showing the search results -->
<?php

//We need to set this condition because if we don't have it we're gonna get an error
//Fatal error: Uncaught Error: Call to a member function rowCount() on null
if(isset($_POST['submit'])){
    if(!empty($_POST['keySearchDirector'])){
        // $search -> comes from CinemaController.php, findAllDirectors() method
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
                            <!-- access to name of each column of Director table in DB -->
                            <td><?= $result['first_name'] ?></td>
                            <td><?= $result['last_name'] ?></td>
                        </tr>
                    <?php }
            } else { ?>
                <p>No results found</p>
            <?php }?>

                </tbody>
            </table>

    <?php }else {
        echo "Please Write Something";
    }        
}?>           
<hr>

<!--------------------------------------------------------------------------------------------------------------------------------------- -->


<table class="table table-success table-striped">
   <caption>List of Directors</caption>

   <thead class="table-dark"> 
       <tr>
           <th>First_name</th>
           <th>Last_name</th>
           <th>Birth_date</th>
           <th>Sex</th>
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
        </tr>
        <?php } ?>
   </tbody>
</table>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";