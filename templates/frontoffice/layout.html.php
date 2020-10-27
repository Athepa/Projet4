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
            <div class="logo-blog">
                <a href="index.php"> LE BLOG DE JEAN FORTEROCHE</a>
            </div> 
            <div class="menu-navigation">       
                <a href="index.php">ACCUEIL</a>
                <a href="index.php?action=posts">EPISODES</a>            
                <a href="index.php?action=unknow">ME CONTACTER</a>
            </div> 
        </nav>        

        <main>
            <?=$content?>
        </main>
        
        <footer class="footer text-center">
            <h3>Plan du site</h3>
            <p><a href="index.php">Accueil</a></p>
            <p><a href="index.php?action=posts">Episodes</a></p>
            <p><a href="index.php?action=unknow">Contact</a></p>
        </footer>        
    </body>
</html>
