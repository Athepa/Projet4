<form class="author-connection" method="POST" action="">
    <input id="token-control" type="hidden" name="token-control" value="<?=$data['token']?>" />
    <input id="pseudo-author" type="text" name="pseudo-author" placeholder="Veuillez saisir votre identifiant" required/>
    <input id="pwd-author" type="password" name="pwd-author" placeholder="Veuillez saisir votre mot de passe" required/>
    <p class="alert-connection"><?= $data['errorMessage'] ?></p>
    <input id="sbmt-author-connect" type="submit"/> 
</form>

