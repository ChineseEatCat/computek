<?php

include 'header.php';

include 'testuser.php';

// Récupérer l'utilisateur depuis la base de données
$sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email';
$stmt = $db->prepare($sql);
$stmt->execute([':email' => $_SESSION['user']['email']]);
$user = $stmt->fetch();

// Vérifier si l'ancien mot de passe est correct et si les nouveaux mots de passe correspondent
if (password_verify($_POST['oldpass'], $user['PASSWORD']) && $_POST['newpass'] === $_POST['confirmation'] && !empty($_POST['newpass'])) {
    // Hacher le nouveau mot de passe avec bcrypt
    $hashedPassword = password_hash($_POST['newpass'], PASSWORD_BCRYPT);

    // Mettre à jour le mot de passe dans la base de données
    $sql = 'UPDATE utilisateurs SET PASSWORD = :password WHERE EMAIL = :email';
    $stmt = $db->prepare($sql);
    $stmt->execute([':password' => $hashedPassword, ':email' => $_SESSION['user']['email']]);

    // Mettre à jour la session utilisateur
    $_SESSION['user']['password'] = $hashedPassword;

    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Modification du mot de passe',
        text: 'Le mot de passe a été modifié avec succès.',
    }).then(function() {
        window.location.href = 'user.php';
    });</script>";
} else {
    // Si la vérification échoue, afficher un message d'erreur
    echo "<script>Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Ancien mot de passe incorrect ou les nouveaux mots de passe ne correspondent pas.',
    }).then(function() {
        window.location.href = 'modifpassword.php';
    });</script>";
}
?>

<div class="user-box">
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
</div>