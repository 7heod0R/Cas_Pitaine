# Cas Pitaine

Application PHP MVC qui affiche les bateaux voyageurs et genere une brochure PDF.

## Architecture

```text
Cas_Pitaine/
|-- index.php                  Point d'entree MVC
|-- config/                    Connexion PDO
|-- controller/                Coordination des actions
|-- model/                     Objets metier et repository
|-- view/                      HTML/CSS de l'interface
|-- technique/                 Collections, passerelle et PDF
|-- images/bateauvoyageur/     Photos locales bateau-ID.jpg
|-- output/                    PDF genere
|-- vendor/fpdf/               Bibliotheque FPDF
|-- database.sql               Creation et donnees de demonstration
```

## Fonctionnement MVC

1. `index.php` charge `AccueilController.php`.
2. `AccueilController.php` demande les donnees a `BateauRepository.php`.
3. Le controller transmet les donnees a `view/accueil.php`.
4. La vue affiche le catalogue et un bouton unique `Generer la brochure PDF`.
5. Avec `?generer=1`, `BrochureController.php` charge les objets metier et cree `output/BateauVoyageur.pdf`.

## Installation avec XAMPP

1. Copiez le projet dans `C:\xampp\htdocs\Cas_Pitaine`.
2. Lancez **Apache** et **MySQL** dans XAMPP.
3. Ouvrez [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
4. Importez `database.sql`.
5. Ouvrez [http://localhost/Cas_Pitaine/index.php](http://localhost/Cas_Pitaine/index.php).

La configuration par defaut est `localhost`, base `dbBat`, utilisateur `root` et mot de passe vide. Modifiez `config/Database.php` si necessaire.

## Images

Les images locales doivent etre placees dans `images/bateauvoyageur/` avec la convention `bateau-ID.jpg`. Exemple : `bateau-1.jpg` pour le bateau `id = 1`.

Le PDF utilise les images locales, car FPDF ne peut pas integrer directement une URL distante.

## Sortie PDF

Apres le clic sur le bouton de generation, le fichier est disponible dans :

```text
C:\xampp\htdocs\Cas_Pitaine\output\BateauVoyageur.pdf
```

## Depannage

- **Ecran blanc** : verifiez Apache, MySQL et l'import de `database.sql`.
- **Erreur de connexion** : verifiez les constantes de `config/Database.php`.
- **Photo absente dans le PDF** : verifiez le nom `bateau-ID.jpg` et le dossier `images/bateauvoyageur/`.
- **Ancienne interface visible** : rechargez avec `Ctrl + F5` et verifiez que l'URL utilise bien `C:\xampp\htdocs\Cas_Pitaine`.

## Documentation par dossier

- [config/README.md](config/README.md)
- [controller/README.md](controller/README.md)
- [model/README.md](model/README.md)
- [view/README.md](view/README.md)
- [technique/README.md](technique/README.md)
- [images/README.md](images/README.md)
- [output/README.md](output/README.md)
- [vendor/README.md](vendor/README.md)
