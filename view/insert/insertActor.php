<?php
 ob_start();

?>

<h2> Insert Actor Details </h2>
<hr>

<form method="POST" action="index.php?action=insertActor">
    <label> Actor's Fisrt Name </label><br>
    <input type="text" name="actorFirstName" required>
    <br>
    <label> Actor's Last Name </label><br>
    <input type="text" name="actorLastName" required>
    <br>
    <div>
        <label> Actor's Sex </label><br>
        <input type="radio" id="male" name="actorSex" value="M">
        <label for="male">Male</label>
        <br>
        <input type="radio" id="female" name="actorSex" value="F">
        <label for="female">Female</label>
    </div>
    <label> Actor's Birth Date </label><br>
    <input type="date" name="actorBirthDate" required>
    <br>
    <button type="submit" name="submit"> Submit </button>
</form>


<?php 

// Clean the temporary memory
$content = ob_get_clean();
// we dedirect to template.php page
require "view/template.php";