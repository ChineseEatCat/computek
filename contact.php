<?php
include 'header.php';
?>

<main>
	<h1>Contact</h1>
	<?php
		if(isset($_GET['msg'])){
			echo "<p class='msg'>".$_GET['msg']."</p>";
		}
		?>
	<div class="position-form">
		<form action="contact_action.php" method="post">
			<h4>ENVOYER UN MESSAGE</h4>
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
			<label>Objet :</label>
			<input type="text" name="objet">
			<label>Message :</label>
			<textarea name="message"></textarea>
			<input type="submit" value="Envoyer">
		</form>
	</div>
</main>

<?php
include 'footer.php'
?>