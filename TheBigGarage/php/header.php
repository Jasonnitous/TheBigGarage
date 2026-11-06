<?php
require_once __DIR__ . '/fonctions.php';

$titre = $titre ?? 'TheBigGarage';
$page  = $page ?? '';

$menu = [
    'accueil'  => ['lien' => 'index.php',    'texte' => 'Accueil'],
    'voitures' => ['lien' => 'voitures.php', 'texte' => 'Voitures'],
];
?>
<!DOCTYPE html>
<html lang="fr" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($titre) ?> | TheBigGarage</title>
    <!-- Pico d'abord (thème rouge), puis notre CSS pour les petits ajustements -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.red.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="site-header">
        <nav class="container">
            <ul>
                <li><a href="index.php" class="logo">The<span>Big</span>Garage</a></li>
            </ul>
            <ul>
                <?php foreach ($menu as $cle => $item): ?>
                    <li>
                        <a href="<?= $item['lien'] ?>" <?= $cle === $page ? 'aria-current="page"' : '' ?>>
                            <?= $item['texte'] ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>
    <main class="container">
