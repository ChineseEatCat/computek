<script>
	// Smooth scrolling avec la molette
	window.addEventListener('wheel', function(e) {
		e.preventDefault(); // Empêche le comportement par défaut du défilement
		window.scrollBy({
			top: e.deltaY, // Défilement vertical basé sur la molette
			behavior: 'smooth' // Défilement fluide
		});
	}, {
		passive: false
	}); // Permet d'empêcher le comportement par défaut
</script>
<footer>
	<div>
		<p>© Copyright 2025 ... Tous droits reversés.
		<p>Plus d'informations ? Contactez nous !</p>
		<ul>
			<li><a href="contact.php">Contact</a></li>
			<li><a href="cgv.php">Conditions Générales de Vente</a></li>
			<li><a href="mentionlegale.php">Mentions Légales</a></li>
		</ul>
	</div>
</footer>

</body>

</html>