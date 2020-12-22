<section class="posts-list">
    
    <p class="episodes-list">Listes des épisodes en attente de publication</p>
        
    <?php foreach($data['allposts'] as $post): ?> 
        <table>
            <tr>
                <td class="episode-title">   
                    <p ><?=$post['titlePost']?></p>
                </td>
                <td class="read">
                    <p><a href="index.php?action=post&idPost=<?=$post['idPost']?>"> Publier</a></p>
                </td>
                <td class="update">
                    <p>Modifier</p>
                </td>
                <td class="delete">
                    <p><a href="index.php?action=deletePost">Supprimer</a></p>
                </td>    
            </tr>
        </table>          
    <?php endforeach; ?>
</section>