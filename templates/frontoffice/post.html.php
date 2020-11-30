<article class="single-episode">
    <h2><?=$data['onepost']['titlePost']?></h2>
    <p class="the-episode"><?=$data['onepost']['textPost']?></p>
        
    <form class="comments-form" method="post" action="index.php?action=saveComment&idPost=<?=$data['onepost']['idPost']?>">            
        <p><input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudonyme" required/></p>
        <textarea id="comment" type="text" name="comment" placeholder="Votre commentaire" required></textarea>
        <p><input type="submit" id="send"/></p>
    </form>
        
    <?php foreach($data['comments'] as $comments): ?>
        <div class="single-comment">
            <p class="reader"><?='Publié par'.' '.$comments['pseudoUser'].' '.'le'.' '. $comments['fr_creationDate']?></p>
            <p class="comment-detail"><?=$comments['commentText']?></p>        
            <p class="report">
                <?php 
                    $reportValue = (int) $comments['report'];
                    if( $reportValue === 0)
                    {
                        echo '<a href="index.php?action=reportComment&idComment='.$comments['idComment'].' ">Signaler ce commentaire</a>';
                    } elseif( $reportValue === 1)
                    {
                        echo 'Ce commentaire a été signalé';
                    } elseif ( $reportValue === 2)
                    {
                        echo 'Ce commentaire a été validé';
                    }
                ?>    
            </p>
        </div>             
    <?php endforeach; ?>
        <p class="pagination">
            <?php 
            if($data['prevId']!==null)
            {
                echo'<a href="index.php?action=post&idPost='.$data['prevId'].' "> Episode précédent </a>';
            }

            if($data['nextId']!==null )
            {
                echo'<a href="index.php?action=post&idPost='.$data['nextId'].' "> Episode suivant </a>';
            }           
                
            ?>
        </p>           
</article>
