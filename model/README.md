# Modeles

Les modeles representent les objets metier et l'acces aux donnees.

## Fichiers

- `Bateau.php` : classe abstraite commune aux bateaux.
- `BateauVoyageur.php` : bateau de type voyageur et ses equipements.
- `Equipement.php` : equipement d'un bateau.
- `BateauRepository.php` : requetes PDO pour charger les bateaux voyageurs.

Les requetes SQL applicatives doivent rester dans les repositories ou passerelles, pas dans les vues.
