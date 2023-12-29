[![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-24ddc0f5d75046c5622901739e7c5dd533143b0c8e959d652212380cedb1ea36.svg)](https://classroom.github.com/a/sMI1vG3Z)
# TP/Volet 3/4 : Produire un site Web dynamique en intégrant une base de données relationnelles et un gestionnaire de contenu.

## Travail d'équipe permis à raison de deux personnes pas équipe maximum.

>Date limite de remise indiquée sur Omnivox (et *GitHub Classroom*).

>Si vous travaillez en équipe, les deux personnes doivent accepter les fichiers du TP sur *GitHub Classroom*.

>Vous travaillez ensuite chacun.e sur votre version de code localement, et vous faites vos fusions et synchronisations du code correctement (attention : ce n'est pas simple, me consulter pour optimiser le travail d'équipe).

>Divisez le travail dans l'équipe de façon à simplifier/faciliter ces fusions (expérimentez, c'est le moment idéal !)

## Objectif/exigences généraux
* Intégrer les données provenant de la BD `MySQL` avec `PHP`
* Implémenter les quatres opérations essentielles de manipulation des données (`CRUD`)
* Formater l'affichage `HTML` avec `CSS` 
* Utiliser la programmation `JavaScript` *asynchrone* pour produire une interface utilisateur réactive

## Étapes à suivre avant de commencer le travail
1. Clonez le dépôt sur votre machine locale à l'endroit approprié

2. Implémentez la base de données distribuée (fichier `data/teetim.bd.sql`) ; Attention : vous ne pouvez pas utiliser une autre base de données que celle distribuée ici, ni changer son nom, ni sa structure !

3. Testez le site sur votre serveur Web avant de commencer le travail

4. Vous ne pouvez compléter ce TP qu'en travaillant à partir du site dont le code et la base de données sont distribués dans ce dépôt : n'essayez même pas avec votre propre code de départ 🥺!

## Fonctionnalités à implémenter
1. [15 points] Panier (calcul du sommaire) : Produisez les fonctions requises dans le fichier `lib/panier.lib.php` pour calculer le nombre d'articles dans le panier et le sous-total du panier ; utilisez ces fonctions dans le fichier `commun/entete.com.php` pour obtenir les informations requises et les afficher aux endroits adéquats de l'interface. Remarquez que le détail du panier pour lequel vous voulez faire ces calculs est dans une variable déjà prête à utiliser (ligne 50 du fichier `entete.com.php`). --> FAIT!

2. [15 points] Panier (mise à jour de l'affichage après requête asynchrone) : La première requête asynchrone (ajout d'un article) a été implémentée et expliquée en classe, il reste à mettre à jour l'affichage de la page une fois la réponse `JSON` est décodée. Donc, dans le fichier `JavaScript` complétez le code pour mettre à jour le sommaire du panier (qui se trouve dans l'entête du site lorsqu'on clique sur l'icône du panier d'achats). Utilisez la fonction `gererAffichageActionsPanier` pour produire votre code. --> FAIT!

3. [15 points] Panier (affichage dynamique de la page) : Générez dynamiquement le contenu du panier d'achats dans la page `panier.php`; Utilisez encore une fois la variable `$detailPanier` disponible dans toutes les pages (puisqu'elle est dans l'entête commun du site). Affichez toujours les montants d'argent avec 2 places décimales. Faites bien attention à donner une valeur adéquate à l'attribut `data-aid` de chaque article dans le panier : sa valeur doit correspondre à l'identifiant de la table `panier_article` (le seul champ `id` dans le tableau `$detailPanier` de toute façon). Pour le sommaire du panier en bas de page, vous pouvez probablement utiliser le calcul déjà fait au point 1. --> FAIT!

4. [10 points] Panier (modifier la quantité pour 1 article) : implémentez la requête asynchrone pour mettre à jour la quantité d'un article dans le panier lorsqu'on clique sur le bouton correspondant. Remarquez que le code requis doit être écrit dans les fichiers `main.js`, `async/panier.async.php`, `lib/sql.lib.php`, et `lib/panier.lib.php`. N'oubliez pas que vous devez mettre à jour l'affichage, c'est à dire les deux sommaires (entête/badge et bas de la page panier), et aussi le sous-total pour l'article modifié !

5. [10 points] Panier (supprimer 1 article du panier) : même chose que le point précédent, mais cette fois-ci pour supprimer un article lorsque le bouton adéquat est cliqué.

6. [10 points] Panier (affichage du message 'Panier vide') : lorsque le nombre d'articles dans le panier est 0, un message indiquant que le panier est vide est affiché dans la page `panier.php`. Attention, code requis en `PHP` et en `JavaScript` lorsque le panier est vidé suite à des requêtes asynchrones.

7. [10 points] Panier (modification de la quantité à 0) : lorsque l'utilisateur modifie la quantité d'un article à 0, il faut supprimer l'article plutôt que de modifier sa quantité (dans la BD et dans l'affichage bien sûr) !

8. [15 points] Panier (badge de l'icône) : lorsque la quantité d'articles dans le panier est plus grand que 0, un badge apparaît sur l'icône du panier d'achats dans l'entête du site indiquant cette quantité. Le badge n'est pas affiché si la quantité est 0.

9. [POINTS BONIS (5) : DIFFICILE] Panier (ajout répété d'un article) : Chaque clique sur le bouton `Ajouter au panier` augmente la quantité de cet article dans le panier (par défaut, en ce moment, les clics successifs ne font rien au delà du premier ajout, la quantité reste à 1).

10. [POINTS BONIS (5) : TRÈS FACILE] i18n : Externalisez et finir le traitement `i18n` de toutes les nouvelles étiquettes statiques du site pour qu'elles puissent s'afficher en français et en anglais. Attention, la BD reste unilingue français (trop compliqué pour ce travail).

11. [POINTS BONIS (5) : FACILE] i18n : Le placement du symbole de devise (dollar : $) doit suivre les conventions culturelles (à gauche du montant d'argent sans espace lorsque le site est affiché en anglais ; à droite du montant d'argent et précédé d'un espace lorsque le site est affiché en français).

12. [POINTS BONIS (5) : DIFFICILE] Animation des éléments d'action de l'interface utilisateur : Ajoutez des effets d'animation de l'interface utilisateur pour chaque action asynchrone sur le panier (*ajouter*, *modifier*, *supprimer*). Ces animations peuvent être sur les boutons des actions, ou encore sur les articles du panier, et aideront l'utilisateur à à prendre conscience des effets des actions sur le panier.

13. Remise : Testez votre solution, puis faites la remise sur `GitHub` avant l'échéance de la date de remise. Votre dernier `commit` de remise **finale** doit avoir le message suivant : "TP/Volet 3/4 complété et testé."

### Gardez une copie personnelle de votre travail : les dépôts de remises sur `582-3W3` seront supprimés une fois les notes publiées.

---

## Démo

* Démo de la solution de base (sans les fonctionnalités de points bonis) ici : https://bit.ly/3RBcWxz 

## Captures d'écran

* Affichage sommaire d'entête (vide)
<img src="/_captures/1-sommaire-entete-panier-vide.png" alt="Filtre des teeshirts" title="Affichage sommaire d'entête (vide)" />

* Affichage sommaire d'entête (rempli)
<img src="/_captures/2-sommaire-entete-panier-rempli.png" alt="Panier d'achats - mobile" title="Affichage sommaire d'entête (rempli)" />

* Détail panier (vide)
<img src="/_captures/3-detail-panier-vide.png" alt="Panier d'achats - desktop" title="Détail panier (vide)" />

* Détail panier (rempli)
<img src="/_captures/4-detail-panier-rempli.png" alt="Troisième langue" title="Détail panier (rempli)" />