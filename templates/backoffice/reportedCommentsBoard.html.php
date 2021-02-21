<section class="reported-comments-list">
<p class="reported-comments">Listes des commentaires signalés</p>
<table class="titles-reportedComments">
    <tr>
        <td>
            <p class="rprtd-cmt-cel-title">Commentaires signalés</p>
        </td>
        <td>
            <p class="action-title">Que souhaitez-vous faire?</p>
        </td>
    </tr>
</table>    
    <?php foreach($data['comments'] as $comments) : ?>

        <div class="rprted-cmt-block">
            <div class="cmt-rprted"> 
                <p class="rprted-cmt-txt"><?=$comments['commentText']?></p>
                <p class="episode-nb">Episode n° <?=$comments['postorder']?></p>
            </div>            
            <div class="cmt-rprted-action">
                <p class="validate"><a href="index.php?action=validateComment&idComment=<?=$comments['idComment']?>">Valider le commentaire</a></p>
                <p class="delete-cmt"><a href="index.php?action=deleteComment&idComment=<?=$comments['idComment']?>">Supprimer le commentaire</a></p>
            </div>
        </div> 
                
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