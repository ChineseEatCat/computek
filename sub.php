<?php

include 'header.php';

include 'config/bdd.php';

var_dump($_POST);

if (isset($_POST['email'])) {
    $sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email';
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $_POST['email']]);
    $resultat = $stmt->fetch();
}

if ($_POST['pass'] == $_POST['repass']) {
    echo 'ok';
} else {
    echo 'non';
}

if ($_POST['pass'] == $_POST['repass'] && $resultat == false) {
    $sql = 'INSERT INTO utilisateurs (NOM, PRENOM, EMAIL, PASSWORD) VALUES (:nom, :prenom, :email, :pass)';
    $stmt = $db->prepare($sql);
    $stmt->execute([':nom' => $_POST['nom'], ':prenom' => $_POST['prenom'], ':email' => $_POST['email'], ':pass' => $_POST['pass']]);
    $_SESSION['user'] = ['utilisateur' => $_POST['email'], 'password' => $_POST['pass'], 'role' => ($resultat['ADMIN'] == 1 ? 'admin' : 'user')];
    header('Location: user.php');
}

?>

<br>
<div class="position-form">
    <form class="inscription" method="post" action="sub.php">
        <h4>INSCRIPTION</h4>
        <hr>
        <div class="nom-prenom">
            <div>
                <label>Nom :</label>
                <input type="text"  name="nom" value="<?= (isset($_POST['nom']) ? $_POST['nom'] : '') ?>">
            </div>
            <div>
                <label>Prénom :</label>
                <input type="text"  name="prenom" value="<?= (isset($_POST['prenom']) ? $_POST['prenom'] : '') ?>">
            </div>
        </div>
        <label>E-mail :</label>
        <input type="email" name="email" value="<?= (isset($_POST['email']) && $resultat == false ? $_POST['email'] : 'error') ?>">
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