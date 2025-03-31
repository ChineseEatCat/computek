<?php

include 'header.php';

if (isset($_POST['email'])) {
    $sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email AND PASSWORD = :pass';
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $_POST['email'], ':pass' => $_POST['pass']]);
    $resultat = $stmt->fetch();
}

?>

<main>
    <br>
    <div class="position-form">
        <form class="connexion" method="post" action="auth.php">
            <h4>CONNEXION</h4>
            <?php
            if (isset($_POST['email']) && $resultat == true) {
                $_SESSION['user'] = ['utilisateur' => $_POST['email'], 'password' => $_POST['pass'], 'role' => ($resultat['ADMIN'] == 1 ? 'admin' : 'user')];
                header('Location: user.php');
            } else {
                echo "<p class='msg-error'>*E-mail ou mot de passe incorrect*</p>";
            }
            ?>
            <hr>
            <label for="email">E-mail :</label>
            <input type="email" id="email" name="email" value="<?= (isset($_POST['email']) ? $_POST['email'] : '') ?>">
            <label for="mdp">Mot de passe :</label>
            <input type="password" id="mdp" name="pass">
            <input type="submit" value="Connexion">
        </form>
    </div>
</main>

<?php
include 'footer.php'
?>