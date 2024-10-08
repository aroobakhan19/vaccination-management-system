<?php
session_start();

require '../vendor/autoload.php'; // Ensure this path is correct

// Check if session variables are set
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'N/A';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : 'N/A';
$phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : 'N/A';

// Database connection
include_once "../Connection/config.php";
// Fetch appointments
$userid = $_SESSION['userid']; // Assuming user ID is stored in session
$selectquery = "SELECT * FROM `appointment` WHERE `parent_id` = '$userid'";
$result = mysqli_query($con, $selectquery);

// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Your Name');
$pdf->SetTitle('Appointment Details');
$pdf->SetSubject('Appointment Details');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', 'B', 16);

// Add content
$pdf->Cell(0, 10, 'Appointment Details', 0, 1, 'C');
$pdf->Ln(10); // Add a line break

$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Username: ' . htmlspecialchars($username), 0, 1);
$pdf->Cell(0, 10, 'Email: ' . htmlspecialchars($email), 0, 1);
$pdf->Cell(0, 10, 'Phone: ' . htmlspecialchars($phone), 0, 1);
$pdf->Ln(10); // Add another line break

// Check if appointments exist
if (mysqli_num_rows($result) > 0) {
    $pdf->Cell(0, 10, 'Your Appointments:', 0, 1);
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(0, 10, 'Child Name: ' . htmlspecialchars($row['child_name']), 0, 1);
        $pdf->Cell(0, 10, 'Hospital: ' . htmlspecialchars($row['hospital']), 0, 1);
        $pdf->Cell(0, 10, 'Vaccine: ' . htmlspecialchars($row['vaccine']), 0, 1);
        $pdf->Cell(0, 10, 'Date: ' . htmlspecialchars($row['date']), 0, 1);
        $pdf->Cell(0, 10, 'Status: ' . ucfirst(htmlspecialchars($row['status'])), 0, 1);
        $pdf->Ln(5); // Add space between appointments
    }
} else {
    $pdf->Cell(0, 10, 'No appointments found.', 0, 1);
}

// Check if there's any output before generating PDF
ob_start(); // Start output buffering
$pdf->Output('appointment_details.pdf', 'D'); // 'D' forces a download
ob_end_flush(); // Flush the buffer to the browser

// Close database connection
mysqli_close($con);
