<?php
include 'header.php'
?>

	<main>
		<h1>Connexion</h1>
		<div class="position-form">
			<form class="connexion">
				<h4>CONNEXION</h4>
				<hr>
				<label for="email">E-mail :</label>
				<input type="email" id="email">
				<label for="mdp">Mot de passe :</label>
				<input type="password" id="mdp">
				<input type="submit" value="Connexion">
			</form>
			<form class="inscription">
				<h4>INSCRIPTION</h4>
				<hr>
				<div class="nom-prenom">
					<div>
						<label>Nom :</label>
						<input type="text">
					</div>
					<div>
						<label>Prénom :</label>
						<input type="text">
					</div>
				</div>
				<label>E-mail :</label>
				<input type="email">
				<label>Mot de passe :</label>
				<input type="password">
				<label>Confirmation mot de passe :</label>
				<input type="password">
				<input type="submit" value="S'inscrire">

			</form>
		</div>
	</main>


	<?php
	include 'footer.php'
	?>
