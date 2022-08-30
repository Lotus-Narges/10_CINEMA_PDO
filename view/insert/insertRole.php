<?php
 ob_start();

?>

<h2> Insert Role </h2>
<hr>
<!-- Here: we insert the role (which we write it directly), then we associate the film & actor (which exists already in DB) to the role -->

<form method="POST" action="index.php?action=insertRole"> 
    <label> Role </label><br>
    <input type="text" name="role" required>

    <br>
    <br>
    
    <button type="submit" name="submit"> Submit </button>

</form>


    


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";