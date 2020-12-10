<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script src="https://kit.fontawesome.com/5142545afa.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/frontend-style.css" />
        <link rel="stylesheet" href="css/backend-style.css" />
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
                </div> 
            </nav>        

            <main>
                <?=$content?>
            </main>        
        </body>   
</html>
