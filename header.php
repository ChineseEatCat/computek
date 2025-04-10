<?php
session_start(); // Activer les sessions
$totalQuantite = 0;

include 'config/bdd.php';

if (!empty($_SESSION['user'])) {
    $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE EMAIL = ?');
    $stmt->execute([$_SESSION['user']['email']]);
    $user = $stmt->fetch();

    // Met à jour le rôle en fonction de la valeur de ADMIN (1 pour admin, sinon user)
    $_SESSION['user']['role'] = (isset($user['ADMIN']) && $user['ADMIN'] == 1) ? 'admin' : 'user';
}

// Calculer le nombre total d'articles dans le panier
if (isset($_SESSION['panier'])) {
	$totalQuantite = array_sum(array_column($_SESSION['panier'], 'quantite'));
}
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>CompuTek</title>
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/menu.css">
	<link rel="stylesheet" href="css/panier.css">
	<link rel="stylesheet" href="css/footer.css">
	<link rel="stylesheet" href="css/form.css">
	<link rel="stylesheet" href="css/user.css">
	<link rel="stylesheet" href="css/panel.css">
	<link rel="shortcut icon" href="logo.png" type="image/x-icon">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<header>
		<div class="nav">
			<nav>
				<ul>
					<li><a href="index.php">Accueil</a></li>
					<li><a href="categories.php">Produits</a></li>
					<li><a href="apropos.php">A propos</a></li>
					<li><a href="panier.php">Panier <span class="panier" id="cart-count"><?= isset($_SESSION['panier']) ? array_sum(array_column($_SESSION['panier'], 'quantite')) : 0 ?></span></a></li>
					<li class="dropdown">
						<?php if (isset($_SESSION['user']) && !empty($_SESSION['user'])) : ?>
							<a href="user.php" class="dropbtn"><?= htmlspecialchars($_SESSION['user']['utilisateur'] ?? 'Utilisateur'); ?></a>
							<div class="dropdown-content">
								<a href="user.php">Mon Profil</a>
								<?php if (($_SESSION['user']['role'] ?? '') === "admin") : ?>
									<a href="panel.php">Panel d'administration</a>
								<?php endif; ?>
								<a href="user.php?deconnexion=disconnect">Déconnexion</a>
							</div>
						<?php else : ?>
							<a href="connexion.php">Connexion</a>
						<?php endif; ?>
					</li>
				</ul>
			</nav>
		</div>

		<?php if (isset($_SESSION['user']) && !empty($_SESSION['user']) && $_SESSION['user']['role'] == "admin") : ?>
			<div class="nav admin">
				<nav>
					<ul>
						<li><a href="addproduits.php">Ajouter un produit</a></li>
						<li><a href="addcategories.php">Ajouter une catégorie</a></li>
					</ul>
				</nav>
			</div>
		<?php endif; ?>

	</header>