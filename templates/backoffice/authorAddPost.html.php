<section class="add-episode">
    <h3>Ajout d'un nouvel épisode</h3>

    <form class="post-form" method="post" action="index.php?action=savePost&idAuthor=">           
        <input id="title-post" type="text" name="title-post" placeholder="Le titre de l'épisode" required/>
        <input id="post-order" type="number" name="post-order" placeholder="Le numéro de l'épisode" required/>
        <textarea id="text-post" type="text" name="text-post" placeholder="Le texte de l'épisode" required></textarea>
        <input type="submit" id="send"/>
    </form>
</section>