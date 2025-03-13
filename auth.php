<?php

include 'header.php';

include 'config/bdd.php';

if (isset($_POST['email'])) {
    $stmt = $db->query('SELECT * FROM utilisateurs WHERE EMAIL = "' . $_POST['email'] . '" AND PASSWORD = "' . $_POST['pass'] . '"');
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
                header('Location: user.php');
            } else {
                echo "<p id='msg-error'>*E-mail ou mot de passe incorrect*</p>";
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