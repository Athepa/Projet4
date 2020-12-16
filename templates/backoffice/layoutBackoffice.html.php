<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script src="https://kit.fontawesome.com/5142545afa.js" crossorigin="anonymous"></script>        
        <link rel="stylesheet" href="css/backend-style.css" />
        <title>Blog</title>
    </head>
        <body>
            <nav> 
                <div class="logo-blog">
                    <a href="index.php"> Retourner sur le blog</a>
                </div> 
                <div class="menu-navigation">       
                    <a href="index.php?action=authorBoard">Les épisodes publiés</a>
                    <a href="index.php?action=reportedCommentsBoard">Les commentaires signalés</a>
                </div> 
            </nav>        

            <main>
                <?=$content?>
            </main>        
        </body>   
</html>
