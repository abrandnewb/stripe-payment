var stripe = Stripe('publishable-key');
var elements = stripe.elements();

var style = {
  base: {
    color: "green",
  }
};

var card = elements.create("card", { style: style });
card.mount("#card-element");

card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

var form = document.getElementById('payment-form');
var fullname = document.getElementById('fullname');
var email = document.getElementById('email');
form.addEventListener('submit', function(ev) {
  ev.preventDefault();
  // If the client secret was rendered server-side as a data-secret attribute
  // on the <form> element, you can retrieve it here by calling `form.dataset.secret`
  stripe.confirmCardPayment(form.dataset.secret, {
    payment_method: {
      card: card,
      billing_details: {
        name: fullname,
        email: email
      }
    }
  }).then(function(result) {
    if (result.error) {
      alert(result.error.message);
    } 
    else {
      if (result.paymentIntent.status === 'succeeded') {
        alert('The payment has been proccessed');
        window.location.replace("http://localhost/stripe-payment/success.php");
      }
    }
  });
});