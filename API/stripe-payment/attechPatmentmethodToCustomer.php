<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Result</title>
</head>
<body>
<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('config.php');
// Include Stripe library
require_once 'vendor/autoload.php'; // Include Stripe PHP library

$test_key = 'sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR';
$Live_key = '';
        
\Stripe\Stripe::setApiKey($test_key);

// Retrieve data from URL
$customerId = $_GET['customerId'];
$paymentMethodId = $_GET['paymentMethodId'];
$cardNumber = $_GET['cardNumber'];
$expMonth = $_GET['expMonth'];
$expYear = $_GET['expYear'];
$PaymentDetails = $_GET['PaymentDetails'];
try {
    // Attach the payment method to the customer
    $paymentMethod = \Stripe\PaymentMethod::retrieve($paymentMethodId);
    $paymentMethod->attach(['customer' => $customerId]);
    
    // Optionally, set the payment method as the default for the customer
    $customer = \Stripe\Customer::retrieve($customerId);
    $customer->invoice_settings['default_payment_method'] = $paymentMethodId;
    $customer->save();

    // Prepare and bind the insert statement
    $stmt = $con->prepare("INSERT INTO tbl_user_card (customer_id, payment_method_id, card_number, exp_month, exp_year) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $customerId, $paymentMethodId, $cardNumber, $expMonth, $expYear);

    // Execute the statement
    $stmt->execute();

    // Close statement and connection
    $stmt->close();
    $con->close();
    
    // Call myCallback function with payment method data and result
    echo '<script type="text/javascript">';
    echo 'function myCallback(status) {';
    echo '  var statusData = JSON.stringify(status);';
    echo '  console.log(statusData);';
    echo '  messageHandler.postMessage(statusData);';
    echo '}';
    echo 'myCallback({"result": "success","paymentMethodId": ' . json_encode($paymentMethodId) . '});';
    echo '</script>';
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle API error and call myCallback with the error message and result
    echo '<script type="text/javascript">';
    echo 'function myCallback(status) {';
    echo '  var statusData = JSON.stringify(status);';
    echo '  console.log(statusData);';
    echo '  messageHandler.postMessage(statusData);';
    echo '}';
    echo 'myCallback({"result": "' . $e->getMessage() . '", "paymentMethodId": ""});';
    echo '</script>';
}
?>

</body>
</html>
