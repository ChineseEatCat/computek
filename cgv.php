<!-- DEBUT header.php (puis remplacer par un include de header.php) -->
<?php
include 'header.php';
?>
<!-- FIN header.php (remplacé par un include de header.php) -->
<style>
	/* Style général */
	body {
		font-family: Arial, sans-serif;
		line-height: 1.6;
		margin: 0;
		padding: 0;
		background-color: #f9f9f9;
		color: #333;
	}

	/* Conteneur principal */
	main {
		max-width: 800px;
		margin: 20px auto;
		padding: 20px;
		background-color: #fff;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		border-radius: 8px;
	}

	/* Titres principaux */
	h1 {
		font-size: 2em;
		color: #0056b3;
		text-align: center;
		margin-bottom: 20px;
	}

	/* Sous-titres */
	h3 {
		font-size: 1.5em;
		color: #333;
		margin-top: 20px;
		border-bottom: 2px solid #0056b3;
		padding-bottom: 5px;
	}

	/* Paragraphes */
	p {
		font-size: 1em;
		margin: 10px 0;
		text-align: justify;
	}

	/* Liens */
	a {
		color: #0056b3;
		text-decoration: none;
	}

	a:hover {
		text-decoration: underline;
	}

	/* Liste */
	ul {
		margin: 10px 0;
		padding-left: 20px;
	}

	li {
		margin-bottom: 5px;
	}

	/* Boutons (si nécessaire) */
	button {
		background-color: #0056b3;
		color: #fff;
		border: none;
		padding: 10px 15px;
		border-radius: 5px;
		cursor: pointer;
		font-size: 1em;
	}

	button:hover {
		background-color: #003d80;
	}

	/* Responsive */
	@media (max-width: 768px) {
		main {
			padding: 15px;
		}

		h1 {
			font-size: 1.8em;
		}

		h3 {
			font-size: 1.3em;
		}

		p {
			font-size: 0.95em;
		}
	}
</style>
<!-- DEBUT CONTENU DE LA PAGE -->
<main>
	<article>
		<h1>Conditions Générales de Vente (CGV)</h1>

		<h3>1. Objet</h3>
		<p>
			Les présentes conditions générales de vente (CGV) régissent les relations contractuelles entre la société Computek
			et tout client effectuant un achat sur le site. Toute commande passée sur le site implique l'acceptation sans réserve
			des présentes CGV.
		</p>

		<h3>2. Produits et services</h3>
		<p>
			Computek propose des produits et services liés à l'informatique. Les descriptions, caractéristiques et prix des
			produits sont disponibles sur le site. Les photographies des produits sont non contractuelles.
		</p>

		<h3>3. Commandes</h3>
		<p>
			Les commandes sont effectuées en ligne via le site. Une fois la commande validée, un email de confirmation est envoyé
			au client. Computek se réserve le droit d'annuler ou de refuser toute commande en cas de litige avec le client.
		</p>

		<h3>4. Prix et paiement</h3>
		<p>
			Les prix affichés sur le site sont en euros (€) et incluent toutes les taxes (TTC). Les frais de livraison sont
			indiqués avant la validation de la commande. Le paiement s'effectue en ligne via les moyens de paiement sécurisés
			proposés sur le site.
		</p>

		<h3>5. Livraison</h3>
		<p>
			Les produits sont livrés à l'adresse indiquée par le client lors de la commande. Computek s'engage à expédier les
			produits dans les délais indiqués, mais ne pourra être tenu responsable des retards dus à des circonstances
			indépendantes de sa volonté (grèves, intempéries, etc.).
		</p>

		<h3>6. Droit de rétractation</h3>
		<p>
			Conformément à la législation en vigueur, le client dispose d'un délai de 14 jours à compter de la réception des
			produits pour exercer son droit de rétractation. Les produits doivent être retournés dans leur état d'origine, et les
			frais de retour sont à la charge du client.
		</p>

		<h3>7. Garantie</h3>
		<p>
			Les produits bénéficient de la garantie légale de conformité et de la garantie contre les vices cachés. En cas de
			problème, le client doit contacter le service client de Computek à l'adresse email :
			<a href="mailto:support@computek.fr">support@computek.fr</a>.
		</p>

		<h3>8. Responsabilité</h3>
		<p>
			Computek ne pourra être tenu responsable des dommages indirects résultant de l'utilisation des produits vendus. La
			responsabilité de Computek est limitée au montant de la commande.
		</p>

		<h3>9. Données personnelles</h3>
		<p>
			Les données personnelles collectées lors des commandes sont utilisées uniquement pour la gestion des commandes et
			le suivi client. Conformément au RGPD, le client dispose d'un droit d'accès, de rectification et de suppression de
			ses données personnelles en contactant : <a href="mailto:privacy@computek.fr">privacy@computek.fr</a>.
		</p>

		<h3>10. Litiges</h3>
		<p>
			En cas de litige, une solution amiable sera recherchée avant toute action judiciaire. À défaut, les tribunaux
			compétents seront ceux du ressort du siège social de Computek.
		</p>
	</article>
</main>
<!-- FIN CONTENU DE LA PAGE -->

<!-- DEBUT footer.php (puis remplacer par un include de footer.php) -->
<?php
include 'footer.php';
?>
<!-- FIN footer.php (remplacé par un include de footer.php) -->