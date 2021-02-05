<section class="posts-list">
    
    <p class="episodes-list">Liste des épisodes en attente de publication</p>
    <p class="create"><a href="index.php?action=authorAddPost"><i class="fas fa-plus-circle"></i><span>Ajouter un épisode</span></a></p>
        
    <?php foreach($data['allposts'] as $post): ?> 
        <table>
            <tr>
                <td class="episode-title">   
                    <p ><?=$post['titlePost']?></p>
                </td>
                <td class="read">
                    <p><a href="index.php?action=publishPost&idPost=<?=$post['idPost']?>"> Publier</a></p>
                </td>
                <td class="update">
                    <p><a href="index.php?action=updatingPendingPost&idPost=<?=$post['idPost']?>"> Modifier</a></p>
                </td>
                <td class="delete">
                    <p><a href="index.php?action=deletePost&idPost=<?=$post['idPost']?>">Supprimer</a></p>
                </td>    
            </tr>
        </table>          
    <?php endforeach; ?>
    <p class="pendingPosts-paging">
        <?php
            if($data['prevPage']!== null)
            {
                echo '<a href="index.php?action=pendingEpisodes&page='.$data['prevPage'].' ">Page précédente</a>';
            }

            if($data['nextPage']!== null)
            {
                echo '<a href="index.php?action=pendingEpisodes&page='.$data['nextPage'].' ">Page suivante</a>';
            }        
        
        ?>
    </p>
</section>