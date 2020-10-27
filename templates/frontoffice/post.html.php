    <article>
        <h2><?=$data['onepost']['titlePost']?></h2>
        <p><?=$data['onepost']['textPost']?></p>
        <hr>
        <form class="comments-form" method="post" action="index.php?action=saveComment&idPost=<?=$data['onepost']['idPost']?>">            
            <p><input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudonyme" required/></p>
            <textarea id="comment" type="text" name="comment" placeholder="Votre commentaire" required></textarea>
            <p><input type="submit" id="send"/></p>
        </form>
        <hr>
        <?php foreach($data['comments'] as $comments): ?>
        <p><?=$comments['pseudoUser'].' '.'publié le'.' '. $comments['fr_creationDate']?></p>
        <p><?=$comments['commentText']?></p>
        <p class="report">Signaler ce commentaire</p>
        <hr>
        <?php endforeach; ?>
        
    </article>
