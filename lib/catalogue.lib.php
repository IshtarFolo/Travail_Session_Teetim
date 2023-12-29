<?php 
/**
 * Obtenir toutes les catégories.
 * 
 * @param Object $cnx : objet de connexion BD.
 * 
 * @return Array : tableau numérique contenant les catégories, chacune sous 
 *                 forme d'un tableau associatif.
 */
function obtenirCategories($cnx) {
  return lire($cnx, "SELECT * FROM categorie");
}

/**
 * Obtenir les produits, éventuellement filtés et triés.
 * 
 * @param Object $cnx : objet de connexion BD.
 * @param String $tri : colonne du tri ou 'RAND()' (valeur par défaut).
 * @param Int|String $filtre : identifiant de la catégorie ou 'tous' (valeur par défaut).
 * 
 * @return Array : tableau numérique contenant les produits, chacun sous 
 *                 forme d'un tableau associatif.
 */
function obtenirProduits($cnx, $tri='RAND()', $filtre='tous') {
  // La clause filtre est utilisée dans la requête SQL uniquement si la valeur 
  // du paramètre 'filtre' est différente de 'tous'.
  $clauseDeFiltre = ($filtre=='tous') ? '' : " WHERE id_categorie = $filtre ";
  return lire($cnx, "SELECT * FROM produit $clauseDeFiltre ORDER BY $tri");
}