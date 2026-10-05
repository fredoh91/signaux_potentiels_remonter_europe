<?php

namespace App\Controller;

use App\Entity\SignalPotentiel;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Attribute\Route;

final class ExportExcelController extends AbstractController
{
    #[Route('/export_excel', name: 'app_export_excel')]
    public function exportExcel(Request $request, EntityManagerInterface $entityManager): Response
    {

    
        $date = new DateTimeImmutable('now', new \DateTimeZone('Europe/Paris'));
        $now = $date->format('Ymd_His');
        $nomFichierExcel= "Liste_Signaux_Potentiels_" . $now . ".xlsx";
        $repExport = "./Temp/ExportExcel/";

        if (!is_dir($repExport)) {
            mkdir($repExport, 0777, true);
        };
        if (file_exists($repExport . $nomFichierExcel)) {
            unlink($repExport . $nomFichierExcel);
        }

        $tousSignaux = $entityManager->getRepository(SignalPotentiel::class)->listeTousSignaux();

        if(count($tousSignaux) > 0){
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // // Ajouter les en-têtes de colonnes
            // $headers = array_keys($tousSignaux[0]);
            // $sheet->fromArray($headers, null, 'A1');




        // Define the headers
        // $headers = ['ID', 'Master ID', 'Case ID', 'Specific Case ID', 'DLP Version', 'WorldWide ID'];
        // foreach ($headers as $key => $header) {
        //     $sheet->setCellValue(chr(65 + $key) . '1', $header);
        // }
        $sheet->setCellValue('A1', 'Direction');
        $sheet->setCellValue('B1', 'Pôle');
        $sheet->setCellValue('C1', 'Prénom éval');
        $sheet->setCellValue('D1', 'Nom éval');
        $sheet->setCellValue('E1', 'Substance');
        $sheet->setCellValue('F1', 'Dosage');
        $sheet->setCellValue('G1', 'Voie d\'administration');
        $sheet->setCellValue('H1', 'Signal potentiel');
        $sheet->setCellValue('I1', 'Origine du signal');
        $sheet->setCellValue('J1', 'Numéro BNPV ');
        $sheet->setCellValue('K1', 'Mécanisme d\'action');
        $sheet->setCellValue('L1', 'Exposition');
        $sheet->setCellValue('M1', 'Imputabilité');
        $sheet->setCellValue('N1', 'Littérature');
        $sheet->setCellValue('O1', 'Essais cliniques');
        $sheet->setCellValue('P1', 'Effet RCP autre pays');
        $sheet->setCellValue('Q1', 'DAS ERMR');
        $sheet->setCellValue('R1', 'Score');
        $sheet->setCellValue('S1', 'Commentaire');
        $sheet->setCellValue('T1', 'Date création');
        $sheet->setCellValue('U1', 'Date mise à jour');

        // Largeurs des colonnes
        $columnWidths = [
            'A' => 11,  // Direction
            'B' => 15,  // Pôle
            'C' => 15,  // Prénom éval
            'D' => 17,  // Nom éval
            'E' => 50,  // Substances
            'F' => 50,  // Dosage
            'G' => 26,  // Voie d'administration
            'H' => 72,  // Signal potentiel
            'I' => 55,  // Origine du signal
            'J' => 25,  // Numéro BNPV
            'K' => 25,  // Mécanisme d'action
            'L' => 25,  // Exposition
            'M' => 25,  // Imputabilité
            'N' => 43,  // Littérature
            'O' => 43,  // Essais cliniques
            'P' => 25,  // Effet RCP autre pays
            'Q' => 25,  // DAS ERMR
            'R' => 8,   // Score
            'S' => 80,  // Commentaire
            'T' => 22,  // Date/heure création
            'U' => 22,  // Date/heure mise à jour
        ];

        foreach ($columnWidths as $column => $width) {
            $sheet->getColumnDimension($column)->setWidth($width);
        }

        $baseHeight = 15; // Hauteur de ligne de base en points
        $additionalHeight = 15; // Hauteur additionnelle pour substance et EI

        $row = 2;

        // Ajouter les données
        // $sheet->fromArray($tousSignaux, null, 'A2');
    // dd($tousSignaux[0]);
        foreach ($tousSignaux as $signal) {
            // Ajuster la hauteur de ligne pour les colonnes E (Substance) et H (Signal potentiel)
            
            $sheet->setCellValue('A' . $row, $signal['libelle_dmm_court']);
            $sheet->setCellValue('B' . $row, $signal['libelle_pole_court']);
            $sheet->setCellValue('C' . $row, $signal['eval_prenom']);
            $sheet->setCellValue('D' . $row, $signal['eval_nom']);
            $sheet->setCellValue('E' . $row, $signal['substance']);
            $sheet->setCellValue('F' . $row, $signal['dosage']);
            $sheet->setCellValue('G' . $row, $signal['lib_voie_admin']);
            $sheet->setCellValue('H' . $row, $signal['signal_potentiel']);
            $sheet->setCellValue('I' . $row, $signal['origine_signal']);
            $sheet->setCellValue('J' . $row, $signal['numero_bnpv']);
            $sheet->setCellValue('K' . $row, $signal['lib_mecanisme_action']);
            $sheet->setCellValue('L' . $row, $signal['lib_exposition']);
            $sheet->setCellValue('M' . $row, $signal['lib_imputabilite']);
            $sheet->setCellValue('N' . $row, $signal['lib_litterature']);
            $sheet->setCellValue('O' . $row, $signal['lib_essais_cliniques']);
            $sheet->setCellValue('P' . $row, $signal['lib_effet_rcpautre_pays']);
            $sheet->setCellValue('Q' . $row, $signal['lib_das_ermr']);
            $sheet->setCellValue('R' . $row, $signal['score']);
            $sheet->setCellValue('S' . $row, $signal['commentaire']);

            // Date de creation
            // $sheet->setCellValue('T' . $row, $signal['created_at']);
            if ($signal['created_at'] !== null) {
                // Create a DateTime object from the 'dd/mm/yyyy' format
                $creationDate = $signal['created_at'];
    
                if ($creationDate) {
                    // Convert the DateTime object to Excel's serial date format
                    $excelCreationDate = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($creationDate);
    
                    // Set the cell value with the Excel date serial number
                    $sheet->setCellValue('T' . $row, $excelCreationDate);
    
                    // Apply the date format to the cell
                    $sheet->getStyle('T' . $row)
                        ->getNumberFormat()
                        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
                } else {
                    // Handle invalid date formats if necessary
                    $sheet->setCellValue('T' . $row, 'Date Invalide');
                }
            }

            // Date de modification
            // $sheet->setCellValue('T' . $row, $signal['updated_at']);
            if ($signal['updated_at'] !== null) {
                // Create a DateTime object from the 'dd/mm/yyyy' format
                $modificationDate = $signal['updated_at'];
    
                if ($modificationDate) {
                    // Convert the DateTime object to Excel's serial date format
                    $excelModificationDate = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($modificationDate);
    
                    // Set the cell value with the Excel date serial number
                    $sheet->setCellValue('U' . $row, $excelModificationDate);
    
                    // Apply the date format to the cell
                    $sheet->getStyle('U' . $row)
                        ->getNumberFormat()
                        ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DDMMYYYY);
                } else {
                    // Handle invalid date formats if necessary
                    $sheet->setCellValue('U' . $row, 'Date Invalide');
                }
            }

            $substanceLines = substr_count($signal['substance'], "\n") + 1;
            $signalLines = substr_count($signal['signal_potentiel'], "\n") + 1;

            // Estimation du nombre de lignes occupées par le commentaire (colonne S, largeur 80)
            $commentaire = (string)($signal['commentaire'] ?? '');
            $commentaireLines = 1;
            if ($commentaire !== '') {
                $commentaireLines = 0;
                foreach (explode("\n", $commentaire) as $ligneTexte) {
                    $commentaireLines += max(1, (int)ceil((strlen($ligneTexte) + 1) / 80));
                }
            }

            $maxCount = max($substanceLines, $signalLines, $commentaireLines);
            $sheet->getRowDimension($row)->setRowHeight($baseHeight + ($maxCount - 1) * $additionalHeight);

            $row++;
        }

        
        ////////////////////////////////////
        // Mise en forme du fichier Excel //
        ////////////////////////////////////
        
        // On met la premier ligne en gris
        for($col = 'A'; $col != 'V'; $col++) {
            $sheet->getStyle($col . '1')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('D6DCE1');
        }
        
        // Ajout du filtre automatique
        $sheet->setAutoFilter(
            $sheet->calculateWorksheetDimension()
        );
        
        // On freeze la ligne de titre de colonne
        $sheet->freezePane('A2');
        
        // On modifie le nom de l'onglet
        $sheet->setTitle("Liste signaux potentiels"); 
        
        // On modifie la largeur des colonnes avec auto-dimensionnement pour les colonnes non spécifiées
        $allColumns = range('A', 'U');
        foreach ($allColumns as $column) {
            if (!array_key_exists($column, $columnWidths)) {
                $sheet->getColumnDimension($column)->setAutoSize(true);
            }
        }
        
        // // Activer le retour à la ligne et l'ajustement automatique de la hauteur pour les colonnes J, K, L, S et T
        // $sheet->getStyle('J1:L' . ($row + count($susars)))
        //     ->getAlignment()
        //     ->setWrapText(true)
        //     ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        $sheet->getStyle('S1:S' . (1 + count($tousSignaux)))
            ->getAlignment()
            ->setWrapText(true)
            ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

        // On se positionne sur la cellule en haut à gauche
        $sheet->setSelectedCell('A2');





            // Enregistrer le fichier Excel
            // $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer = new Xlsx($spreadsheet);
            $writer->save($repExport . $nomFichierExcel);

            
        // Return the file as a response
        return $this->file($repExport . $nomFichierExcel, $nomFichierExcel, ResponseHeaderBag::DISPOSITION_ATTACHMENT);
        
        }



        return $this->render('export_excel/export_excel.html.twig', [
            'controller_name' => 'ExportExcelController',
        ]);
    }
}
