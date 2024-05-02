<?php
include "config.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Include Stripe library
require_once 'vendor/autoload.php'; // Include Stripe PHP library
// Validate and sanitize payment method ID from POST request
if(isset($_POST['paymentMethodId']) && !empty($_POST['paymentMethodId'])) {
    $paymentMethodId = $_POST['paymentMethodId'];
} else {
    $result['result'] = "Error: Payment method ID is missing or invalid.";
    exit;
}

// Set your secret API key
\Stripe\Stripe::setApiKey('sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR');

try {
    // Start a transaction
    $con->autocommit(FALSE); // Turn off autocommit

    // Detach the payment method
    $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
    $paymentMethod->detach();
   // $result['delete_status'] = "Payment method detached successfully";

    // Delete the corresponding entry from the database
    $paymentMethodIdToDelete = $paymentMethodId; // Replace with your actual payment method ID
    $sql = "DELETE FROM tbl_user_card WHERE payment_method_id = '$paymentMethodIdToDelete'";
    if ($con->query($sql) === TRUE) {
         $result['result'] =  "Payment method detached and Record deleted successfully from the database.";
        // Commit the transaction if both operations are successful
        $con->commit();
    } else {
        $result['result'] =  "Error deleting record: " . $con->error;
        // Rollback the transaction if there's an error
        $con->rollback();
    }

    // Close the database connection
    $con->close();
    
} catch (\Stripe\Exception\ApiErrorException $e) {
    $result['result'] = 'Error detaching payment method: ' . $e->getMessage();
} catch (Exception $e) {
    $result['result'] = 'Error: ' . $e->getMessage();
}

echo json_encode($result, JSON_UNESCAPED_SLASHES);
die;
?>
