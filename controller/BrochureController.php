<?php
require_once __DIR__ . '/../technique/Passerelle.php';
require_once __DIR__ . '/../technique/PDF.php';

/**
 * Procédure BrochurePDF
 * Édite le document BateauVoyageur.pdf contenant le détail des bateaux
 * voyageurs avec leurs équipements (cf. énoncé, page 1).
 */
function brochurePDF(): string
{
    $cheminSortie = __DIR__ . '/../output/BateauVoyageur.pdf';

    $unPDF = new PDF($cheminSortie);

    $lesBateauxVoyageurs = Passerelle::chargerLesBateauxVoyageurs();

    for ($i = 1; $i <= $lesBateauxVoyageurs->cardinal(); $i++) {
        $unBateauVoyageur = $lesBateauxVoyageurs->obtenirObjet($i);

        $imageLocale = __DIR__ . '/../images/bateauvoyageur/bateau-' . $unBateauVoyageur->getIdBat() . '.jpg';
        $image = file_exists($imageLocale) ? $imageLocale : $unBateauVoyageur->getImageBatVoy();
        $unPDF->chargerImage($image);
        $unPDF->ecrireTexte($unBateauVoyageur->versChaine());
    }

    $unPDF->fermer();

    return $cheminSortie;
}
