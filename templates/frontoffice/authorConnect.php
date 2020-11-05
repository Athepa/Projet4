<form class="author-connection" method="post" action="index.php?action=authorConnect&idAuthor=<?=$data['idAuthor']?>">
    <input id="peuso-author" type="text" name="pseudo-author" placeholder="Votre pseudonyme" required/>
    <input id="pwd-author" type="password" name="pwd-author" placeholder="Votre mot de passe" required/>
    <input id="sbmt-author-connect" type="submit"/> 
</form>