<?php
/**
 * Classe technique Collection (annexe D)
 * Collection générique d'objets (utilisée ici pour Equipement et BateauVoyageur).
 */
class Collection
{
    private array $objets = [];

    /**
     * Renvoie le nombre d'objets de la collection.
     */
    public function cardinal(): int
    {
        return count($this->objets);
    }

    /**
     * Retourne l'objet d'index unIndex.
     * Le premier objet de la collection a pour index 1.
     */
    public function obtenirObjet(int $unIndex)
    {
        return $this->objets[$unIndex - 1] ?? null;
    }

    /**
     * Ajoute un objet à la collection.
     */
    public function ajouter($unObjet): void
    {
        $this->objets[] = $unObjet;
    }

    /**
     * Aide PHP pour permettre un "Pour chaque <objet> dans <collection> faire"
     * via un simple foreach côté PHP (sans dénaturer l'API demandée ci-dessus).
     */
    public function tousLesObjets(): array
    {
        return $this->objets;
    }
}
