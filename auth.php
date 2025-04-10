<?php

include 'header.php';

if (isset($_POST['email'])) {
    $sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email';
    $stmt = $db->prepare($sql);
    $stmt->execute([':email' => $_POST['email']]);
    $resultat = $stmt->fetch();

    if ($resultat && password_verify($_POST['pass'], $resultat['PASSWORD'])) {
        $_SESSION['user'] = [
            'utilisateur' => $resultat['PRENOM'],
            'email' => $resultat['EMAIL'],
            'role' => ($resultat['ADMIN'] == 1 ? 'admin' : 'user')
        ];
        header('Location: user.php');
        exit;
    } else {
        $error = "*E-mail ou mot de passe incorrect*";
    }
}
?>

<main>
    <br>
    <div class="position-form">
        <form class="connexion" method="post" action="auth.php">
            <h4>CONNEXION</h4>
            <?php
            if (isset($error)) {
                echo "<p class='msg-error'>$error</p>";
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