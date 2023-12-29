<?php
$page = "teeshirts";
include('commun/entete.com.php');

/*
	Intégration des produits "teeshirts"
*/
// Librairie de gestion du catalogue.
include("lib/catalogue.lib.php");

$categories = obtenirCategories($cnx);
$produits = obtenirProduits($cnx);
?>
<main class="page-produits page-teeshirts">
	<article class="amorce">
		<h1><?= $_["titrePage"]; ?></h1>
		<section class="controle">
			<form action="" method="get">
				<div class="filtre">
					<label for="filtre"><?= $textes["catalogue"]["filtreEtiquette"]; ?></label>
					<select name="filtre" id="filtre">
						<option value="tous"><?= $textes["catalogue"]["filtreTous"]; ?></option>

						<?php foreach ($categories as $categorie) : ?>
							<option value="<?= $categorie["id"]; ?>"><?= $categorie["nom"]; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="tri">
					<label for="tri"><?= $textes["catalogue"]["triEtiquette"]; ?></label>
					<select name="tri" id="tri">
						<option value="RAND()"><?= $textes["catalogue"]["triAlea"]; ?></option>
						<option value="prix ASC"><?= $textes["catalogue"]["triPrixAsc"]; ?></option>
						<option value="prix DESC"><?= $textes["catalogue"]["triPrixDesc"]; ?></option>
						<option value="nom ASC"><?= $textes["catalogue"]["triNomAsc"]; ?></option>
						<option value="nom DESC"><?= $textes["catalogue"]["triNomDesc"]; ?></option>
						<option value="dac DESC"><?= $textes["catalogue"]["triNouveaute"]; ?></option>
						<option value="ventes DESC"><?= $textes["catalogue"]["triVentes"]; ?></option>
					</select>
				</form>
			</div>
		</section>
	</article>
	<article class="principal liste-produits">
		<?php foreach ($produits as $prod) : ?>
			<div class="produit" data-pid="<?= $prod["id"]; ?>">
				<span class="ventes"><?= $prod["ventes"]; ?></span>
				<span class="image">
					<img 
						src="images/produits/teeshirts/<?= $prod["image"]; ?>" 
						alt="<?= $prod["nom"]; ?>"
					>
				</span>
				<div class="prd-info">
					<span class="nom"><?= $prod["nom"]; ?></span>
					<span class="prix">
						<span class="montant">
							<?= number_format($prod["prix"], 2); ?> 
						</span>
						$
					</span>
				</div>
				<!-- Bouton d'ajout au panier -->
				<button class="btn-ajouter">Ajouter au panier</button>
			</div>
		<?php endforeach; ?>
	</article>
</main>

<!-- Gabarit utilisé pour les requêtes asynchrones -->
<template id="gabarit-produit">
	<div class="produit" data-pid="">
		<span class="ventes"></span>
		<span class="image">
			<img src="images/produits/teeshirts/" alt="">
		</span>
		<div class="prd-info">
			<span class="nom"></span>
			<span class="prix">
				<span class="montant"></span> $
			</span>
		</div>
		<!-- Bouton d'ajout au panier -->
		<button class="btn-ajouter">Ajouter au panier</button>
	</div>
</template>

<?php include('commun/pied2page.com.php'); ?>