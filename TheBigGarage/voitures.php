<?php
$titre = 'Nos voitures';
$page  = 'voitures';
require 'php/header.php';

$vehicules = getVehicules();

// Liste des carburants pour le filtre (sans doublons)
$carburants = array_unique(array_column($vehicules, 'carburant'));
sort($carburants);

// Filtre reçu en GET (ex. voitures.php?carburant=Hybride)
$filtreCarburant = $_GET['carburant'] ?? '';

$resultats = [];
foreach ($vehicules as $v) {
    if ($filtreCarburant !== '' && $v['carburant'] !== $filtreCarburant) {
        continue;
    }
    $resultats[] = $v;
}
?>

<h1>Nos voitures d'occasion</h1>

<form method="get">
    <label for="carburant">Carburant</label>
    <fieldset role="group">
        <select name="carburant" id="carburant">
            <option value="">Tous</option>
            <?php foreach ($carburants as $c): ?>
                <option value="<?= e($c) ?>" <?= $c === $filtreCarburant ? 'selected' : '' ?>><?= e($c) ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Filtrer</button>
    </fieldset>
</form>

<p>
    <?= count($resultats) ?> véhicule(s) trouvé(s)
    <?php if ($filtreCarburant !== ''): ?>
        · <a href="voitures.php">Réinitialiser</a>
    <?php endif; ?>
</p>

<div class="grille">
    <?php foreach ($resultats as $v): ?>
        <article class="carte">
            <header class="carte-image">
                <img src="<?= e($v['image']) ?>" alt="<?= e($v['marque'] . ' ' . $v['modele']) ?>">
            </header>
            <h3><?= e($v['marque'] . ' ' . $v['modele']) ?></h3>
            <p>
                <small><?= e($v['annee']) ?> · <?= formatKm($v['kilometrage']) ?></small><br>
                <small><?= e($v['carburant']) ?> · <?= e($v['boite_vitesse']) ?> · <?= e($v['puissance_ch']) ?> ch</small>
            </p>
            <p class="prix"><?= formatPrix($v['prix_chf']) ?></p>
            <footer>
                <a href="voiture.php?id=<?= urlencode($v['id']) ?>" role="button">Voir le détail</a>
            </footer>
        </article>
    <?php endforeach; ?>
</div>

<?php if (count($resultats) === 0): ?>
    <p class="message">Aucune voiture ne correspond à ces critères.</p>
<?php endif; ?>

<?php require 'php/footer.php'; ?>
