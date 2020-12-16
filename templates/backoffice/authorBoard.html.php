<section class="posts-list">
    <h2>Jean Forteroche, bienvenue sur votre tableau de bord</h2>
    <p class="episodes-list">Listes des épisodes publiés</p>
    <p class="create"><a href="index.php?action=authorAddPost"><i class="fas fa-plus-circle"></i><span>Ajouter un épisode</span></a></p>
    
    <?php foreach($data['allposts'] as $post): ?> 
        <table>
            <tr>
                <td class="episode-title">   
                    <p ><?=$post['titlePost']?></p>
                </td>
                <td class="read">
                    <p>Consulter</p>
                </td>
                <td class="update">
                    <p>Modifier</p>
                </td>
                <td class="delete">
                    <p>Supprimer</p>
                </td>    
            </tr>
        </table>          
    <?php endforeach; ?>
</section>