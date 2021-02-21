<section class="posts-list">
    
    <p class="episodes-list">Listes des épisodes publiés</p>
    <p class="create"><a href="index.php?action=authorAddPost"><i class="fas fa-plus-circle"></i><span>Ajouter un épisode</span></a></p>
    
    <?php foreach($data['allposts'] as $post): ?> 
        <div class="publish-block">
            <p class="episode-title"><?=$post['titlePost']?></p>
            <div>
                <p class="read"><a href="index.php?action=post&idPost=<?=$post['idPost']?>"> Consulter</a></p>
                <p class="update"><a href="index.php?action=updatingPost&idPost=<?=$post['idPost']?>"> Modifier</a></p>
                <p class="delete"><a href="index.php?action=deletePost&idPost=<?=$post['idPost']?>">Supprimer</a></p>
            </div>
        </div>      
    <?php endforeach; ?>
    <p class="posts-paging">
        <?php
            if($data['prevPage']!== null)
            {
                echo '<a href="index.php?action=authorBoard&page='.$data['prevPage'].' ">Page précédente</a>';
            }

            if($data['nextPage']!== null)
            {
                echo '<a href="index.php?action=authorBoard&page='.$data['nextPage'].' ">Page suivante</a>';
            }        
        
        ?>
    </p>
</section>