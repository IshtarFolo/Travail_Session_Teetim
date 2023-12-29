<?php
$page = "panier";
include('commun/entete.com.php');
?>
<main class="page-panier">
  <article class="amorce">
    <h1><?= $_["titrePage"]; ?></h1>
  </article>
<?php
// Point 6
// Si le panier n'est pas vide...
switch (isset($detailPanier)) :
  case $nbArticles > 0 :
?>
  <article class="principal">
    <div class="liste-panier">
      <!-- 
        [TPv34] Point 3 : utilisez la variable $detailPanier pour générer 
        dynamiquement le contenu du panier.
      -->
      <!-- Gabarit d'un article dans le panier -->
      <?php
      // Obtenir le détail du contenu du panier d'achats d'un utilisateur du site.
      // À faire: boucle pour afficher tous les articles du panier, un par un. 
      // (voir gabarit ci-dessous)
      foreach($detailPanier as $article): 
      ?>

            <article class="item-panier" data-aid="<?= $article["id_produit"]; ?> ">
              <div class="image-nom">
                <div class="image">
                  <img src="images/produits/teeshirts/<?= $article["image"]; ?>" alt="<?= $article["nom"]; ?> ">
                </div>
                <div class="nom"><?= $article["nom"]; ?>  </div>
                <button class="btn-supprimer material-icons" title="Cliquez pour supprimer cet article du panier">delete</button>
              </div>
              <div class="qte-prix">
                <div class="prix">
                  <span class="etiquette-prix">Prix : </span> 
                  <span class="valeur-prix montant montant-fr"><?= $article["prix"]; ?> </span>
                </div>
                <div class="quantite">
                  <span class="etiquette-qte">Quantité : </span> 
                  <span class="valeur-qte">
                    <input type="number" name="quantite" value="<?= $article["qte"]; ?>" min="1" max="9">
                    <button class="btn-modifier material-icons" title="Cliquez pour mettre à jour la quantité pour cet article">update</button>
                  </span>
                </div>
                <div class="total-article">
                  <span class="etiquette-soustotal">Sous-total : </span>
                  <span class="valeur-soustotal montant montant-fr"><?=
                  // Sous-total pour chaque article dependemment de la quantitee choisie
                  number_format($article["qte"] * $article["prix"], 2, ',', ' ');
                  ?> </span>
                </div>
              </div>
            </article>
      <?php endforeach; ?>

  <?php 
    break;
    // Point 6
    // Si le panier est vide...
    case $nbArticles == 0 :
  ?>
    <article class="principal">
      <div class="liste-panier">
          <span class="message"><?= $_["messageVide"]; ?> </span>

  <?php endswitch; ?> 

    </div>
    <div class="sommaire-panier">

      <!-- Le nombre d'articles dans le panier, affiche a l'aide de la variable cree dans entete.php -->
      <span class="nb-articles">(<?= $_["nbArticles"]; ?> <span class="nombre"><?= $nbArticles; ?> </span>)</span>
      <span class="sous-total">
        <?= $_["sousTotal"]; ?> 

        <!-- Le sous-total affiche dynamiquement avec la variable de entete.php -->
        <span class="montant montant-<?= $codeLangue; ?> "><?= number_format($sousTotal($detailPanier), 2, ",", ""); ?></span>
      </span>
      <span class="btn-commander"><?= $_["btnCommander"]; ?></span>
    </div>
  </article>
</main>
<?php include('commun/pied2page.com.php'); ?>