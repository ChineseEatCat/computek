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
		<h1>Mentions Légales</h1>

		<h3>1. Éditeur du site</h3>
		<p>
			Nom de l'entreprise : Computek<br>
			Adresse : 123 Rue de l'Informatique, 75000 Paris, France<br>
			Téléphone : +33 1 23 45 67 89<br>
			Email : contact@computek.fr<br>
			Numéro SIRET : 123 456 789 00012<br>
			Directeur de la publication : Jean Dupont
		</p>

		<h3>2. Hébergement</h3>
		<p>
			Hébergeur : OVH<br>
			Adresse : 2 Rue Kellermann, 59100 Roubaix, France<br>
			Téléphone : +33 9 72 10 10 07<br>
			Site web : <a href="https://www.ovh.com" target="_blank">www.ovh.com</a>
		</p>

		<h3>3. Propriété intellectuelle</h3>
		<p>
			Le contenu du site (textes, images, vidéos, etc.) est protégé par le droit d'auteur. Toute reproduction,
			représentation, modification, publication, adaptation de tout ou partie des éléments du site, quel que soit le moyen
			ou le procédé utilisé, est interdite, sauf autorisation écrite préalable de Computek.
		</p>

		<h3>4. Données personnelles</h3>
		<p>
			Les informations recueillies via les formulaires du site sont destinées à Computek pour la gestion de vos demandes.
			Conformément à la loi "Informatique et Libertés" et au RGPD, vous disposez d'un droit d'accès, de rectification,
			de suppression et d'opposition concernant vos données personnelles. Pour exercer ce droit, contactez-nous à
			l'adresse email : <a href="mailto:contact@computek.fr">contact@computek.fr</a>.
		</p>

		<h3>5. Limitation de responsabilité</h3>
		<p>
			Computek ne pourra être tenu responsable des dommages directs ou indirects causés au matériel de l'utilisateur lors
			de l'accès au site, ni des éventuelles erreurs ou omissions dans le contenu du site.
		</p>
	</article>
</main>
<!-- FIN CONTENU DE LA PAGE -->

<!-- DEBUT footer.php (puis remplacer par un include de footer.php) -->
<?php
include 'footer.php';
?>
<!-- FIN footer.php (remplacé par un include de footer.php) -->