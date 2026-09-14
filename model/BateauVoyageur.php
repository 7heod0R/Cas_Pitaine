<?php
require_once __DIR__ . '/Bateau.php';
require_once __DIR__ . '/../technique/Collection.php';

/**
 * Classe BateauVoyageur hérite de Bateau (annexe C)
 */
class BateauVoyageur extends Bateau
{
    private float $vitesseBatVoy;
    private string $imageBatVoy;
    private Collection $lesEquipements;

    public function __construct(
        string $unId,
        string $unNom,
        float $uneLongueur,
        float $uneLargeur,
        float $uneVitesse,
        string $uneImage,
        Collection $uneCollEquip
    ) {
        parent::__construct($unId, $unNom, $uneLongueur, $uneLargeur);
        $this->vitesseBatVoy = $uneVitesse;
        $this->imageBatVoy = $uneImage;
        $this->lesEquipements = $uneCollEquip;
    }

    /**
     * Retourne sous la forme d'une chaîne toutes les valeurs concaténées
     * des attributs de la classe, sauf imageBatVoy qui n'est pas inséré.
     * Exemple :
     * Nom du bateau : Luce isle
     * Longueur : 37,20 mètres
     * Largeur : 8,60 mètres
     * Vitesse : 26 noeuds
     * Liste des équipements du bateau :
     * - Accès Handicapé
     * - Bar
     * - Pont Promenade
     * - Salon Vidéo
     */
    public function versChaine(): string
    {
        $str  = "Nom du bateau : " . $this->nomBat . "\n";
        $str .= "Longueur : " . $this->longueurBat . " mètres\n";
        $str .= "Largeur : " . $this->largeurBat . " mètres\n";
        $str .= "Vitesse : " . $this->vitesseBatVoy . " noeuds\n";
        $str .= "Liste des équipements du bateau : " . "\n";

        foreach ($this->lesEquipements->tousLesObjets() as $unEquipement) {
            $str .= "- " . $unEquipement->versChaine() . "\n";
        }

        return $str;
    }

    /**
     * Retourne l'attribut privé imageBatVoy.
     */
    public function getImageBatVoy(): string
    {
        return $this->imageBatVoy;
    }
}
