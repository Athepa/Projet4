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
            <header>
                <h2>Jean Forteroche, bienvenue sur votre tableau de bord</h2>
                <p class="desc-board">Ici, vous pouvez ajouter, consulter, modifier ou supprimer un épisode. Vous pouvez également valider ou modérer un commentaire qui a été signalé.</p>
            </header>
            <div class="main-div">
                <nav>                
                    <div class="menu-navigation"> 
                        <a href="index.php"> Retourner sur le blog</a>      
                        <a href="index.php?action=authorBoard">Les épisodes publiés</a>
                        <!--<a href="">Les épisodes en attente de publication</a>-->
                        <a href="index.php?action=reportedCommentsBoard">Les commentaires signalés</a>
                    </div> 
                </nav>
                <main>
                    <?=$content?>
                </main>
            </div>                  
        </body>   
</html>
