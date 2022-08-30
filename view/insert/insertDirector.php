<?php
ob_start();
?>

<h2> Insert Director Details </h2>
<hr>

<form method="POST" action="index.php?action=insertDirector">
    <label> Director's First Name </label><br>
    <input type="text" name="directorFirstName" required>
    <br>
    <label> Director's Last Name </label><br>
    <input type="text" name="directorLastName" required>
    <br>
    <div>
        <label> Director's Sex </label><br>
        <input type="radio" id="male" name="directorSex" value="M">
        <label for="male">Male</label>
        <br>
        <input type="radio" id="female" name="directorSex" value="F">
        <label for="female">Female</label>
    </div>
    <label> Director's Birth Date</label><br>
    <input type="date" name="directorBirthDate" required>
    <br>
    <button type="submit" name="submit"> Submit </button>
</form>

<?php

//clean the temporary memory
$content = ob_get_clean();

// redirection 
require "view/template.php";