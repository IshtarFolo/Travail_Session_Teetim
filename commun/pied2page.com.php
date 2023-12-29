		<footer>
			<h2>teeTIM</h2>
			<div class="contenu">
				<section class="achats">
					<h3><?= $_pp["achatsTitre"]; ?></h3>
					<nav>
						<a href="faq.php"><?= $_pp["navAchatsFaq"]; ?></a>
						<a href="livraison.php"><?= $_pp["navAchatsLivraison"]; ?></a>
						<a href="conditions.php"><?= $_pp["navAchatsConditions"]; ?></a>
						<a href="confidentialite.php"><?= $_pp["navAchatsConfidentialite"]; ?></a>
					</nav>
				</section>
				<section class="apropos">
					<h3><?= $_pp["aProposTitre"]; ?></h3>
					<nav>
						<a href="compagnie.php"><?= $_pp["aProposCompagnie"]; ?></a>
						<a href="equipe.php"><?= $_pp["aProposEquipe"]; ?></a>
						<a href="emplois.php"><?= $_pp["aProposEmplois"]; ?></a>
					</nav>
				</section>
				<section class="coordonnees">
					<h3><?= $_pp["joindreTitre"]; ?></h3>
					<nav>
						<span><?= $_pp["joindreTelEtiquette"]; ?><b>1 866 888 6666</b></span>
						<span><?= $_pp["joindreCourrielEtiquette"]; ?>aide@teetim.ca</span>
					</nav>
				</section>
			</div>
			<p class="da">&copy; <?= $_pp["droits"]; ?> <?= date("Y"); ?></p>
		</footer>
	</div>
	<!-- [TPv2] Point 6 et 7 : inclure le fichier de code JS -->
	<script src="js/main.js"></script>
</body>
</html>