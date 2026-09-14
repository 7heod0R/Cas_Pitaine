<?php
require_once __DIR__ . '/JeuEnregistrement.php';
require_once __DIR__ . '/Collection.php';
require_once __DIR__ . '/../model/Equipement.php';
require_once __DIR__ . '/../model/BateauVoyageur.php';

/**
 * Classe Passerelle (annexe D)
 * Instancie les objets métier à partir des données de la base "dbBat"
 * (schéma décrit en annexe E : BATEAU, EQUIPEMENT, POSSEDER).
 */
class Passerelle
{
    /**
     * Retourne la collection des Equipements du bateau dont l'identifiant
     * est passé en paramètre.
     */
    public static function chargerLesEquipements(int $unIdBateau): Collection
    {
        $collection = new Collection();

        $sql = "SELECT E.id, E.lib
                FROM EQUIPEMENT E
                INNER JOIN POSSEDER P ON E.id = P.idEquip
                WHERE P.idBat = " . intval($unIdBateau);

        $jeu = new JeuEnregistrement($sql);

        while (!$jeu->fin()) {
            $unEquipement = new Equipement(
                (string) $jeu->getValeur('id'),
                (string) $jeu->getValeur('lib')
            );
            $collection->ajouter($unEquipement);
            $jeu->suivant();
        }
        $jeu->fermer();

        return $collection;
    }

    /**
     * Instancie et retourne une collection d'objets BateauVoyageur, à partir
     * des données lues dans la base "dbBat" (BATEAU.type = 'v').
     * Instancie également la collection lesEquipements de chaque bateau.
     */
    public static function chargerLesBateauxVoyageurs(): Collection
    {
        $collection = new Collection();

        $sql = "SELECT id, nom, longueur, largeur, vitesse, image
                FROM BATEAU
                WHERE type = 'v'";

        $jeu = new JeuEnregistrement($sql);

        while (!$jeu->fin()) {
            $idBat = $jeu->getValeur('id');
            $lesEquipements = self::chargerLesEquipements((int) $idBat);

            $unBateauVoyageur = new BateauVoyageur(
                (string) $idBat,
                (string) $jeu->getValeur('nom'),
                (float) $jeu->getValeur('longueur'),
                (float) $jeu->getValeur('largeur'),
                (float) $jeu->getValeur('vitesse'),
                (string) $jeu->getValeur('image'),
                $lesEquipements
            );

            $collection->ajouter($unBateauVoyageur);
            $jeu->suivant();
        }
        $jeu->fermer();

        return $collection;
    }
}
