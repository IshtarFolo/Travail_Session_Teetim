<?php 
/**
 * Créé un nouveau panier d'achats.
 * 
 * @param Object $cnx : objet de connexion BD.
 * @param String $numeroPanier : chaîne représentant un numero unique de panier.
 * 
 * @return Int : identifiant du nouveau panier inséré dans la BD.
 * 
 */
function creerPanier($cnx, $numeroPanier) {
  return creer($cnx, "INSERT INTO panier VALUES (0, '$numeroPanier', NOW())"); 
}

/**
 * Obtient l'identifiant d'un panier existant.
 * 
 * @param Object $cnx : objet de connexion BD. 
 * @param String $numeroPanier : chaîne représentant un numero unique de panier.
 * 
 * @return Int : identifiant du panier ou 0 si aucun panier ne correspond au
 *               numéro donné en argument.
 */
function obtenirIdPanier($cnx, $numeroPanier) {
  $resIdPanier = lire($cnx, "SELECT id FROM panier WHERE numero = '$numeroPanier'");
  // Si on trouve un enregistrement correspondant à ce numéro : 
  if(count($resIdPanier) > 0) {
    // On retourne l'identifiant du panier :
    return $resIdPanier[0]["id"];
  }
  // Sinon, on retourne 0
  else {
    return 0;
  }
}

/**
 * Obtenir le détail du contenu du panier d'achats d'un utilisateur du site.
 * 
 * @param Object $cnx : objet de connexion BD.
 * @param Int $idPanier : identifiant du panier dans la BD.
 * 
 * @return Array : tableau numérique contenant le détail de chaque article du 
 *                 panier sous forme d'un tableau associatif.
 */
function obtenirDetailPanier($cnx, $idPanier) {
  $info = lire($cnx, "SELECT pa.*, prd.nom, prd.prix, prd.image 
                        FROM panier_article AS pa 
                          JOIN produit AS prd 
                            ON pa.id_produit = prd.id
                        WHERE id_panier=$idPanier");
  return $info;
}

/**
 * Ajoute un article dans le panier.
 * 
 * @param Object $cnx : objet de connexion BD.
 * @param Int $idPanier : identifiant du panier dans la BD.
 * @param Int $idProduit : identifiant du produit à ajouter.
 * 
 * @return Int : identifiant de l'article de panier ajouté.
 * 
 */
function ajouterArticle($cnx, $idPanier, $idProduit) {
  return creer($cnx, 
            "INSERT INTO panier_article VALUES (0, $idProduit, $idPanier, 1)");
}


/*
  [TPv34] Point 4 : Fonction pour modifier la quantité d'un article (n'oubliez 
  pas de commenter adéquatement cette fonction).
*/
/**
 * Modifie la quantité d'un article dans le panier.
 * 
 * @param Object $cnx : objet de connexion BD.
 * @param Int $idArticle : identifiant de l'article de panier à modifier.
 * @param Int $qte : nouvelle quantité de l'article.
 * 
 * @return Int : nombre d'enregistrements modifiés (0, 1, ou plus).
 */
function modifierQuantiteArticle($cnx, $idArticle, $qte) {
  return  modifier($cnx, 
                  "UPDATE panier_article SET qte=$qte WHERE id_produit=$idArticle");
}

/*
  [TPv34] Point 5 : Fonction pour supprimer un article du panier (n'oubliez 
  pas de commenter adéquatement cette fonction).
*/
/**
 * Supprime un article du panier.
 * 
 * @param Object $cnx : objet de connexion BD.
 * @param Int $idArticle : identifiant de l'article de panier à supprimer.
 * 
 * @return Int : nombre d'enregistrements supprimés (0, 1, ou plus).
 */
function supprimerArticle($cnx, $idArticle) {
  return supprimer($cnx, 
                  "DELETE FROM panier_article WHERE id_produit=$idArticle");
}

