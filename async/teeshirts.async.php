<?php
// Inclure les fichiers requis pour utiliser la BD.
include("../adeplacer/teetim.conf.php");
include("../lib/sql.lib.php");

// Librairie de gestion du catalogue.
include("../lib/catalogue.lib.php");

$tri = $_GET["tri"];
$filtre = $_GET["filtre"];

// Connexion
$cnx = connexion();
// Obtenir les produits à partir de la BD.
$produits = obtenirProduits($cnx, $tri, $filtre);

// Retourner le résultat dans le format JSON.
echo json_encode($produits);
?>