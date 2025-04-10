<?php

include 'header.php';

?>

<br>
<div class="position-form">
    <form class="inscription" method="post" action="sub.php">
        <h4>INSCRIPTION</h4>
        <hr>
        <div class="nom-prenom">
            <div>
                <label>Nom :</label>
                <input type="text"  name="nom" value="">
            </div>
            <div>
                <label>Prénom :</label>
                <input type="text"  name="prenom" value="">
            </div>
        </div>
        <label>E-mail :</label>
        <input type="email" name="email" value="">
        <label>Mot de passe :</label>
        <input type="password" name="pass">
        <label>Confirmation mot de passe :</label>
        <input type="password" name="repass">
        <input type="submit" value="S'inscrire">

    </form>
</div>

<?php
include 'footer.php'
?>