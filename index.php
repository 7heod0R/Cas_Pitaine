<?php
declare(strict_types=1);

require_once __DIR__ . '/controller/BrochureController.php';

try {
    $chemin = brochurePDF();
    echo "Document généré avec succès : " . htmlspecialchars($chemin) . "<br>";
    echo '<a href="output/BateauVoyageur.pdf" target="_blank">Ouvrir BateauVoyageur.pdf</a>';
} catch (Throwable $e) {
    echo "Erreur lors de la génération de la brochure : " . htmlspecialchars($e->getMessage());
}
