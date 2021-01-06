<section class="posts-list">
    <h2>Billet simple pour l'Alaska</h2>
    <p class="episode">Les épisodes</p>
    
    <?php foreach($data['allposts'] as $post): ?>    
        <h3 class="post-title"><a href="index.php?action=post&idPost=<?=$post['idPost']?>"><?=$post['titlePost']?></a></h3>
        <p class="publication-date">Publié le <?=$post['fr_creationDate']?></p>
        <div class="post-text-sample"><?=$post['textPost']?></div>
        <button class="post-link"><a  href="index.php?action=post&idPost=<?=$post['idPost']?>">Lire l'épisode</a></button>            
    <?php endforeach; ?>
    <p class="posts-paging">
        <?php
            if($data['prevPage']!== null)
            {
                echo '<a href="index.php?action=posts&page='.$data['prevPage'].' ">Page précédente</a>';
            }

            if($data['nextPage']!== null)
            {
                echo '<a href="index.php?action=posts&page='.$data['nextPage'].' ">Page suivante</a>';
            }        
        
        ?>
    </p>
</section>