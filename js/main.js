/* [TPv2] Point 6 et 7
----------------------------------------------------------------------------------------------*/
// Point 6 : quand la quantitee d'article dans le panier est egale a 0, on affiche le message
// Si la quantitee d'articles dans le panier est egale a 0, on affiche le message de panier vide
/**
 * Gère l'affichage du message de panier vide.
 * 
 * @param {Array} detailPanier : Tableau numérique contenant des tableaux
 *                              associatifs représentant chacun un article dans
 *                             le panier.  
 * 
 */
function afficherMessagePanierVide(detailPanier) {
  if (detailPanier.length == 0) {
  // On saisit le conteneur du message de panier vide
  let messagePanierVide = document.querySelector('.message');
  let panierPlein = document.querySelector('.item-panier');

  // On affiche le message de panier vide et on cache le panier
  messagePanierVide.style.display = "block";
  panierPlein.style.display = "none";
  }
}

/* fin Points 6 et 7 
-------------------------------------------------------------------------------------------------*/ 

// Langue du site
let langue = document.documentElement.lang;
// Ou encore : let langue = document.querySelector('html').lang;

// Gestion du tri et filtre de produits
let selectFiltreOuTri = document.querySelector('.controle form');
if(selectFiltreOuTri) {
  selectFiltreOuTri.addEventListener('change', function(evt) {
    fetch("async/teeshirts.async.php?filtre=" 
      + this.filtre.value
      + "&tri="
      + this.tri.value
    ).then(afficherProduits);
  });
}

function afficherProduits(rep) {
  rep.json().then(function(res) {
    let conteneurProduits = document.querySelector("main.page-teeshirts article.principal");
    let gabaritProduit = document.getElementById("gabarit-produit");
    conteneurProduits.innerHTML = "";
    for(let prod of res) {
      let cloneProd = gabaritProduit.content.cloneNode(true);
      cloneProd.firstElementChild.dataset.pid = prod.id;
      cloneProd.querySelector('.ventes').innerHTML = prod.ventes;
      cloneProd.querySelector('img').src += prod.image;
      cloneProd.querySelector('img').alt = prod.nom;
      cloneProd.querySelector('.nom').innerHTML = prod.nom;
      cloneProd.querySelector('.montant').innerHTML = prod.prix;
      conteneurProduits.appendChild(cloneProd);

      afficherMessagePanierVide();
    }
  });
}

/******** Gestion du panier d'achats *********/

/***** Fonctions générales *****/
/*  
  [TPv34] Point 2 : utilisez la valeur du paramètre detailPanier dans la fonction 
  qui suit pour mettre à jour l'interface utilisateur (sommaire dans l'entête, 
  sommaire dans la page panier, badge, et message de panier vide).
*/
/**
 * Gère la mise à jour de l'affichage de l'interface utilisateur après les actions
 * asynchrones sur le panier (les sommaires, le badge, le message de panier vide).
 * 
 * @param {Array} detailPanier : Tableau numérique contenant des tableaux 
 *                               associatifs représentant chacun un article dans
 *                               le panier.
 */
function gererAffichageActionsPanier(detailPanier) {
  // Vérifiez la console pour comprendre la variable detailPanier !
  console.log("État du panier : ", detailPanier);

  // Saisir le sommaire du panier dans l'entête.
  let nombreArticles = document.querySelector('.sommaire-panier .ligne1 .nb-articles .nombre');
  // Saisir le sommaire du montant total du panier dans l'entête.
  let sommeArticles = document.querySelector('.sommaire-panier .ligne2 .sous-total');
  // Saisir le sommaire du montant total du panier dans la div contenant la classe .sommaire-panier du bas de la page
  let sommeTotaleBas = document.querySelector('article.principal .sommaire-panier .sous-total .montant');
  // On saisit le prix total de chaque article
  let totalArticle = document.querySelectorAll('article.principal .liste-panier .item-panier .qte-prix .total-article .valeur-soustotal');
  // On saisit le total d'articles dans le panier au bas du panier
  let nombreArticlesBas = document.querySelector('article.principal .sommaire-panier .nb-articles .nombre');

  // Le nombre d'article est egal a la quantite totale d'articles dans le panier (prends en compte la quantite de chaque article)
  let quantiteTotale = [];
  // On fait une boucle pour ajouter la quantite de chaque article dans le tableau quantiteTotale
  for (let i = 0; i < detailPanier.length; i++) {
    quantiteTotale.push(parseInt(detailPanier[i].qte));
  }
  /* On utilise les fonctions reduce pour additionner les résultats obtenus dans le tableau quantiteTotale 
   * --> Référence: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reduce
   */
  // Si les elements nombreArticles et nombreArticlesBas existent, on affiche le nombre d'articles aux bons endroits dans le panier et l'entete
  if(nombreArticles){
    nombreArticles.innerHTML = quantiteTotale.reduce((a, b) => a + b, 0);
  }

  if(nombreArticlesBas){
    nombreArticlesBas.innerHTML = quantiteTotale.reduce((a, b) => a + b, 0);  
  }

  // On fait une boucle pour ajouter le prix total de chaque article dans le tableau prixTotal
  let prixTotal = [];
  for (let i = 0; i < detailPanier.length; i++) {
    prixTotal.push(parseFloat(detailPanier[i].prix * detailPanier[i].qte));
  }

  if(totalArticle){
    // On fait une boucle pour afficher le prix total de chaque article dans le panier
    for (let i = 0; i < totalArticle.length; i++) {
      totalArticle[i].innerHTML = prixTotal[i].toFixed(2);
    }
  }
  /* On utilise les fonctions reduce pour additionner les résultats obtenus dans le tableau prixTotal 
   * --> Référence: https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/Array/reduce
   */
  // Si les elements sommeArticles et sommeTotaleBas existent, on affiche le prix total des articles aux bons endroits dans le panier et l'entete
  if(sommeArticles){
    sommeArticles.innerHTML = prixTotal.reduce((a, b) => a + b, 0).toFixed(2);
  }

  if(sommeTotaleBas){
    sommeTotaleBas.innerHTML = prixTotal.reduce((a, b) => a + b, 0).toFixed(2);
  }

  // Point 8: On affiche le badge du panier si le panier est plein et on le cache si le panier est vide

  let spanBadge = document.querySelector('.badge-panier');

  // Si le nombre d'articles dans le panier est plus grand que 0 on affiche le badge
  if(detailPanier.length > 0)
  {
    spanBadge.style.display = "block";
    spanBadge.innerHTML = quantiteTotale.reduce((a, b) => a + b, 0);
  }
  else
  {
    spanBadge.style.display = "none";
  }
}

/***** FIN - Fonctions générales *****/

/***** AJOUTER *************************************************************************************/
// Saisir le conteneur de tous les produits.
let conteneurProduits = document.querySelector(".liste-produits");

// Écouter le clic sur ce conteneur.
if(conteneurProduits) {
  conteneurProduits.addEventListener('click', gererRequeteAjoutPanier);
}

/**
 * Gère la requête HTTP asynchrone pour ajouter un produit au panier.
 * @param {Event} evt : objet événement généré par le DOM. 
 */
function gererRequeteAjoutPanier(evt) {
  // On saisit la cible directe du clic.
  let cibleClic = evt.target;
  // S'il s'agit d'un élément ayant la classe "btn-ajouter"
  if(cibleClic.classList.contains("btn-ajouter")) {
    // On accède à la valeur de l'attribut data- contenant l'identifiant du produit.
    let pid = cibleClic.closest("div.produit").dataset.pid;
    // Et on émet une requête HTTP asynchrone avec l'API Fetch.
    fetch("async/panier.async.php?action=ajouter&pid=" + pid).then(gererReponseAjoutPanier);
  }
}

/**
 * Décode la réponse JSON et appelle la fonction qui gère l'affichage.
 * @param {Object} reponse : objet réponse de la requête HTTP asynchrone. 
 */
function gererReponseAjoutPanier(reponse) {
  reponse.json().then(gererAffichageActionsPanier);
}

/***** FIN - AJOUTER *****************************************************************************/

/*
  [TPv34] Point 4 : Code requis pour modifier la quantité d'un article.
*/
/***** MODIFIER **********************************************************************************/ 
// Saisir le conteneur de tous les produits.
let boutonModifier = document.querySelectorAll("article.principal .liste-panier .qte-prix .quantite .btn-modifier");

// On met un ecouteur d'evenement sur chaque bouton modifier
for (let i = 0; i < boutonModifier.length; i++) {
  boutonModifier[i].addEventListener('click', gererRequeteModifierQuantite);
}

/**
 * Gère la requête HTTP asynchrone pour modifier la quantité d'un produit au panier.
 * 
 * @param {Event} evt : objet événement généré par le DOM. 
 * 
 */
function gererRequeteModifierQuantite(evt) {
  // On saisit la cible directe du clic.
  let cibleClic = evt.target;

  // S'il s'agit d'un élément ayant la classe "btn-modifier"...
  if (cibleClic.classList.contains("btn-modifier")) 
  {
    // On accède à la valeur de l'id du produit dans la propriété "data-aid" de l'article.
    let pid = cibleClic.closest("article.item-panier").dataset.aid;
    // On accède à la valeur l'input de la quantite.
    let quantite = cibleClic.closest("article.item-panier").querySelector(".quantite input").value;
    // On emet une requete HTTP asynchrone avec l'API Fetch pour modifier la quantite d'un article

    if(quantite == 0){
      fetch("async/panier.async.php?action=supprimer&aid=" + pid).then(gererReponseSupprimerArticle);
      cibleClic.closest("article.item-panier").remove();
  
    }else{
      fetch("async/panier.async.php?action=modifier&pid=" + pid + "&qte=" + quantite)
      .then(gererReponseModifierQuantite);
    }
  }
}

/**
 * Décode la réponse JSON et appelle la fonction qui gère l'affichage.
 * 
 * @param {Object} reponse : objet réponse de la requête HTTP asynchrone.
 * 
 */
function gererReponseModifierQuantite(reponse){
  reponse.json().then(gererAffichageActionsPanier);
}

/***** FIN MODIFIER ********************************************************************************/

/*
  [TPv34] Point 5 : Code requis pour supprimer un article du panier.
*/
/***** SUPPRIMER **********************************************************************************/
// On capture les boutons pour supprmier un article du panier
let boutonSupprimer = document.querySelectorAll("article.principal .liste-panier .item-panier .image-nom .btn-supprimer");
// On met un ecouteur d'evenement sur chaque bouton supprimer
for (let i = 0; i < boutonSupprimer.length; i++) {
  boutonSupprimer[i].addEventListener('click', gererRequeteSupprimerArticle);
}

/**
 * Gère la requête HTTP asynchrone pour supprimer un article du panier.
 * 
 * @param {Event} evt : objet événement généré par le DOM.
 * 
 */
function gererRequeteSupprimerArticle(evt) {
  // On saisit la cible directe du clic.
  let cibleClic = evt.target;

  // Si la cible est le bouton supprimer
 
  
    // On accède à la valeur de l'id du produit dans la propriété "data-pid" de l'article.
    let aid = cibleClic.closest("article.item-panier").dataset.aid;
    // On emet une requete HTTP asynchrone avec l'API Fetch pour supprimer un article
    fetch("async/panier.async.php?action=supprimer&aid=" + aid).then(gererReponseSupprimerArticle);
    // On supprime l'article du panier
    cibleClic.closest("article.item-panier").remove();
  

  console.log(cibleClic);
}

/**
 * Décode la réponse JSON et appelle la fonction qui gère l'affichage.
 * 
 * @param {Object} reponse : objet réponse de la requête HTTP asynchrone.
 * 
 */
function gererReponseSupprimerArticle(reponse) {
  reponse.json().then(gererAffichageActionsPanier);
}