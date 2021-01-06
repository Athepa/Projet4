<section class="add-episode">
    <h3>Modification épisode</h3>

    <form class="post-form" method="POST" action="http://index.php?action=updatedPost&idPost=<?=$data['postToUpdate']['idPost']?>">          
        <input id="title-post" type="text" name="title-post" value="<?=$data['postToUpdate']['titlePost']?>" required/>
        <input id="post-order" type="number" name="post-order" value="<?=$data['postToUpdate']['postorder']?>" required/>
        <textarea id="text-post" type="text" name="text-post" value="<?=$data['postToUpdate']['textPost']?>" ></textarea>
        <input type="submit" id="send" value="Enregistrer"/>
    </form>
    
</section>