<?php
require_once __DIR__ . '/../vendor/fpdf/fpdf.php';

/**
 * Classe PDF (annexe D)
 * Encapsule la bibliothèque FPDF pour exposer exactement l'interface
 * décrite dans l'énoncé : constructeur(nomDocument), ecrireTexte,
 * chargerImage, fermer.
 */
class PDF
{
    private FPDF $fpdf;
    private string $nomDocument;

    /**
     * Crée le document PDF vierge "nomDocument".
     */
    public function __construct(string $nomDocument)
    {
        $this->nomDocument = $nomDocument;
        $this->fpdf = new FPDF();
        $this->fpdf->AddPage();
        $this->fpdf->SetFont('Arial', '', 12);
    }

    /**
     * Écrit le contenu de la chaîne de caractères leTexte dans le document PDF.
     * FPDF (classique) attend du texte encodé en ISO-8859-1 : on convertit
     * donc depuis l'UTF-8 (encodage natif des fichiers PHP/de la base).
     */
    public function ecrireTexte(string $leTexte): void
    {
        $texteConverti = @iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $leTexte) ?: $leTexte;
        $this->fpdf->MultiCell(0, 6, $texteConverti);
        $this->fpdf->Ln(4);
    }

    /**
     * Insère dans le document l'image dont le chemin d'accès est passé
     * en paramètre.
     */
    public function chargerImage(string $chemin): void
    {
        if ($chemin !== '' && file_exists($chemin)) {
            $this->fpdf->Image($chemin, null, null, 80);
            $this->fpdf->Ln(4);
        }
    }

    /**
     * Ferme le document (écrit le fichier PDF sur disque).
     */
    public function fermer(): void
    {
        $this->fpdf->Output('F', $this->nomDocument);
    }
}
