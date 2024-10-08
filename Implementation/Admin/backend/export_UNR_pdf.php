<?php
require '../../vendor/autoload.php';

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "citytaxi";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection Error" . mysqli_connect_error());
}

// Fetch data
$sql = "SELECT * FROM unregpassengers";
$result = mysqli_query($conn, $sql);

// Create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('City Taxi');
$pdf->SetTitle('Unregistered Passenger List');
$pdf->SetSubject('Unregistered Passenger Information');

// Add a page
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', '', 10);

// Define table styles
$html = '
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th {
        background-color: #000; /* Bootstrap primary color */
        border: 1px solid #000; /* Border color */
        color: white;
        font-weight: bold;
        padding: 10px;
        text-align: center;
    }
    td {
        border: 1px solid #000; /* Border color */
        padding: 8px;
        text-align: center;
        font-size: 10pt;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2; /* Light gray for even rows */
    }
    tr:hover {
        background-color: #d1ecf1; /* Light blue on hover */
    }
</style>
<h1>Drivers List</h1>
<table>
<tr>
<th>ID</th>
<th>Frist Name</th>
<th>Last Name</th>
<th>Mobile Number</th>
</tr>';

// Table data
while ($row = mysqli_fetch_array($result)) {
    $html .= '<tr>
        <td>'.$row["unregPassengerID"].'</td>
        <td>'.$row["firstName"].'</td>
        <td>'.$row["lastName"].'</td>
        <td>'.$row["mobilenumber"].'</td>
    </tr>';
}

$html .= '</table>';

// Print text using writeHTMLCell()
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('Unregistered_Passenger.pdf', 'D');

// Close database connection
mysqli_close($conn);
?>
