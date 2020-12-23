<section class="add-episode">
    <h3>Modification épisode</h3>

    <form class="post-form" method="post" action="http://index.php?action=updatedPost&idPost=<?=$data['postToUpdate']['idPost']?>">          
        <input id="title-post" type="text" name="title-post" value =<?=$data['postToUpdate']['titlePost']?> placeholder="Le titre de l'épisode" required/>
        <input id="post-order" type="number" name="post-order" value =<?=$data['postToUpdate']['postorder']?> placeholder="Le numéro de l'épisode" required/>
        <textarea id="text-post" type="text" name="text-post" value =<?=$data['postToUpdate']['textPost']?> placeholder="Le texte de l'épisode" required></textarea>
        <input type="submit" id="send"/>
    </form>
</section>