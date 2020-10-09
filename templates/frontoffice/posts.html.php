<h2>Tous les posts</h2>
<hr>
<?php foreach($data['allposts'] as $post): ?>
<p><?=$post['titlePost'].' '.'publié le'.' '. $post['fr_creationDate']?></p>
<p><?=$post['textPost']?></p>
<a href="index.php?action=post&idPost=<?=$post['idPost']?>">Lire le post</a>
<hr>
<?php endforeach; ?>