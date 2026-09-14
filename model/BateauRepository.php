<?php
require_once __DIR__ . '/../config/Database.php';

class BateauRepository
{
    public static function trouverVoyageurs(): array
    {
        $pdo = Database::getConnection();
        $requete = $pdo->query(
            'SELECT b.id, b.nom, b.longueur, b.largeur, b.vitesse, b.image,
                    GROUP_CONCAT(e.lib ORDER BY e.lib SEPARATOR ", ") AS equipements
             FROM BATEAU b
             LEFT JOIN POSSEDER p ON p.idBat = b.id
             LEFT JOIN EQUIPEMENT e ON e.id = p.idEquip
             WHERE b.type = "v"
             GROUP BY b.id, b.nom, b.longueur, b.largeur, b.vitesse, b.image
             ORDER BY b.nom'
        );

        return $requete->fetchAll();
    }
}
