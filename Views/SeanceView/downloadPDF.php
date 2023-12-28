<?php
session_start();
require("fpdf/fpdf.php");

$pdf = new FPDF();

if (isset($_SESSION['seances'])) {
    $seancesData = $_SESSION['seances'];

    $pdf->AddPage();
    $pdf->setFont("Arial");

    $pdf->SetTextColor(0, 0, 255); // Set text color to blue
    $pdf->SetFont('Arial', 'U', 12); // Underlined and 12pt font
    $pdf->Cell(0, 10, 'Go Back', 0, 1, 'L', false, 'index.php'); // Add link
    $pdf->Ln(10); // Add some space

    // Reset text color and font
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetFont('Arial', '', 10);


    $pdf->Cell(45, 10, 'Numero seance', 'LRBT', 0, 'C');
    $pdf->Cell(45, 10, 'Horaire', 'LRBT', 0, 'C');
    $pdf->Cell(45, 10, 'Heure de debut', 'LRBT', 0, 'C');
    $pdf->Cell(45, 10, 'Heure de fin', 'LRBT', 1, 'C');

    foreach ($seancesData as $row) {
        $pdf->Cell(45, 10, $row['SEANCE'], 'LRB', 0, 'C');
        $pdf->Cell(45, 10, $row['Horaire'], 'LRB', 0, 'C');
        $pdf->Cell(45, 10, $row['HDeb'], 'LRB', 0, 'C');
        $pdf->Cell(45, 10, $row['HFin'], 'LRB', 1, 'C');
    }

    $pdf->Output();
} else {
    // Handle the case where the 'seances' key is not set in the session
    echo "No data available for PDF generation.";
}
?>
