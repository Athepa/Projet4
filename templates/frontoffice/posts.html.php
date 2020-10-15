<h2>Billet simple pour l'Alaska</h2>
<p>Les épisodes</p>
<hr>
<?php foreach($data['allposts'] as $post): ?>
<h3 class="post-title"><?=$post['titlePost']?></h3>
<p class="date-publication">Publié le <?=$post['fr_creationDate']?></p>
<p class="post-text-sample"><?=$post['textPost']?></p>
<a class="post-link" href="index.php?action=post&idPost=<?=$post['idPost']?>">Lire le post</a>
<hr>
<?php endforeach; ?>