<?php

include 'header.php';

include 'testuser.php';

if (isset($_GET['deconnexion']) && $_GET['deconnexion'] === 'disconnect') {
    // Déconnexion : vider la session et rediriger
    session_destroy();
    header('Location: connexion.php');
    exit;
}

// Gestion des actions utilisateur (déconnexion ou suppression de compte)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['suppruser']) && $_POST['suppruser'] === 'supprimer') {
        // Suppression du compte
        $sql = 'DELETE FROM utilisateurs WHERE EMAIL = :email';
        $stmt = $db->prepare($sql);
        $stmt->execute([':email' => $_SESSION['user']['email'] ?? '']);
        session_destroy();
        header('Location: connexion.php');
        exit;
    }
}

// Récupération des informations utilisateur depuis la base
$email = $_SESSION['user']['email'] ?? '';
$sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email';
$stmt = $db->prepare($sql);
$stmt->execute([':email' => $email]);
$user = $stmt->fetch();

if (!$user) {
    // Si l'utilisateur n'existe pas, rediriger vers la page de connexion
    session_destroy();
    header('Location: connexion.php');
    exit;
}
?>

<main>
    <h1>Bonjour <?= htmlspecialchars($user['PRENOM'])?></h1>
    <div class="user-box">
        <h4>INFORMATION</h4>
        <hr>
        <div class="info-user">
            <div class="nom-prenom-user">
                <p>Nom : <?= $user['NOM'] ?></p>
                <p>Prénom : <?= $user['PRENOM'] ?></p>
                <p>Rôle : <?= ($user['ADMIN'] == 1 ? 'Administrateur' : 'Utilisateur') ?></p>
            </div>
            <p>Email : <?= $user['EMAIL'] ?></p>
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
            <form action="user.php" method="post">
                <input type="hidden" name="suppruser" value="supprimer">
                <button type="submit" class="suppr-user">Supprimer le compte</button>
            </form>
        </div>
    </div>
</main>



<?php
include 'footer.php';
?>