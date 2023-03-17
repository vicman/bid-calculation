<?php
/**
 * Receives the request and generates the calculations of the amount to be offered.
 * @author Victor Manuel Agudelo <vicmandev@gmail.com>
 */
include_once 'classes/Budget.php';

$totalAmount = isset($_GET['totalAmount']) ? $_GET['totalAmount'] : null;
if (!is_numeric($totalAmount) || $totalAmount <= 0) {
    // The parameter is invalid, returns an error.
    //http_response_code(400);
    $result = ['error' => true, 'message' => 'The parameter Budget must be a positive decimal number.'];
    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}


$report  = new Budget($totalAmount);
$result = $report->getMaxOffer();

header('Content-Type: application/json');
echo json_encode($result);
