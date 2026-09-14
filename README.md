# Cas Pitaine — Édition de la brochure PDF des bateaux voyageurs

Projet PHP en architecture MVC, implémentant strictement les classes décrites
dans les annexes B, C, D et E de l'énoncé.

## Mise en route

1. **Configurer la connexion à la base** : ouvre `config/Database.php` et
   ajuste si besoin `HOST`, `USER`, `PASS` (par défaut : `localhost` / `root`
   / mot de passe vide, réglages standards XAMPP/WAMP).
2. **Vérifier que la base `dbBat` existe** avec les 3 tables de l'annexe E :
   `BATEAU`, `EQUIPEMENT`, `POSSEDER`, et qu'elle contient au moins un
   bateau avec `type = 'v'`.
3. **Placer les images des bateaux voyageurs** aux chemins indiqués par la
   colonne `image` de la table `BATEAU` (ex : dans
   `images/bateauvoyageur/`). Si une image est absente, elle est simplement
   ignorée (`chargerImage` teste `file_exists` avant insertion).
4. **Lancer** `index.php` depuis ton serveur local
   (ex : `http://localhost/pitaine-mvc/index.php`).
5. Le PDF est généré dans `output/BateauVoyageur.pdf`.

## Correspondance avec l'énoncé

| Élément de l'énoncé                        | Fichier                              |
|---------------------------------------------|---------------------------------------|
| Classe `Bateau` (annexe C)                  | `model/Bateau.php`                    |
| Classe `BateauVoyageur` (annexe C)          | `model/BateauVoyageur.php`            |
| Classe `Equipement` (annexe C)              | `model/Equipement.php`                |
| Classe technique `Collection` (annexe D)    | `technique/Collection.php`            |
| Classe technique `JeuEnregistrement` (D)    | `technique/JeuEnregistrement.php`     |
| Classe technique `Passerelle` (D)           | `technique/Passerelle.php`            |
| Classe technique `PDF` (D)                  | `technique/PDF.php` (wrapper FPDF)    |
| Procédure `BrochurePDF`                     | `controller/BrochureController.php`   |
| Schéma relationnel `dbBat` (annexe E)       | table `BATEAU` / `EQUIPEMENT` / `POSSEDER`, interrogées par `Passerelle` |

## Points d'implémentation à connaître

- **`JeuEnregistrement`** encapsule un `PDOStatement` : il charge tous les
  enregistrements en mémoire au constructeur (`fetchAll`), puis simule le
  curseur (`suivant()` / `fin()` / `getValeur()`) demandé par l'énoncé, qui
  ne correspond pas exactement à l'API native de PDO.
- **`Passerelle::chargerLesBateauxVoyageurs()`** filtre sur `type = 'v'`
  (les bateaux de fret, `type = 'f'`, ne sont jamais chargés — conforme à la
  brochure qui ne concerne que les voyageurs).
- **`Passerelle::chargerLesEquipements()`** fait une jointure
  `EQUIPEMENT` ⋈ `POSSEDER` filtrée sur `idBat`, car l'association est
  many-to-many (table `POSSEDER`).
- **Encodage** : FPDF (bibliothèque classique) attend du texte en
  ISO-8859-1, alors que les fichiers PHP et la base sont en UTF-8.
  `PDF::ecrireTexte()` fait donc une conversion `iconv` avant d'appeler
  `MultiCell`. Sans cette conversion, les caractères accentués (é, è...)
  s'affichent mal dans le PDF.
- **FPDF fourni** : `vendor/fpdf/fpdf.php` + `vendor/fpdf/font/*.json`
  proviennent du mirroir officiel GitHub (`Setasign/FPDF`). Cette version
  utilise des définitions de police au format JSON (dossier `font/`
  obligatoire à conserver à côté de `fpdf.php`).

## Testé avec

L'ensemble de la chaîne (`Passerelle` → `Collection` → `BateauVoyageur` →
`PDF`) a été validé avec un jeu de données reproduisant l'annexe A
(bateaux "Luce isle" et "Al' xi") : le PDF généré reproduit fidèlement le
texte attendu, dans le bon ordre, avec la bonne liste d'équipements par
bateau, et exclut bien les bateaux de fret.
