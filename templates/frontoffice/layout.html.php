<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="stylesheet" href="css/frontend-style.css" />
        <title>Blog</title>
    </head>

    <body>
        <nav>            
            <a href="index.php">ACCUEIL</a>
            <a href="index.php?action=posts">EPISODES</a>            
            <a href="index.php?action=unknow">ME CONTACTER</a>
        </nav>        

        <main>
            <?=$content?>
        </main>
        
        <footer class="footer text-center">
            <h3>Copyright Toto</h3>
        </footer>        
    </body>
</html>
