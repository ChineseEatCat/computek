<?php

include 'header.php';

include 'testuser.php';

$sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email AND PASSWORD = :password';
$stmt = $db->prepare($sql);
$stmt->execute([':email' => $_SESSION['user']['utilisateur'], ':password' => $_SESSION['user']['password']]);
$result = $stmt->fetch();


if ($result['PASSWORD'] == $_POST['oldpass'] && $_POST['newpass'] == $_POST['confirmation'] && !empty($_POST['newpass'])) {
    $sql = 'UPDATE utilisateurs SET PASSWORD = :password WHERE EMAIL = :email';
    $stmt = $db->prepare($sql);
    $stmt->execute([':password' => $_POST['newpass'], ':email' => $_SESSION['user']['utilisateur']]);
    $_SESSION['user']['password'] = $_POST['newpass'];
    echo "<script>Swal.fire({
        icon: 'success',
        title: 'Modification du mot de passe',
        text: 'Le mot de passe a été modifier avec succès.',
    }).then(function() {
        window.location.href = 'user.php';
    });</script>";
}

?>

<?php
if ($result['PASSWORD'] != $_POST['oldpass'] || $_POST['newpass'] != $_POST['confirmation'] || empty($_POST['newpass'])) {
?>
<div class="user-box">
    <h4>Modification du mot de passe</h4>
    <?php
    if ($result['PASSWORD'] != $_POST['oldpass'] || $_POST['newpass'] != $_POST['confirmation'] || empty($_POST['newpass'])) {
        echo "<p class='msg-error'>*Mot de passe ou nouveau mot de passe incorrect*</p>";
    }
    ?>
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
<?php
}
?>