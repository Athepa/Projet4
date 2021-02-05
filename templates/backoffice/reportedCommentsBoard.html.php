<section class="reported-comments-list">
<p class="reported-comments">Listes des commentaires signalés</p>
<table class="titles-reportedComments">
    <tr>
        <td>
            <p class="rprtd-cmt-cel-title">Commentaires signalés</p>
        </td>
        <td>
            <p class="post-id-cel-title">Episode</p>
        </td>
        <td>
            <p class="action-title">Que souhaitez-vous faire?</p>
        </td>
    </tr>
</table>    
    <?php foreach($data['comments'] as $comments) : ?>
        <table>
            <tr>
                <td class="rprtd-cmt-cel">
                    <p class="rported-cmt-date"><?='Publié par'.' '.$comments['pseudoUser'].' '.'le'.' '. $comments['fr_creationDate']?></p> 
                    <p class="rprted-cmt-txt"><?=$comments['commentText']?></p>
                </td>
                <td class="post-id-cel"> 
                    <p class="post-title"><?=$comments['postorder']?></p>
                </td>
                <td class="validate">
                    <p><a href="index.php?action=validateComment&idComment=<?=$comments['idComment']?>">Valider le commentaire</a></p>
                </td>
                <td class="delete-cmt">
                    <p><a href="index.php?action=deleteComment&idComment=<?=$comments['idComment']?>">Supprimer le commentaire</a></p>
                </td>
            </tr>
        </table>            
    <?php endforeach; ?>
    <p class="reportedComments-paging">
        <?php
            if($data['prevPage']!== null)
            {
                echo '<a href="index.php?action=reportedCommentsBoard&page='.$data['prevPage'].' ">Page précédente</a>';
            }

            if($data['nextPage']!== null)
            {
                echo '<a href="index.php?action=reportedCommentsBoard&page='.$data['nextPage'].' ">Page suivante</a>';
            }        
        
        ?>
    </p>
</section>    