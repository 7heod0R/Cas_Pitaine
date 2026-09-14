<?php
declare(strict_types=1);

require_once __DIR__ . '/controller/AccueilController.php';

$donnees = afficherAccueil();

extract($donnees, EXTR_SKIP);
require __DIR__ . '/view/accueil.php';
