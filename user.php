<?php

include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['deconnexion']) && $_POST['deconnexion'] === 'disconnect') {
    // Se deconnecter
    $_SESSION['user'] = [];

    header('Location: connexion.php');
}

?>

<main>
    <h1>Utilisateur</h1>
    <div class="user-box">
        <div class="menu-user">
            <ul>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
        <form action="user.php" method="post" style="margin-top: 20px;">
            <input type="hidden" name="deconnexion" value="disconnect">
            <button type="submit">Déconnexion</button>
        </form>
    </div>
</main>



<?php
include 'footer.php';
?>