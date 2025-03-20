<?php
session_start(); // Activer les sessions
$totalQuantite = 0;

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
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href="index.php">Accueil</a></li>
				<li><a href="categories.php">Produits</a></li>
				<li><a href="apropos.php">A propos</a></li>
				<li><a href="panier.php">Panier <span class="panier" id="cart-count"><?= isset($_SESSION['panier']) ? array_sum(array_column($_SESSION['panier'], 'quantite')) : 0 ?></span></a></li>
				<!--<li><a href="panier.php">Panier</a></li>-->
				<li><a href="connexion.php">Connexion</a></li>
			</ul>
		</nav>
	</header>