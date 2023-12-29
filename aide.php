<?php
// [TPv2] Point 9 et 10 : il y a en tout 9 fichiers représentant les 9 pages restantes.
$page = "aide";
include('commun/entete.com.php');
?>
<main class="page-aide">
	<article class="amorce">
		<h1><?= $_["titrePage"]; ?></h1>
	</article>
	<article class="principal">
		...
	</article>
</main>
<?php include('commun/pied2page.com.php'); ?>