<?php
include 'header.php';
?>

<main>

	<main>
		<h1>Connexion</h1>
		<div class="position-form">
			<form class="connexion" method="post" action="auth.php">
				<h4>CONNEXION</h4>
				<hr>
				<label for="email">E-mail :</label>
				<input type="email" id="email" name="email">
				<label for="mdp">Mot de passe :</label>
				<input type="password" id="mdp" name="pass">
				<input type="submit" value="Connexion">
			</form>
			<form class="inscription" method="post" action="sub.php">
				<h4>INSCRIPTION</h4>
				<hr>
				<div class="nom-prenom">
					<div>
						<label>Nom :</label>
						<input type="text" name="nom">
					</div>
					<div>
						<label>Prénom :</label>
						<input type="text" name="prenom">
					</div>
				</div>
				<label>E-mail :</label>
				<input type="email" name="email">
				<label>Mot de passe :</label>
				<input type="password" name="pass">
				<label>Confirmation mot de passe :</label>
				<input type="password" name="repass">
				<input type="submit" value="S'inscrire">

			</form>
		</div>
	</main>


	<?php
	include 'footer.php';
	?>