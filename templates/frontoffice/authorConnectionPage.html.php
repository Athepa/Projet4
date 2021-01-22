<form class="author-connection" method="POST" action="">
    <input id="pseudo-author" type="text" name="pseudo-author" placeholder="Veuillez saisir votre identifiant" required/>
    <input id="pwd-author" type="password" name="pwd-author" placeholder="Veuillez saisir votre mot de passe" required/>
    <p class="alert"><?php $alert ?></p>
    <input id="sbmt-author-connect" type="submit"/> 
</form>
/*php $session->getError 
if ($session->getError){
    afficher session get error*/