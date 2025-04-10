<?php

include 'header.php';

include "testadmin.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['pass'], $_POST['repass'], $_POST['nom'], $_POST['prenom'])) {
        // Vérification si les mots de passe correspondent
        if ($_POST['pass'] !== $_POST['repass']) {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: 'Les mots de passe ne correspondent pas.'
                });
            </script>";
        } else {
            // Vérification si l'email existe déjà
            $sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email';
            $stmt = $db->prepare($sql);
            $stmt->execute([':email' => $_POST['email']]);
            $resultat = $stmt->fetch();

            if ($resultat) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Cet email est déjà utilisé.'
                    });
                </script>";
            } else {
                // Insertion de l'utilisateur
                $sql = 'INSERT INTO utilisateurs (NOM, PRENOM, EMAIL, PASSWORD) VALUES (:nom, :prenom, :email, :pass)';
                $stmt = $db->prepare($sql);
                $password = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                $stmt->execute([
                    ':nom' => $_POST['nom'],
                    ':prenom' => $_POST['prenom'],
                    ':email' => $_POST['email'],
                    ':pass' => $password
                ]);

                // Message de succès et redirection
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Création réussie',
                        text: 'Le compte a été créé avec succès !'
                    }).then(() => {
                        window.location.href = 'panel.php';
                    });
                </script>";
                exit;
            }
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: 'Veuillez remplir tous les champs.'
            });
        </script>";
    }
}

?>

<br>
<div class="position-form">
    <form class="inscription" method="post" action="adduser.php">
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