<section class="add-episode">
    <h3>Modification épisode</h3>

    <form class="post-form" method="POST" action="index.php?action=updatedPendingPost&idPost=<?=$data['postToUpdate']['idPost']?>">          
        <input id="title-postupdate" type="text" name="title-postupdate" value="<?=$data['postToUpdate']['titlePost']?>" required/>
        <input id="postupdate-order" type="number" name="postupdate-order" value="<?=$data['postToUpdate']['postorder']?>" required/>
        <textarea id="text-postupdate" type="text" name="text-postupdate"><?=$data['postToUpdate']['textPost']?></textarea>
        <input type="submit" id="send" value="Enregistrer"/>
    </form>
</section>