<!-- DEBUT header.php (puis remplacer par un include de header.php) -->
<?php
include 'header.php'
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
		max-width: 900px;
		margin: 20px auto;
		padding: 20px;
		background-color: #fff;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		border-radius: 8px;
	}

	/* Titres principaux */
	h1 {
		font-size: 2.5em;
		color: #0056b3;
		text-align: center;
		margin-bottom: 20px;
	}

	/* Sous-titres */
	h3 {
		font-size: 1.8em;
		color: #333;
		margin-top: 20px;
		border-bottom: 2px solid #0056b3;
		padding-bottom: 5px;
	}

	/* Paragraphes */
	p {
		font-size: 1.1em;
		margin: 10px 0;
		text-align: justify;
	}

	/* Listes */
	ul {
		margin: 10px 0;
		padding-left: 20px;
	}

	li {
		margin-bottom: 8px;
		font-size: 1.1em;
	}

	/* Liens */
	a {
		color: #0056b3;
		text-decoration: none;
	}

	a:hover {
		text-decoration: underline;
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
			font-size: 2em;
		}

		h3 {
			font-size: 1.5em;
		}

		p {
			font-size: 1em;
		}

		li {
			font-size: 1em;
		}
	}
</style>
<!-- DEBUT CONTENU DE LA PAGE -->
<main>
	<article>
		<div class="apropos">
			<h1>À propos de Computek</h1>

			<h3>Qui sommes-nous ?</h3>
			<p>
				Computek est une entreprise spécialisée dans la vente de matériel informatique. Nous proposons une large gamme
				de produits pour répondre aux besoins des particuliers comme des professionnels. Notre objectif est de fournir
				des solutions technologiques fiables et performantes pour accompagner nos clients dans leurs projets.
			</p>

			<h3>Nos produits</h3>
			<p>
				Nous offrons une sélection complète de matériel informatique, incluant :
			</p>
			<ul>
				<li>Ordinateurs de bureau et portables</li>
				<li>Cartes graphiques (GPU)</li>
				<li>Processeurs (CPU)</li>
				<li>Cartes mères</li>
				<li>Mémoires vives (RAM)</li>
				<li>Stockage (disques durs, SSD)</li>
			</ul>

			<h3>Notre mission</h3>
			<p>
				Chez Computek, nous croyons en la puissance de la technologie pour améliorer la vie quotidienne et booster
				la productivité. Notre mission est de rendre les technologies de pointe accessibles à tous, tout en offrant
				un service client de qualité.
			</p>

			<h3>Pourquoi nous choisir ?</h3>
			<ul>
				<li><strong>Qualité :</strong> Nous sélectionnons les meilleurs produits pour garantir votre satisfaction.</li>
				<li><strong>Prix compétitifs :</strong> Nous offrons des tarifs attractifs pour tous les budgets.</li>
				<li><strong>Service client :</strong> Une équipe dédiée est à votre écoute pour répondre à vos questions.</li>
				<li><strong>Livraison rapide :</strong> Nous expédions vos commandes dans les meilleurs délais.</li>
			</ul>

			<h3>Contactez-nous</h3>
			<p>
				Vous avez des questions ou besoin d'aide pour choisir vos produits ? N'hésitez pas à nous contacter :
			</p>
			<ul>
				<li><strong>Email :</strong> <a href="mailto:contact@computek.fr">contact@computek.fr</a></li>
				<li><strong>Téléphone :</strong> +33 1 23 45 67 89</li>
				<li><strong>Adresse :</strong> 123 Rue de l'Informatique, 75000 Paris, France</li>
			</ul>
		</div>
	</article>
</main>
<!-- FIN CONTENU DE LA PAGE -->

<!-- DEBUT footer.php (puis remplacer par un include de footer.php) -->
<?php
include 'footer.php'
?>
<!-- FIN footer.php (remplacé par un include de footer.php) -->