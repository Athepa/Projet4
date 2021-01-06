<section class="posts-list">
    
    <p class="episodes-list">Listes des épisodes en attente de publication</p>
    <p class="create"><a href="index.php?action=authorAddPost"><i class="fas fa-plus-circle"></i><span>Ajouter un épisode</span></a></p>
        
    <?php foreach($data['allposts'] as $post): ?> 
        <table>
            <tr>
                <td class="episode-title">   
                    <p ><?=htmlspecialchars($post['titlePost'])?></p>
                </td>
                <td class="read">
                    <p><a href="index.php?action=publishPost&idPost=<?=$post['idPost']?>"> Publier</a></p>
                </td>
                <td class="update">
                    <p><a href="index.php?action=updatingPost&idPost=<?=$post['idPost']?>"> Modifier</a></p>
                </td>
                <td class="delete">
                    <p><a href="index.php?action=deletePost&idPost=<?=$post['idPost']?>">Supprimer</a></p>
                </td>    
            </tr>
        </table>          
    <?php endforeach; ?>
</section>