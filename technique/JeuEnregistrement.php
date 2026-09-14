<?php
require_once __DIR__ . '/../config/Database.php';

/**
 * Classe technique JeuEnregistrement (annexe D)
 * Encapsule un PDOStatement pour exposer une interface de curseur
 * (suivant / fin / getValeur / fermer) conforme à la description textuelle.
 */
class JeuEnregistrement
{
    private array $enregistrements = [];
    private int $index = 0;
    private int $total = 0;

    /**
     * Constructeur. Exécute la requête SQL et positionne le curseur
     * sur le premier enregistrement.
     */
    public function __construct(string $chaineSQL)
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query($chaineSQL);
        $this->enregistrements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->total = count($this->enregistrements);
        $this->index = 0;
    }

    /**
     * Avance le curseur sur l'enregistrement suivant.
     */
    public function suivant(): void
    {
        $this->index++;
    }

    /**
     * Indique si la marque de fin est atteinte.
     */
    public function fin(): bool
    {
        return $this->index >= $this->total;
    }

    /**
     * Renvoie la valeur du champ nomChamp de l'enregistrement courant.
     */
    public function getValeur(string $nomChamp)
    {
        return $this->enregistrements[$this->index][$nomChamp] ?? null;
    }

    /**
     * Ferme le curseur et libère les ressources.
     */
    public function fermer(): void
    {
        $this->enregistrements = [];
        $this->index = 0;
        $this->total = 0;
    }
}
