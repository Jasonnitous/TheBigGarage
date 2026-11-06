<?php
// Lit un fichier JSON et renvoie un tableau PHP
function lireJson($fichier)
{
    if (!file_exists($fichier)) {
        return [];
    }
    $contenu = file_get_contents($fichier);
    $donnees = json_decode($contenu, true);
    return $donnees ?? [];
}

// Renvoie la liste des véhicules de voitures.json
function getVehicules()
{
    $data = lireJson(__DIR__ . '/../json/voitures.json');
    return $data['concessionnaire']['vehicules'] ?? [];
}

// Cherche un véhicule par son id (ex. "V001"), renvoie null s'il n'existe pas
function getVehicule($id)
{
    foreach (getVehicules() as $vehicule) {
        if ($vehicule['id'] === $id) {
            return $vehicule;
        }
    }
    return null;
}

// Formate un prix à la suisse : 18500 -> 18'500 CHF
function formatPrix($prix)
{
    return number_format($prix, 0, '.', "'") . ' CHF';
}

// Formate un kilométrage : 25000 -> 25'000 km
function formatKm($km)
{
    return number_format($km, 0, '.', "'") . ' km';
}

// Raccourci pour sécuriser l'affichage (évite les failles XSS)
function e($texte)
{
    return htmlspecialchars((string) $texte, ENT_QUOTES, 'UTF-8');
}
