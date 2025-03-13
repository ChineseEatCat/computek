<?php
include 'header.php';
?>

<main>
	<h1>Contact</h1>
	<div class="position-form">
		<form class="contact">
			<h4>ENVOYER UN MESSAGE</h4>
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
			<label>Objet :</label>
			<input type="text">
			<label>Message :</label>
			<textarea type="text"></textarea>
			<input type="submit" value="Envoyer">
		</form>
	</div>
</main>

<?php
include 'footer.php';
?>