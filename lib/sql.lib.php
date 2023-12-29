<?php

// Manipulation des données MySQL

/**
 * Ouvre une connexion et configure l'encodage de caractères. 
 * 
 * @param String $hote : adresse IP ou nom de domaine du serveur MySQL.
 * @param String $util : nom d'utilisateur du serveur MySQL.
 * @param String $mdp : mot de passe associé avec cet utilisateur.
 * @param String $bd : nom de la base de données.
 * 
 * @return Object : objet de connexion MySQL 
 */
function connexion($hote=BD_HOTE, $util=BD_UTIL, $mdp=BD_MDP, $bd=BD_NOM) {
  $cnx = mysqli_connect($hote, $util, $mdp, $bd);
  mysqli_set_charset($cnx, "utf8");
  // Pour les besoins de ce cours, nous désactivons les "exceptions" MySQL 
  // (manque de temps pour vous expliquer le sujet)
  mysqli_report(MYSQLI_REPORT_OFF);
  return $cnx;
}

/**
 * Soumet une requête SQL.
 * 
 * @param Object $refCnx : l'objet de connexion obtenu par la fonction connexion().
 * @param String $req : une chaîne contenant une commande SQL.
 * 
 * @return Object|Boolean : un objet contenant le résultat d'une requête SQL
 *                          ou une valeur booléenne si la requête a échoué.
 */
function soumettreRequete($refCnx, $req) {
  return mysqli_query($refCnx, $req);
}

/**
 * Effectue une commande SELECT sur la BD.
 * 
 * @param Object $refCnx : l'objet de connexion obtenu par la fonction connexion().
 * @param String $req : une chaîne contenant une commande SQL.
 * @param Number $mode : un nombre (fourni par une constante PHP) qui représente le
 *                       mode de résultat souhaité (par défaut, la valeur est 1
 *                       et représente un tableau associatif).
 * 
 * @return Array : tableau numérique contenant les enregistrements demandés ; 
 *                 chaque enregistrement est un tableau du type spécifié dans 
 *                 le paramètre $mode (tableau associatif par défaut).
 */
function lire($refCnx, $req, $mode=MYSQLI_ASSOC) {
  $res = soumettreRequete($refCnx, $req);
  return mysqli_fetch_all($res, $mode);
}

/**
 * Soumet une requête de type INSERT et retourne l'identifiant 
 * de l'enregistrement inséré. 
 * @param Object $cnx : Référence à la connexion MySQL.
 * @param String $requete : Requête SQL INSERT.
 * 
 * @return Int : Identifiant de l'enregistrement inséré.
 */
function creer($cnx, $requete) {
  soumettreRequete($cnx, $requete);
  return mysqli_insert_id($cnx);
}

/*
  [TPv34] nécessaire pour compléter le point 4 (n'oubliez pas de commenter 
  adéquatement cette fonction)
*/
/**
 * Soumet une requête de type UPDATE et retourne le nombre d'enregistrements 
 * affectés. 
 * @param Object $cnx : Référence à la connexion MySQL.
 * @param String $requete : Requête SQL INSERT.
 * 
 * @return Int : Nombre d'enregistrements qui ont été modifiés (0, 1, ou plus).
 */

function modifier($cnx, $requete) {
  soumettreRequete($cnx, $requete);
  return mysqli_affected_rows($cnx);
}

/*
  [TPv34] nécessaire pour compléter le point 5 (n'oubliez pas de commenter 
  adéquatement cette fonction)
*/
/**
 * Soumet une requête de type DELETE et retourne le nombre d'enregistrements 
 * affectés. 
 * @param Object $cnx : Référence à la connexion MySQL.
 * @param String $requete : Requête SQL INSERT.
 * 
 * @return Int : Nombre d'enregistrements qui ont été supprimés (0, 1, ou plus).
 */

function supprimer($cnx, $requete) {
  soumettreRequete($cnx, $requete);
  return mysqli_affected_rows($cnx);
}