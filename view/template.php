<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/CSS/style.css">
    <!-- Bootstrap CDN - CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous"> 
    <title>Document</title>
</head>
<body>
    <div id="mainContainer">
    
        <header>
            <h1 class="header1"> Welcome to my website</h1>
        </header>

        <main>

            <!-- $content exists in homePage file which removes the temporary memory -->
            <?= $content; ?>
        

        </main>

        <footer>

        </footer>
        
    </div> 
</body>
</html>