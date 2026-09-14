<?php
/**
 * Classe Equipement (annexe C)
 */
class Equipement
{
    private string $idEquip;
    private string $libEquip;

    public function __construct(string $unId, string $unLib)
    {
        $this->idEquip = $unId;
        $this->libEquip = $unLib;
    }

    /**
     * Retourne sous la forme d'une chaîne la valeur de l'attribut libEquip.
     * L'identifiant de l'équipement n'est pas inséré dans la chaîne.
     */
    public function versChaine(): string
    {
        return $this->libEquip;
    }
}
