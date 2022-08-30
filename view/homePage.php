<?php
 ob_start() 
 // we put in temorary memory
?>


<h2>Home</h2>
<hr>
<nav class="home-nav">
    <ul class="home-list">
        <a class="link list" href="index.php?action=listFilms">List of Films</a>
        <a class="link list" href="index.php?action=listActors">List of Actors</a>
        <a class="link list" href="index.php?action=listDirectors">List of Directors</a>
        <a class="link list" href="index.php?action=listRoles">List of Roles</a>
        <a class="link list" href="index.php?action=modifyData">Modify Data</a>
    </ul>
</nav>

<?php 

// Clean the temporary memory
$content = ob_get_clean();
require "view/template.php";