<section class="posts-list">
    <h2>Billet simple pour l'Alaska</h2>
    <p class="episode">Les épisodes</p>
    
    <?php foreach($data['allposts'] as $post): ?>    
        <h3 class="post-title"><?=$post['titlePost']?></h3>
        <p class="publication-date">Publié le <?=$post['fr_creationDate']?></p>
        <p class="post-text-sample"><?=$post['textPost']?></p>
        <button class="post-link"><a  href="index.php?action=post&idPost=<?=$post['idPost']?>">Lire l'épisode</a></button>
            
    <?php endforeach; ?>
</section>