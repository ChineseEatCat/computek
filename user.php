<?php

include 'header.php';

include 'testuser.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deconnexion']) && $_POST['deconnexion'] === 'disconnect') {
    // Se deconnecter
    $_SESSION['user'] = [];

    header('Location: connexion.php');
}

$sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email AND PASSWORD = :password';
$stmt = $db->prepare($sql);
$stmt->execute([':email' => $_SESSION['user']['utilisateur'], ':password' => $_SESSION['user']['password']]);
$resultat = $stmt->fetch();

?>

<main>
    <h1>Utilisateur</h1>
    <div class="user-box">
        <h4>INFORMATION</h4>
        <hr>
        <div class="info-user">
            <div class="nom-prenom-user">
                <p>Nom : <?= $resultat['NOM'] ?></p>
                <p>Prénom : <?= $resultat['PRENOM'] ?></p>
                <p>Rôle : <?= ($resultat['ADMIN'] == 1 ? 'Administrateur' : 'Utilisateur') ?></p>
            </div>
            <p>Email : <?= $resultat['EMAIL'] ?></p>
        </div>
        <h4>Modification du mot de passe</h4>
        <hr>
        <div class="info-user">
            <form class="modif-password" method="post" action="modifpassword.php">
                <label for="mdp">Ancien mot de pass :</label>
                <input type="password" id="mdp" name="oldpass">
                <label for="mdp">Nouveau mot de passe :</label>
                <input type="password" id="mdp" name="newpass">
                <label for="mdp">Comfirmation :</label>
                <input type="password" id="mdp" name="confirmation">
                <input type="submit" value="Modifier">
            </form>
        </div>
        <div class="button-user">
            <form action="user.php" method="post">
                <input type="hidden" name="deconnexion" value="disconnect">
                <button type="submit" class="disconnect">Déconnexion</button>
            </form>
            <form action="suppruser.php" method="post">
                <input type="hidden" name="suppruser" value="supprimer">
                <button type="submit" class="suppr-user">Supprimer le compte</button>
            </form>
        </div>
    </div>
</main>



<?php
include 'footer.php';
?>