<header>
	<div class="container">
		<div id="logo_container">
			<a href="index.php"><img src="img/LOGO_GBAF_ROUGE.png" alt="Logo GBAF"/></a>
			<a href="index.php"><h1>Groupement Banque Assurance Français</h1></a>
		</div>
		<div id="connected">
			<?php
			if (isset($_SESSION['firstname']) && isset($_SESSION['lastname'])) {
			?>
			<p>
				<a href="profil.php">
					<?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?>
				</a>
				<br>
				<a href="deconnexion.php"><em style="font-size: small;">Se déconnecter</em></a>
			</p>
			<?php
			} else {
			?>
			<p>
				Vous n'êtes pas connectés.
			</p>
			<?php
			}
			?>
		</div>
	</div>
</header>