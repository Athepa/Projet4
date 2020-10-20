    <article>
        <h2><?=$data['onepost']['titlePost']?></h2>
        <p><?=$data['onepost']['textPost']?></p>
        <hr>
        <form class="comments-form" method="post" action="http://localhost:8000/index.php?action=post&idPost=<?=$data['onepost']['idPost']?>">
            <input id="id-comment" type="hidden" name="id-comment"/>
            <input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudonyme" required/>
            <textarea id="comment" type="text" name="comment" placeholder="Votre commentaire" required></textarea>
            <input type="submit" id="send"/>
        </form>
        <hr>
        <?php foreach($data['comments'] as $comments): ?>
        <p><?=$comments['pseudoUser'].' '.'publié le'.' '. $comments['fr_creationDate']?></p>
        <p><?=$comments['commentText']?></p>
        <hr>
        <?php endforeach; ?>
        
    </article>
