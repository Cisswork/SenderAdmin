<?php
$customerId = $_GET['customerId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Payment Card</title>
<style>
  .modal {
      display: none;
      position: fixed;
      z-index: 1;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      overflow: auto;
      background-color: rgb(0,0,0);
      background-color: rgba(0,0,0,0.4);
    }

    .modal-content {
      background-color: #fefefe;
      margin: 15% auto;
      padding: 20px;
      border: 1px solid #888;
      width: 80%;
    }

    .close {
      color: #aaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }

    .close:hover,
    .close:focus {
      color: black;
      text-decoration: none;
      cursor: pointer;
    }
    /* Variables */
    * {
      box-sizing: border-box;
    }
    
    body {
      font-family: -apple-system, BlinkMacSystemFont, sans-serif;
      font-size: 16px;
      -webkit-font-smoothing: antialiased;
      display: flex;
      justify-content: center;
      align-content: center;
      height: 100vh;
      width: 100vw;
    }
    
    form {
      width: 90vw; /* Adjusted width for mobile view */
      max-width: 500px; /* Added max-width for better scaling */
      align-self: center;
      box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
        0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
      border-radius: 7px;
      padding: 40px;
    }
    
    .hidden {
      display: none;
    }
    
    #payment-message {
      color: rgb(105, 115, 134);
      font-size: 16px;
      line-height: 20px;
      padding-top: 12px;
      text-align: center;
    }
    
    #payment-element {
      margin-bottom: 24px;
      /* Example styles */
      background-color: #f5f5f5;
      border: 1px solid #ccc;
      border-radius: 5px;
      padding: 10px;
      margin-bottom: 10px; /* Add margin to separate form fields */
    }
    
    /* Buttons and links */
    button {
      background: #5469d4;
      font-family: Arial, sans-serif;
      color: #ffffff;
      border-radius: 4px;
      border: 0;
      padding: 12px 16px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      display: block;
      transition: all 0.2s ease;
      box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
      width: 100%;
    }
    button:hover {
      filter: contrast(115%);
    }
    button:disabled {
      opacity: 0.5;
      cursor: default;
    }
 
    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
      border-radius: 50%;
    }
    .spinner {
      color: #ffffff;
      font-size: 22px;
      text-indent: -99999px;
      margin: 0px auto;
      position: relative;
      width: 20px;
      height: 20px;
      box-shadow: inset 0 0 0 2px;
      -webkit-transform: translateZ(0);
      -ms-transform: translateZ(0);
      transform: translateZ(0);
    }
    .spinner:before,
    .spinner:after {
      position: absolute;
      content: "";
    }
    .spinner:before {
      width: 10.4px;
      height: 20.4px;
      background: #5469d4;
      border-radius: 20.4px 0 0 20.4px;
      top: -0.2px;
      left: -0.2px;
      -webkit-transform-origin: 10.4px 10.2px;
      transform-origin: 10.4px 10.2px;
      -webkit-animation: loading 2s infinite ease 1.5s;
      animation: loading 2s infinite ease 1.5s;
    }
    .spinner:after {
      width: 10.4px;
      height: 10.2px;
      background: #5469d4;
      border-radius: 0 10.2px 10.2px 0;
      top: -0.1px;
      left: 10.2px;
      -webkit-transform-origin: 0px 10.2px;
      transform-origin: 0px 10.2px;
      -webkit-animation: loading 2s infinite ease;
      animation: loading 2s infinite ease;
    }
    
    @-webkit-keyframes loading {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    @keyframes loading {
      0% {
        -webkit-transform: rotate(0deg);
        transform: rotate(0deg);
      }
      100% {
        -webkit-transform: rotate(360deg);
        transform: rotate(360deg);
      }
    }
    
    @media only screen and (max-width: 600px) {
      form {
        width: 90vw; /* Adjusted width for mobile view */
        min-width: initial;
      }
    }
    
    
    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
</style>
</head>
<body>
<!-- Modal -->
<div id="myModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <form id="payment-form">
      <div id="payment-element">
          <!--Stripe.js injects the Payment Element-->
      </div>
      <button id="submit">
          <div class="spinner hidden" id="spinner"></div>
          <span id="button-text">Pay now</span>
      </button>
      <div id="payment-message" class="hidden"></div>
    </form>
    <input type='hidden' id="customerId" name='customerId' value="<?php echo $customerId; ?>" >
  </div>
</div>

<!-- Button to trigger the modal -->
<button id="openModal">Open Modal</button>

<!-- Your JavaScript code -->
<!-- Include Stripe.js library -->
<script src="https://js.stripe.com/v3/"></script>
<script>
// JavaScript code for modal functionality and payment form handling
// Initialize Stripe.js with your publishable key
var stripe = Stripe('pk_test_51P0PeZIhs7ZBuE9xMd91bx1nkica9Ud6ykQ3sBmXv9IRX0sYB4btYgtJXV7cTi1zZQdgdM4WT1QmNSCwwqykkPP3003aPqD9mU');

// Additional code snippet to customize appearance
const appearanceOptions = {
  theme: 'flat',
  variables: { colorPrimaryText: '#262626' }
};

var elements = stripe.elements(); // Create an instance of Elements
var card = elements.create('card', { appearance: appearanceOptions }); // Create a CardElement with appearance customization
card.mount('#payment-element'); // Mount the CardElement to the HTML element with id 'payment-element'

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  // Show spinner
  document.getElementById('spinner').classList.remove('hidden');
  document.getElementById('button-text').innerText = 'Processing...';
  document.getElementById('submit').disabled = true;

  // Create payment method using the card details
  stripe.createPaymentMethod({
    type: 'card',
    card: card
  }).then(function(result) {
    // Handle payment method creation success
    var paymentMethodId = result.paymentMethod.id;
    console.log(paymentMethodId); // PaymentMethod object containing PaymentMethod ID
  
    // Extract card details
    var cardDetails = result.paymentMethod.card;
    var cardNumber = cardDetails.last4;
    var expMonth = cardDetails.exp_month;
    var expYear = cardDetails.exp_year;
    var PaymentDetails = JSON.stringify(result.paymentMethod);
    console.log(PaymentDetails);
    // Get the customer ID
    var customerId = document.getElementById('customerId').value; // Replace with your actual customer ID
    
    // Redirect to the specified URL after successful payment method creation
    window.location.href = 'https://cisswork.com/Android/SenderApp/stripe-payment/attechPatmentmethodToCustomer.php?paymentMethodId=' + paymentMethodId + '&customerId=' + customerId + '&cardNumber=' + cardNumber + '&expMonth=' + expMonth + '&expYear=' + expYear+ '&PaymentDetails=' + PaymentDetails;
  }).catch(function(error) {
    // Handle errors
    console.error(error);
    // Hide spinner
    document.getElementById('spinner').classList.add('hidden');
    document.getElementById('button-text').innerText = 'Pay now';
    document.getElementById('submit').disabled = false;
  });
});

// JavaScript code for modal functionality
var modal = document.getElementById("myModal");
var btn = document.getElementById("openModal");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>
</body>
</html>

