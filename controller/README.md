# Controllers

Les controllers coordonnent les requetes utilisateur, les modeles et les vues.

## Fichiers

- `AccueilController.php` : charge les bateaux, gere l'action `?generer=1` et prepare les donnees de la vue.
- `BrochureController.php` : construit le PDF de la brochure.

Le controller ne doit pas contenir le HTML de la page. Il transmet des donnees a `view/accueil.php`.
