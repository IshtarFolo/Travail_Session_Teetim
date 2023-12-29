<?php
// Gestion de la session
session_start();

// Inclure le fichier de config du site
include("../adeplacer/teetim.conf.php");

// Inclure la librairie "SQL" pour manipuler les données dans la BDR.
include("../lib/sql.lib.php");
// Obtenir une connexion au serveur de BD.
$cnx = connexion();

// Inclure la librairie de gestion du panier.
include("../lib/panier.lib.php");

// On récupère l'identifiant du panier de l'utilisateur à partir de la variable 
// de session établie dès l'arrivée au site.
$idPanier = $_SESSION["idPanier"];

// On suppose que le paramètre "action" est toujours reçu dans la requête Get.
// Ce paramètre est sensé indiquer l'opération souhaitée sur le panier : c'est à
// dire une des opération 'ajouter', 'modifier' ou 'supprimer'.
$action = $_GET["action"];

switch($action) {
  case 'ajouter' : 
      $pid = $_GET["pid"];

      ajouterArticle($cnx, $idPanier, $pid);
    break;

  /*
    [TPv34] nécessaire pour compléter le point 5
  */
  case 'supprimer' : 
      $aid = $_GET["aid"];

      supprimerArticle($cnx, $aid);
    break;

  /*
    [TPv34] nécessaire pour compléter le point 4
  */
  case 'modifier' : 
      $pid = $_GET["pid"];
      $qte = $_GET["qte"];

      modifierQuantiteArticle($cnx, $pid, $qte);
    break;
}

// Quel que soit l'opération de panier, on fini toujours en retournant le 
// détail du panier après ces modifications.
echo json_encode(obtenirDetailPanier($cnx, $idPanier));