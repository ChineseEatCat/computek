<?php

include 'header.php';

include 'testadmin.php';

$id = $_GET['id'] ?? null;

if (isset($_POST) && !empty($_POST) && $_POST['pass'] === $_POST['repass']) {
    // Hachage du mot de passe avec BCRYPT
    $hashedPassword = password_hash($_POST['pass'], PASSWORD_BCRYPT);

    $sql = 'UPDATE utilisateurs SET NOM = ?, PRENOM = ?, EMAIL = ?, PASSWORD = ?, ADMIN = ? WHERE ID = ?';
    $stmt = $db->prepare($sql);
    $stmt->execute([
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['email'],
        $hashedPassword,
        $_POST['role'],
        $id
    ]);

    // Redirection après modification
    header('Location: panel.php');
    exit;
}

if (!empty($_GET['id'])) {
    $sql = 'SELECT * FROM utilisateurs WHERE ID = :id';
    $stmt = $db->prepare($sql);
    $stmt->execute([':id' => $_GET['id']]);
    $infoUser = $stmt->fetch();
    ?>

    <form class="edituser" method="post" action="#">
		<h4>MODIFIER L'UTILISATEUR</h4>
		<hr>
		<div class="nom-prenom">
			<div>
				<label>Nom :</label>
				<input type="text" name="nom" value="<?= $infoUser['NOM'] ?>">
			</div>
			<div>
				<label>Prénom :</label>
				<input type="text" name="prenom" value="<?= $infoUser['PRENOM'] ?>">
			</div>
		</div>
		<label>E-mail :</label>
		<input type="email" name="email" value="<?= $infoUser['EMAIL'] ?>">
		<label>Mot de passe :</label>
		<input type="password" name="pass" value="<?= $infoUser['PASSWORD'] ?>">
		<label>Confirmation mot de passe :</label>
		<input type="password" name="repass" value="<?= $infoUser['PASSWORD'] ?>">
        <label for="role">Rôle :</label>
        <select name="role" class="choixRole">
            <option value="1" <?= $infoUser['ADMIN'] == '1' ? 'selected' : '' ?>>Admin</option>
            <option value="0" <?= $infoUser['ADMIN'] == '0' ? 'selected' : '' ?>>Utilisateur</option>
        </select>
		<input type="submit" value="Modifier">
	</form>

    <?php
}
?>













<?php

include 'footer.php';

?>