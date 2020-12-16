<section class="reported-comments-list">
<p class="reported-comments">Listes des commentaires signalés</p>

    <?php foreach($data['comments'] as $comments): ?>
        <table>
            <tr>
                <td class="rprtd-cmt-cel">
                    <p class="rported-cmt-date"><?='Publié par'.' '.$comments['pseudoUser'].' '.'le'.' '. $comments['fr_creationDate']?></p> 
                    <p class="rprted-cmt-txt"><?=$comments['commentText']?></p>
                </td>
                <td class="validate">
                    <p>Valider le commentaire</p>
                </td>
                <td class="delete-cmt">
                    <p>Modérer le commentaire</p>
                </td>
            </tr>
        </table>            
    <?php endforeach; ?>
</section>    