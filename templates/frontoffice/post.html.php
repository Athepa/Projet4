    <article>
        <h2><?=$data['onepost']['titlePost']?></h2>
        <p><?=$data['onepost']['textPost']?></p>
        <?php foreach($data['comments'] as $comments): ?>
        <p><?=$comments['pseudoUser'].' '.'publié le'.' '. $comments['fr_creationDate']?></p>
        <p><?=$post['commentText']?></p>
        <hr>
        <?php endforeach; ?>
    </article>
