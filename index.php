<?php 
  require 'stripe-php/init.php';
  \Stripe\Stripe::setApiKey('secret-key');

  $intent = \Stripe\PaymentIntent::create([
    'amount' => 5000,
    'currency' => 'usd',
    'metadata' => ['integration_check' => 'accept_a_payment'],
  ]);
?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poppins" />
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <title>Stripe Donate</title>
    <script src="https://js.stripe.com/v3/"></script>
  </head>
  <body>
    <div class="container">
      <div class="row">
      <br>
        <div class="col-lg-4">
          <form id="payment-form" data-secret="<?= $intent->client_secret ?>">
            <div class="field-row">
                  <label>Card Holder Name</label> <span id="card-holder-name-info" class="info"></span><br> 
                  <input type="text" id="fullname" name="fullname" class="demoInputBox" required>
              </div><br>
              <div class="field-row">
                  <label>Email</label> <span id="email-info" class="info"></span><br>
                  <input type="email" id="email" name="email" class="demoInputBox" required>
              </div>
              <br>
              <div id="card-element">
                <!-- Elements will create input elements here -->
              </div>
              <div id="card-errors" role="alert"></div>
              <button id="card-button">Pay</button>
          </form>
        </div>
      </div>
    </div>
    <script src="js/script.js"></script>
  </body>
</html>