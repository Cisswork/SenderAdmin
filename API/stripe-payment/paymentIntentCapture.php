<?php
// Include Stripe library
require_once 'stripe-payment/vendor/autoload.php'; // Include Stripe PHP library
$payment_intent = $_REQUEST['payment_intent'];
try {
    $stripe = new \Stripe\StripeClient('sk_test_51P0PeZIhs7ZBuE9x6doJhDmVDxWJb4rOs0sdWFB3gYhuFRKB89aD6D9cCrFatLPo8X8sGz3QoMPZzKqTzx97dU4i00DuUU6UBR');
    
    // Payment Intent ID
    //$paymentIntentId = 'pi_3P12NXIhs7ZBuE9x25qFxQcs'; // Replace with your actual Payment Intent ID
     $paymentIntentId =$payment_intent;
    // Capture the payment intent
    $capture = $stripe->paymentIntents->capture($paymentIntentId);

    // Handle capture success
     $msg['Result']=  "Payment intent captured successfully.";
     echo  json_encode($msg);
} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle error
     $msg['Result']=  "Error capturing payment intent: " . $e->getMessage();
     echo  json_encode($msg);
}
?>
