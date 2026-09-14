<?php
require_once __DIR__ . '/../model/BateauRepository.php';
require_once __DIR__ . '/BrochureController.php';

function afficherAccueil(): array
{
    try {
        $bateaux = BateauRepository::trouverVoyageurs();
        $pdfGenere = false;

        if (isset($_GET['generer'])) {
            brochurePDF();
            $pdfGenere = true;
        }

        return [
            'bateaux' => $bateaux,
            'pdfGenere' => $pdfGenere,
            'erreur' => null,
        ];
    } catch (Throwable $exception) {
        return [
            'bateaux' => [],
            'pdfGenere' => false,
            'erreur' => $exception->getMessage(),
        ];
    }
}
