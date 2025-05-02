<?php
include 'header.php';

$sorties = $db->prepare('SELECT * FROM produits ORDER BY ID DESC LIMIT 3');
$sorties->execute();
?>

<main>

	<h1>Nos Recommandations</h1>
	<div class="categories">
		<?php
		$recommandation1 = $db->prepare('SELECT * FROM produits WHERE ID = 1');
		$recommandation1->execute();
		$recommandation1 = $recommandation1->fetch();

		$recommandation2 = $db->prepare('SELECT * FROM produits WHERE ID = 2');
		$recommandation2->execute();
		$recommandation2 = $recommandation2->fetch();

		$recommandation3 = $db->prepare('SELECT * FROM produits WHERE ID = 3');
		$recommandation3->execute();
		$recommandation3 = $recommandation3->fetch();

		?>

		<div class="produits">
			<img class="produit-img" src="<?= $recommandation1['IMAGE'] ?>">
			<div>
				<p><?= $recommandation1['MARQUE'] . " " . $recommandation1['MODEL'] ?></p>
				<div class="caracteristiques">
					<ul>
						<?php
						$caracteristiques = json_decode($recommandation1['DESCRIPTION'], true); // Décodage en tableau associatif
						if (!empty($caracteristiques)) {
							foreach ($caracteristiques as $key => $value) : ?>
								<li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
							<?php endforeach;
						} else { ?>
							<li>Aucune caractéristique disponible</li>
						<?php } ?>
					</ul>
				</div>
				<p><?= $recommandation1['PRIX'] ?>€</p>
				<form action="panier.php" method="post">
					<input type="hidden" name="id" value="<?= $recommandation1['ID'] ?>">
					<input type="hidden" name="marque" value="<?= htmlspecialchars($recommandation1['MARQUE']) ?>">
					<input type="hidden" name="model" value="<?= htmlspecialchars($recommandation1['MODEL']) ?>">
					<input type="hidden" name="prix" value="<?= $recommandation1['PRIX'] ?>">
					<input type="hidden" name="image" value="<?= $recommandation1['IMAGE'] ?>">
					<button type="submit" class="cart"><span><i class="bi bi-cart"></i></span> Ajouter au panier</button>
				</form>
			</div>
		</div>

		<div class="produits">
			<img class="produit-img" src="<?= $recommandation2['IMAGE'] ?>">
			<div>
				<p><?= $recommandation2['MARQUE'] . " " . $recommandation2['MODEL'] ?></p>
				<div class="caracteristiques">
					<ul>
						<?php
						$caracteristiques = json_decode($recommandation2['DESCRIPTION'], true); // Décodage en tableau associatif
						if (!empty($caracteristiques)) {
							foreach ($caracteristiques as $key => $value) : ?>
								<li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
							<?php endforeach;
						} else { ?>
							<li>Aucune caractéristique disponible</li>
						<?php } ?>
					</ul>
				</div>
				<p><?= $recommandation2['PRIX'] ?>€</p>
				<form action="panier.php" method="post">
					<input type="hidden" name="id" value="<?= $recommandation2['ID'] ?>">
					<input type="hidden" name="marque" value="<?= htmlspecialchars($recommandation2['MARQUE']) ?>">
					<input type="hidden" name="model" value="<?= htmlspecialchars($recommandation2['MODEL']) ?>">
					<input type="hidden" name="prix" value="<?= $recommandation2['PRIX'] ?>">
					<input type="hidden" name="image" value="<?= $recommandation2['IMAGE'] ?>">
					<button type="submit" class="cart"><span><i class="bi bi-cart"></i></span> Ajouter au panier</button>
				</form>
			</div>
		</div>

		<div class="produits">
			<img class="produit-img" src="<?= $recommandation3['IMAGE'] ?>">
			<div>
				<p><?= $recommandation3['MARQUE'] . " " . $recommandation3['MODEL'] ?></p>
					<div class="caracteristiques">
						<ul>
							<?php
							$caracteristiques = json_decode($recommandation3['DESCRIPTION'], true); // Décodage en tableau associatif
							if (!empty($caracteristiques)) {
								foreach ($caracteristiques as $key => $value) : ?>
									<li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
								<?php endforeach;
							} else { ?>
								<li>Aucune caractéristique disponible</li>
							<?php } ?>
						</ul>
					</div>
					<p><?= $recommandation3['PRIX'] ?>€</p>
					<form action="panier.php" method="post">
						<input type="hidden" name="id" value="<?= $recommandation3['ID'] ?>">
						<input type="hidden" name="marque" value="<?= htmlspecialchars($recommandation3['MARQUE']) ?>">
						<input type="hidden" name="model" value="<?= htmlspecialchars($recommandation3['MODEL']) ?>">
						<input type="hidden" name="prix" value="<?= $recommandation3['PRIX'] ?>">
						<input type="hidden" name="image" value="<?= $recommandation3['IMAGE'] ?>">
						<button type="submit" class="cart"><span><i class="bi bi-cart"></i></span> Ajouter au panier</button>
					</form>
			</div>
		</div>
	</div>
	<br>

	<h1>Dernières sorties</h1>
	<div class="categories" style="max-width: 60%;">
		<?php
		foreach ($sorties as $k => $produit) : ?>
			<div class="produits">
				<img class="produit-img" src="<?= $produit['IMAGE'] ?>" alt="">
				<div>
					<p><?= $produit['MARQUE'] . " " . $produit['MODEL'] ?></p>
					<div class="caracteristiques">
						<ul>
							<?php
							$caracteristiques = json_decode($produit['DESCRIPTION'], true); // Décodage en tableau associatif
							if (!empty($caracteristiques)) {
								foreach ($caracteristiques as $key => $value) : ?>
									<li><strong><?= htmlspecialchars($key) ?>:</strong> <?= htmlspecialchars($value) ?></li>
								<?php endforeach;
							} else { ?>
								<li>Aucune caractéristique disponible</li>
							<?php } ?>
						</ul>
					</div>
					<p><?= $produit['PRIX'] ?>€</p>
					<form action="panier.php" method="post">
						<input type="hidden" name="id" value="<?= $produit['ID'] ?>">
						<input type="hidden" name="marque" value="<?= htmlspecialchars($produit['MARQUE']) ?>">
						<input type="hidden" name="model" value="<?= htmlspecialchars($produit['MODEL']) ?>">
						<input type="hidden" name="prix" value="<?= $produit['PRIX'] ?>">
						<input type="hidden" name="image" value="<?= $produit['IMAGE'] ?>">
						<button type="submit" class="cart"><span><i class="bi bi-cart"></i></span> Ajouter au panier</button>
					</form>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

</main>

<?php
include 'footer.php';
?>