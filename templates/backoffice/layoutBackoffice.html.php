
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <script src="https://kit.fontawesome.com/5142545afa.js" crossorigin="anonymous"></script>
        <script src="https://cdn.tiny.cloud/1/5krhv1m6ajju1a6d9xzw94sn950yq4ocsg74gvq98tcrvkax/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <link rel="stylesheet" href="css/backend-style.css" />
        <title>Blog</title>
    </head>
        <body>
            <header>
                <h2>Jean Forteroche, bienvenue sur votre tableau de bord</h2>
                <p class="desc-board">Ici, vous pouvez ajouter, consulter, modifier ou supprimer un épisode. Vous pouvez également valider ou 
                    modérer un commentaire qui a été signalé.</p>
            </header>
            <div class="main-div">
                <nav>                
                    <div class="menu-navigation"> 
                        <a href="index.php"> Retourner sur le blog</a>      
                        <a href="index.php?action=authorBoard">Les épisodes publiés</a>
                        <a href="index.php?action=pendingEpisodes">Les épisodes non publiés</a>
                        <a href="index.php?action=reportedCommentsBoard">Les commentaires signalés</a>
                        <a href="index.php?action=logout">Déconnexion</a>
                    </div> 
                </nav>
                <main>
                    <?=$content?>
                </main>
            </div>
            <script>tinymce.init({
                selector: 'textarea',
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                toolbar_mode: 'floating',});
            </script>                 
        </body>   
</html>
