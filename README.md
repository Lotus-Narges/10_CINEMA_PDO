<?php foreach ($directors -> fetchAll() as $director){?>
        <option value="<?= $director['id_director']?>"> <?= $director['first_name'] . ' ' . $director['last_name'] ?></option>
<?php } ?>



Errors:
- Insert Film -> after insert no more access to css & php & police, ....
-  Notice: Array to string conversion ->
- Delete actor -> doesn't function
- Insert Problem to DB -> Role >> wont add to list of role page
- delete films -> back -> instead of going to home page, the elements that are deleted will show up!



<!-- - in deleteActor.php we have 12 actors but in listActors.php we have 13 actors! -->