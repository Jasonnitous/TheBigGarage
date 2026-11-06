<?php
require_once 'php/fonctions.php';

// On récupère l'id dans l'URL : voiture.php?id=V001
$id = $_GET['id'] ?? '';
$v  = getVehicule($id);

$titre = $v ? $v['marque'] . ' ' . $v['modele'] : 'Voiture introuvable';
$page  = 'voitures';
require 'php/header.php';
?>

<nav aria-label="breadcrumb">
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="voitures.php">Voitures</a></li>
        <li><?= e($titre) ?></li>
    </ul>
</nav>

<?php if ($v === null): ?>

    <h1>Voiture introuvable</h1>
    <p class="message">Aucune voiture ne correspond à l'identifiant « <?= e($id) ?> ».</p>

<?php else: ?>

    <div class="grid">
        <figure class="detail-image">
            <img src="<?= e($v['image']) ?>" alt="<?= e($v['marque'] . ' ' . $v['modele']) ?>">
        </figure>

        <div>
            <h1><?= e($v['marque'] . ' ' . $v['modele']) ?></h1>
            <p class="prix prix-grand"><?= formatPrix($v['prix_chf']) ?></p>

            <table class="striped">
                <tbody>
                    <tr><th scope="row">Année</th><td><?= e($v['annee']) ?></td></tr>
                    <tr><th scope="row">Kilométrage</th><td><?= formatKm($v['kilometrage']) ?></td></tr>
                    <tr><th scope="row">Carburant</th><td><?= e($v['carburant']) ?></td></tr>
                    <tr><th scope="row">Boîte de vitesses</th><td><?= e($v['boite_vitesse']) ?></td></tr>
                    <tr><th scope="row">Puissance</th><td><?= e($v['puissance_ch']) ?> ch</td></tr>
                    <tr><th scope="row">Couleur</th><td><?= e($v['couleur']) ?></td></tr>
                    <tr><th scope="row">Référence</th><td><?= e($v['id']) ?></td></tr>
                </tbody>
            </table>
        </div>
    </div>

<?php endif; ?>

<?php require 'php/footer.php'; ?>
