    <article>
        <h2><?=$data['onepost']['titlePost']?></h2>
        <p><?=$data['onepost']['textPost']?></p>
        <?php foreach($data['comments'] as $comments): ?>
        <p><?=$comments['pseudoUser'].' '.'publié le'.' '. $comments['fr_creationDate']?></p>
        <p><?=$comments['commentText']?></p>
        <hr>
        <?php endforeach; ?>
        <form class="comments-form" method="post" action="" >
            <input id="pseudo" type="text" name="pseudo" placeholder="Votre pseudonyme"/>
            <textarea id="comment" type="text" name="comment" placeholder="Votre commentaire"></textarea>
            <input type="submit" id="send"/>

        </form>
    </article>
