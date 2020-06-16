<?php

require_once "vendor/autoload.php";

$pm = isset($_POST['paymentMethod']) ? sanitize_text_field($_POST['paymentMethod']) : '';
$email = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';

if (!empty($pm) && !empty($email)) {

    Stripe\Stripe::setApiKey(get_option('stripe_forms_gutenberg_api_secret'));

    $paymentMethod = Stripe\PaymentMethod::retrieve($pm);

    $customer = Stripe\Customer::create([
      'email' => $email
    ]);

    $paymentMethod->attach(['customer' => $customer->id]);

    $customer->invoice_settings['default_payment_method'] = $paymentMethod->id;
    $customer->save();
 
    try {
        $sub = Stripe\Subscription::create([
            'customer' => $customer->id,
            'items' => [['plan' => get_option('stripe_forms_gutenberg_plan')]]
        ]);
        echo __("Suscripción realizada", 'stripe-forms-gutenberg');
        
    } catch (\Stripe\Error\Card $e) {    
        echo json_encode(["error"=> $e->getMessage()]);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <title>Stripe Forms Suscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head(); ?>
  </head>

  <body>
    <form action="" method="post" id="payment-form">
    <div class="form-row">
      <input type="email" name="email" placeholder="Correo electrónico">
      <label for="card-element">
        Introduce tu tarjeta
      </label>
      <div id="card-element"></div>

      <div id="card-errors" role="alert"></div>
    </div>

    <button>Enviar</button>
    </form>

    <?php wp_footer(); ?>
    <script>
      var stripe = Stripe('<?php echo get_option('stripe_forms_gutenberg_api_public'); ?>');
      var elements = stripe.elements();

      var card = elements.create('card');
      card.mount('#card-element');

      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();
        paySubmit(stripe, card);
      });

      function paySubmit(stripe, card) {
        stripe.createPaymentMethod({
            type: 'card',
            card: card
        }).then(function(result) {
          if (result.error) {
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
          } else {
            if (result.paymentMethod.id) {
              stripePaymenMethodHandler(result.paymentMethod);
            }
          }
        });
      }

      function stripePaymenMethodHandler(pm) {
          var form = document.getElementById('payment-form');
          var hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', 'paymentMethod');
          hiddenInput.setAttribute('value', pm.id);
          form.appendChild(hiddenInput);
          form.submit();
        }
    </script>
  </body>
</html>
