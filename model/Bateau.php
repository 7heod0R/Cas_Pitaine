<?php
/**
 * Classe Bateau (annexe C)
 */
abstract class Bateau
{
    protected string $idBat;
    protected string $nomBat;
    protected float $longueurBat;
    protected float $largeurBat;

    public function __construct(string $unId, string $unNom, float $uneLongueur, float $uneLargeur)
    {
        $this->idBat = $unId;
        $this->nomBat = $unNom;
        $this->longueurBat = $uneLongueur;
        $this->largeurBat = $uneLargeur;
    }

    /**
     * Retourne sous la forme d'une chaîne de caractères toutes les valeurs
     * concaténées des attributs de la classe précédées de leurs libellés.
     * Exemple :
     * Nom du bateau : Luce isle
     * Longueur : 37,20 mètres
     * Largeur : 8,60 mètres
     */
    public function versChaine(): string
    {
        $str  = "Nom du bateau : " . $this->nomBat . "\n";
        $str .= "Longueur : " . $this->longueurBat . " mètres\n";
        $str .= "Largeur : " . $this->largeurBat . " mètres\n";
        return $str;
    }
}
