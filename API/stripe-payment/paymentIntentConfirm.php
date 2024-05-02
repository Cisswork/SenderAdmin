<?php
// Include Stripe library
require_once 'stripe-payment/vendor/autoload.php'; // Include Stripe PHP library
$payment_intent = $_REQUEST['payment_intent'];
$payment_method= $_REQUEST['payment_method'];
try {
    // Replace 'sk_test_...' with your actual secret API key
   $stripe = new \Stripe\StripeClient('sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR');


    // Payment Intent ID
   // $paymentIntentId = 'pi_3P142RIhs7ZBuE9x0HbZX4lY'; // Replace with your actual Payment Intent ID
     $paymentIntentId = $payment_intent;
    // Confirm the PaymentIntent
    $paymentIntent = $stripe->paymentIntents->confirm(
        $paymentIntentId,
        [
          //  'payment_method' => 'pm_1P142PIhs7ZBuE9xcfHZhsog'
            'payment_method' => $payment_method
        ] // Replace with the payment method ID or card details
    );

    // Handle confirmation success
    $msg['Result']= "Payment intent confirmed successfully.";
    echo  json_encode($msg);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle error
    $msg['Result']= "Error confirming payment intent: " . $e->getMessage();
    echo  json_encode($msg);
}
?>
