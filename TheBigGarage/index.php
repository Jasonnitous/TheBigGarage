<?php
$titre = 'Accueil';
$page  = 'accueil';
require 'php/header.php';

$data      = lireJson('json/voitures.json');
$garage    = $data['concessionnaire'] ?? [];
$vehicules = getVehicules();

// Les 3 voitures les plus récentes
$recentes = $vehicules;
usort($recentes, fn($a, $b) => $b['annee'] <=> $a['annee']);
$recentes = array_slice($recentes, 0, 3);
?>

<section class="hero">
    <h1>Bienvenue chez <?= e($garage['nom'] ?? 'TheBigGarage') ?></h1>
    <p>Entretien, réparation et vente de véhicules d'occasion à <?= e($garage['ville'] ?? '') ?>.</p>
    <a href="voitures.php" role="button">Voir nos <?= count($vehicules) ?> voitures</a>
</section>

<section>
    <h2>Nos dernières arrivées</h2>
    <div class="grille">
        <?php foreach ($recentes as $v): ?>
            <article class="carte">
                <header class="carte-image">
                    <img src="<?= e($v['image']) ?>" alt="<?= e($v['marque'] . ' ' . $v['modele']) ?>">
                </header>
                <h3><?= e($v['marque'] . ' ' . $v['modele']) ?></h3>
                <p><small><?= e($v['annee']) ?> · <?= formatKm($v['kilometrage']) ?> · <?= e($v['carburant']) ?></small></p>
                <p class="prix"><?= formatPrix($v['prix_chf']) ?></p>
                <footer>
                    <a href="voiture.php?id=<?= urlencode($v['id']) ?>" role="button">Voir le détail</a>
                </footer>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="grid">
    <article>
        <h2>Horaires</h2>
        <!-- À compléter avec vos horaires -->
        <p>Lundi – Vendredi : à compléter</p>
        <p>Samedi : à compléter</p>
    </article>
    <article>
        <h2>Nous trouver</h2>
        <!-- À compléter avec votre adresse et votre téléphone -->
        <p>Adresse : à compléter, <?= e($garage['ville'] ?? '') ?></p>
        <p>Téléphone : à compléter</p>
    </article>
</section>

<?php require 'php/footer.php'; ?>
