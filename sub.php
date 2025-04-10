<?php

include 'header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['email']) && !empty($_POST['pass']) && !empty($_POST['repass']) && !empty($_POST['nom']) && !empty($_POST['prenom'])) {
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

                // Création de la session utilisateur
                $_SESSION['user'] = [
                    'utilisateur' => $_POST['prenom'],
                    'email' => $_POST['email'],
                    'role' => 'user' // Par défaut, rôle utilisateur
                ];

                // Message de succès et redirection
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Inscription réussie',
                        text: 'Votre compte a été créé avec succès !'
                    }).then(() => {
                        window.location.href = 'user.php';
                    });
                </script>";
                exit;
            }
        }
    } else {
        // Message d'erreur si des champs sont vides
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
        <input type="email" name="email" value="<?php 
                                                $sql = 'SELECT * FROM utilisateurs WHERE EMAIL = :email';
                                                $stmt = $db->prepare($sql);
                                                $stmt->execute([':email' => $_POST['email']]);
                                                $verif = $stmt->fetch();

                                                if (isset($_POST['email']) && $verif == false) {
                                                    echo $_POST['email'];
                                                }

                                                ?>">
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